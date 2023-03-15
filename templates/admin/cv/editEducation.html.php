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
            <h2>Edit Education:</h2>
            <?php if(count($errors) >0): ?>
                <p>Unable to edit or add to education, please check the following:</p>
                <ul>
                    <?php foreach($errors as $error): ?>
                        <li><?=$error;?></li>
                        <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <form action="" method="post">
                <input type="hidden" name="education[id]" value="<?=$_GET['id'] ?? ''?>" />
                
                <label for="institute_name">Educational Facility Name:</label>
                <input type="text" name="education[institute_name]" id="institute_name" value="<?=$item->institute_name ?? ''?>" class="white-text"/>

                <label for="course_names">Courses Studied:</label>
                <textarea name="education[course_names]" id="course_names" cols="30" rows="10" class="white-text">
                    <?=$item->course_names ?? ''?>
                </textarea>
                
                <label for="institute_url">Enter website URL </label>
                <input type="text" name="education[institute_uel]" id="institute_url" value="<?=$item->institute_url ?? ''?>" class="white-text" />

                <label for="start_year">Start Year of course(s)</label>
                <input type="number" name="education[start_year]" id="start_year" value="<?=$item->start_year ?? ''?>" class="white-text" />
                
                <label for="end_year">End/ Graduation Year:</label>
                <input type="number" name="education[end_year]" id="end_year" value="<?=$item->end_year ?? ''?>"class="white-text" />

                <input type="submit" value="Submit"/>
            </form>
        </div>
    </div>
</main>