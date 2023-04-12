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
        <h1>Administration Portal:</h1>
        <p>Hello, <?=$_SESSION['firstname']; ?></p>
        <p>You are logged in with user role: <?=$_SESSION['user_role'];?></p>
        <p>Last Successful login to your account: 
        <?php foreach($lastLoginSuccess as $row){ 
            $datetime = strtotime($row->datetime_attempted); ?>
            &emsp; <?=date("j F Y H:i", $datetime);?>
        <?php }?> </p>
        <p>Last Failed Login: 
            <?php foreach($lastLoginFailed as $row){
                $failDate = strtotime($row->datetime_attempted);?>
                &emsp; <?=date("j F Y H:i", $failDate);?>
             <?php }?>
        </p>

        </div>
    </div>
</main>