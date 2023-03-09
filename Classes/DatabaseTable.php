<?php
namespace Classes;
class DatabaseTable {
    private $pdo;
    private $table;
    private $primaryKey;
    private $entityClass;
    private $entityConstructor;

    public function __construct($pdo, $table, $primaryKey, $entityClass = 'stdclass', $entityConstructor = []){
        $this->pdo = $pdo;
        $this->table = $table;
        $this->primaryKey = $primaryKey;
        $this->entityClass = $entityClass;
        $this->entityConstructor = $entityConstructor;
    }

    public function find($field, $value){
        $stmt = $this->pdo->prepare('SELECT * FROM ' . $this->table . ' WHERE ' . $field . ' = :value');
        $stmt->setFetchMode(\PDO::FETCH_CLASS, $this->entityClass, $this->entityConstructor);

        $criteria = [
            'value' => $value
        ];
        $stmt->execute($criteria);

        return $stmt->fetchAll();
    } 
    public function findId($id){
        $stmt = $this->pdo->prepare('SELECT * FROM ' . $this->table . 'WHERE id = :id');
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
    
    public function findAllOrderByLimit($order, $limit){
        $stmt = $this->pdo->prepare('SELECT * FROM ' . $this->table . ' ORDER BY ' . $order . ' DESC LIMIT ' . $limit);
        $stmt->setFetchMode(\PDO::FETCH_CLASS, $this->entityClass, $this->entityConstructor);

        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function findAll(){
        $stmt = $this->pdo->prepare('SELECT * FROM ' . $this->table );
        $stmt->setFetchMode(\PDO::FETCH_CLASS, $this->entityClass, $this->entityConstructor);

        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function recordLoginSuccess(){
        //check to see if the submitted username exists
        $doesUserExist = 'SELECT * FROM ' . $this->table . ' WHERE email = :email';
        $checkStmt = $this->pdo->prepare($doesUserExist);
        $checkValues = [
            'email' => $_POST['username']
        ];
        $checkStmt->execute($checkValues);

        if($checkStmt->rowCount() > 0){
            //record the login attempt
            $time = date('Y-m-d H:i:s');
            $query = 'INSERT INTO ' . $this->table . '(email, datetime_attempted, status)
                        VALUES (:email, :datetime_attempted, :status)';
            $stmt = $this->pdo->prepare($query);
                $values = [
                    'email' => $_POST['username'],
                    'datetime_attempted' => $time,
                    'status' => 'SUCCESS'
                ];
            $stmt->execute($values);
        }
        else {
            //user doesnt exist - do nothinf
        }

    }

    public function recordLoginFailed(){
        //check to see if the submitted username exists
        $doesUserExist = 'SELECT * FROM ' . $this->table . ' WHERE email = :email';
        $checkStmt = $this->pdo->prepare($doesUserExist);
        $checkValues = [
            'email' => $_POST['username']
        ];
        $checkStmt->execute($checkValues);

        if($checkStmt->rowCount() > 0){
            //if the submitted username exists, record the login attempt
            $time = date('Y-m-d H:i:s');
            $query = 'INSERT INTO ' . $this->table . '(email, datetime_attempted, status)
                    VALUES (:email, :datetime_attempted, :status)';
            $stmt = $this->pdo->prepare($query);
                $values = [
                    'email' => $_POST['username'],
                    'datetime_attempted' => $time,
                    'status' => 'FAILED'
             ];
            $stmt->execute($values);
        } 
        else {
            // user not found - do nothing.

        }
        
    }
    public function recordLoginAttempt($status){
        //TODO: combine recordLogin*() functions here
        //prepare and run a query for the provided username
        $findUser = 'SELECT * FROM users WHERE email = :email';
        $stmt = $this->pdo->prepare($findUser);
        $value = [
            'email' =>$_POST['username']
        ];

        $stmt->execute($value);

        if($stmt->rowCount() > 0){
            // if the provided username exists, record details of the attempt
            $time = date('Y-m-d H:i:s');
            $query = 'INSERT INTO ' . $this->table . '(email, datetime_attempted, status)
                        VALUES (:email, :datetime_attempted, :status)';
            $stmt1 = $this->pdo->prepare($query);
                $values = [
                    'email' => $_POST['username'],
                    'datetime_attempted' => $time,
                    'status' => $status
                ];
            $stmt1->execute($values);
        } else {
            // matching user not found - do nothing(?)
        }
    }
    
    public function insert($record){
        // generic insert function that should work for any table/ schema
        $keys = array_keys($record);
    
        $values = implode(', ', $keys);
        $placeholderValues = implode(', :', $keys);
    
        $query = 'INSERT INTO ' . $this->table . ' (' . $values . ') VALUES (:' . $placeholderValues . ')';
        $stmt = $this->pdo->prepare($query);
    
        $stmt->execute($record);
    }

    public function update($record){
        $query = 'UPDATE ' . $this->table . ' SET ';
    
        $parameters = []; // will store the key values (column name, placeholder, data)
        foreach ($record as $key => $value){
            $parameters[] = $key . ' = :' . $key;
        }
    
        $query .= implode(', ', $parameters);
        $query .= ' WHERE ' . $this->primaryKey . '= :primaryKey';
    
        $record['primaryKey'] = $record[$this->primaryKey];
    
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($record);
    }

    public function save($record) {
        // combine insert & update functions using try/catch
        // this will always run the insert function, if that fails (record exists) then it will run the update function
        try {
            $this->insert($record);
        }
        catch (\Exception $e) {
            $this->update($record);
        }
    }

    public function delete($id){
        $stmt = $this->pdo->prepare('DELETE FROM ' . $this->table . ' WHERE ' . $this->primaryKey . ' = :id');
        $values = [
            'id' => $id
        ];
        $stmt->execute($values);
    }

    public function countRecords($field){
        $stmt = $this->pdo->prepare('SELECT ' . $field . ' FROM ' . $this->table );
        $stmt->setFetchMode(\PDO::FETCH_CLASS, $this->entityClass, $this->entityConstructor);

        $stmt->execute();
        return $stmt->rowCount();

        /*example call: 
         $count = $faqTable->countRecords('question');
         if ($count >0) { //do stuff if records are found }
         else { //perform if no records returned by the function }
        */
    }

    public function findTwo($field1, $value1, $field2, $value2){
        $stmt = $this->pdo->prepare('SELECT * FROM ' . $this->table . ' WHERE ' . $field1 . ' = :value1 AND ' . $field2 . ' = :value2');
        $stmt->setFetchMode(\PDO::FETCH_CLASS, $this->entityClass, $this->entityConstructor);

        $criteria = [
            'value1' => $value1,
            'value2' => $value2
        ];
        $stmt->execute($criteria);

        return $stmt->fetchAll();
    }
/*
    public function checkUser($field, $value){
        $stmt = $this->pdo->prepare('SELECT * FROM ' . $this->table . ' WHERE ' . $field . ' = :value');
        $stmt->setFetchMode(\PDO::FETCH_CLASS, $this->entityClass, $this->entityConstructor);

        $values = ['value' => $value];
        $stmt->execute($values);

        $num = $stmt->rowCount();
        if($num >0){
            // get values for specific user
            $row = $stmt->fetch();
            $user_id = $row['id'];
            $firstname = $row['firstname'];
            $lastname = $row['lastname'];
            $privilege_level = $row['privilege_level'];
            $password = $row['password'];

            return true;
        } else {
            return false;
        }

    }*/
}
