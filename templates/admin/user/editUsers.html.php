<main id="admin-page">
    <div class="row">
        <div class="col s3">
        <ul>
            <?php if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == '1'){
                require_once('../templates/admin/nav-admin.html.php');
            } ?>
        </ul>
        </div>
        <div class="col s9">
            <h2>Edit Users</h2>
            <?php if(!empty($errors)): ?>
                <p>Operation Failed: </p>
                <ul>
                    <?php foreach($errors as $error): ?>
                        <li><?=$error;?></li>
                        <?php endforeach;
                        endif; ?>
                </ul>
            <div class="container">
            <form action="" method="post">
                <input type="hidden" name="user[id]" value="<?=$item->id;?>" />
                <label for="firstname">Firstname</label>
                <input type="text" name="user[firstname]" id="firstname" value="<?=$item->firstname ?? '' ?>"/>

                <label for="lastname">Lastname</label>
                <input type="text" name="user[lastname]" id="lastname" value="<?=$item->lastname ?? '' ?>" />

                <label for="email">Email</label>
                <input type="email" name="user[email]" id="email" value="<?=$item->email ?? '' ?>" class="validate"/>
                
                <label for="user_role">User Role</label>
                <select name="user[user_role]" id="user_role">
                        <!-- TODO: select option..-->
                </select>

                <input type="submit" value="Update">
            </form>
            </div>
        </div>
    </div>
</main>