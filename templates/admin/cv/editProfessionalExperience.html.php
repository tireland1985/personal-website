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
            <h2>Edit Professional Experience:</h2>
            <?php if(count($errors) >0): ?>
                <p>Unable to edit or add to Professional Experience, please check the following:</p>
                <ul>
                    <?php foreach($errors as $error): ?>
                        <li><?=$error;?></li>
                        <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            <div class="container">
            <form action="" method="post">
                <input type="hidden" name="professionalExperience[id]" value="<?=$_GET['id'] ?? ''?>" />
                
                <label for="employer_name">Company Name:</label>
                <input type="text" name="professionalExperience[employer_name]" id="employer_name" value="<?=$item->employer_name ?? ''?>" class="white-text"/>

                <label for="duties">Duties Performed:</label>
                <textarea name="professionalExperience[duties]" id="duties" cols="30" rows="10" class="materialize-textarea white-text"><?=$item->duties ?? ''?></textarea>
                
                <label for="employer_url">Enter website URL </label>
                <input type="url" name="professionalExperience[employer_url]" id="employer_url" value="<?=$item->employer_url ?? ''?>" class="white-text" />

                <label for="start_year">Year started:</label>
                <input type="number" name="professionalExperience[start_year]" id="start_year" value="<?=$item->start_year ?? ''?>" class="white-text" />
                
                <label for="end_year">Year Left/ Ended:</label>
                <input type="number" name="professionalExperience[end_year]" id="end_year" value="<?=$item->end_year ?? ''?>"class="white-text" />

                <input type="submit" value="Submit"/>
            </form>
            </div>
        </div>
    </div>
</main>