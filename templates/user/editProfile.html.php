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
            <h2>Change Password</h2>
            <?php if(count($errors) >0): ?>
                <p>Error(s) encountered, please check the following:</p>
                <ul>
                    <?php foreach($errors as $error): ?>
                        <li><?=$error;?></li>
                        <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            
            <div class="container">
                <form action="" method="post">
                    <input type="hidden" name="user[id]" value="<?=$_SESSION['user_id'];?>" />
                    <label for="currentPass">Enter existing Password:</label>
                    <input type="password" name="user[password]" id="currentPass" />
                    <label for="newPass">Enter new Password:</label>
                    <input type="password" name="user[new_password]" id="newPass" />
                    <label for="newPassConfirm">Re-enter new Password:</label>
                    <input type="password" name="user[confirm_new_password]" id="newPassConfirm" />
                    <input type="submit" value="Change Password">
                </form>
            </div>

        </div>
    </div>
</main>