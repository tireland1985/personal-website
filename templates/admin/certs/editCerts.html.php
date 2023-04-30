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
            <h2>Edit Certifications:</h2>
            <?php if(count($errors) >0): ?>
                <p>Unable to edit or add to certifications, please check the following:</p>
                <ul>
                    <?php foreach($errors as $error): ?>
                        <li><?=$error;?></li>
                        <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            <div class="container">
            <form action="" method="post">
                <input type="hidden" name="cert[id]" value="<?=$_GET['id'] ?? ''?>" />
                
                <label for="vendor_name">Vendor Name:</label>
                <input type="text" name="cert[vendor_name]" id="vendor_name" value="<?=$item->vendor_name ?? ''?>" class="white-text"/>

                <label for="cert_name">Certification Name:</label>
                <input type ="text" name="cert[cert_name]" id="cert_name" class="white-text" value="<?=$item->course_names ?? ''?>" />
                
                <label for="vendor_url">Enter vendor/certification URL </label>
                <input type="url" name="cert[vendor_url]" id="vendor_url" value="<?=$item->vendor_url ?? ''?>" class="white-text" />

                <label for="valid_from">Start Date of certificate</label>
                <input type="date" name="cert[valid_from]" id="valid_from" value="<?=$item->valid_from ?? ''?>" class="white-text" />
                
                <label for="valid_to">End Date:</label>
                <input type="date" name="cert[valid_to]" id="valid_to" value="<?=$item->end_year ?? ''?>"class="white-text" />

                <input type="submit" value="Submit"/>
            </form>
            </div>
        </div>
    </div>
</main>