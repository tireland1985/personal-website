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
            <p>Hello, <?=$_SESSION['firstname'];?></p>
            <p>Click <a href="/user/editProfile">here</a> to change your password</p>
        </div>
    </div>
</main>