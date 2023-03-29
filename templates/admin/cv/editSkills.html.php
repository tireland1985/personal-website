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
            <h2>Edit Skills:</h2>
            <?php if(count($errors) >0): ?>
                <p>Unable to edit or add Skills, please check the following:</p>
                <ul>
                    <?php foreach($errors as $error): ?>
                        <li><?=$error;?></li>
                        <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            <div class="container">
            <form action="" method="post">
                <input type="hidden" name="skills[id]" value="<?=$_GET['id'] ?? ''?>" />
                
                <label for="skill_name">Brief name or Acronym:</label>
                <input type="text" name="skills[skill_name]" id="skill_name" value="<?=$item->skill_name ?? ''?>" class="white-text"/>

                <label for="skill_desc">Description / Details:</label>
                <textarea name="skills[skill_desc]" id="skill_desc" cols="30" rows="10" class="materialize-textarea white-text"><?=$item->skill_desc ?? ''?></textarea>
                
                <label for="skill_name_long">Enter either Acronym or full skill name: </label>
                <input type="text" name="skills[skill_name_long]" id="skill_name_long" value="<?=$item->skill_name_long ?? ''?>" class="white-text" />

                <label for="modal_name">Provide a brief name for the modal popup:</label>
                <input type="text" name="skills[modal_name]" id="modal_name" value="<?=$item->modal_name ?? ''?>" class="white-text" />

                <input type="submit" value="Submit"/>
            </form>
            </div>
        </div>
    </div>
</main>