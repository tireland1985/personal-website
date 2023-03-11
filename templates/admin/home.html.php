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
        </div>
    </div>
</main>