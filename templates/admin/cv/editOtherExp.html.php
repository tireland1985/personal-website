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
            <h2>Edit Other Experience:</h2>
            <?php if(count($errors) >0): ?>
                <p>Unable to edit or add to Other Experience, please check the following:</p>
                <ul>
                    <?php foreach($errors as $error): ?>
                        <li><?=$error;?></li>
                        <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            <div class="container">
            <form action="" method="post">
                <input type="hidden" name="otherExperience[id]" value="<?=$_GET['id'] ?? ''?>" />
                
                <label for="title">Area/ Type of Experience:</label>
                <input type="text" name="otherExperience[title]" id="title" value="<?=$item->title ?? ''?>" class="white-text"/>

                <label for="details">Details:</label>
                <textarea name="otherExperience[details]" id="details" cols="30" rows="10" class="white-text">
                    <?=$item->details ?? ''?>
                </textarea>

                <input type="submit" value="Submit"/>
            </form>
            </div>
        </div>
    </div>
</main>