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
            <h2>Edit Projects:</h2>
            <?php if(count($errors) >0): ?>
                <p>Unable to edit or add project, please check the following:</p>
                <ul>
                    <?php foreach($errors as $error): ?>
                        <li><?=$error;?></li>
                        <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <form action="" method="post">
                <input type="hidden" name="project[id]" value="<?=$_GET['id'] ?? ''?>" />
                
                <label for="project_title">Project Title:</label>
                <input type="text" name="project[project_title]" id="project_title" value="<?=$item->project_title ?? ''?>" class="white-text"/>

                <label for="project_desc">Description:</label>
                <textarea name="project[project_desc]" id="project_desc" cols="30" rows="10" class="white-text">
                    <?=$item->project_desc ?? ''?>
                </textarea>
                
                <label for="image_url">Enter full URL for image: </label>
                <input type="text" name="project[image_url]" id="image_url" value="<?=$item->image_url ?? ''?>" class="white-text" />

                <label for="image_alt_text">Image URL alt-text:</label>
                <input type="text" name="project[image_alt_text]" id="image_alt_text" value="<?=$item->image_alt_text ?? ''?>" class="white-text" />
                
                <label for="github_url">GitHub Repository URL:</label>
                <input type="text" name="project[github_url]" id="github_url" value="<?=$item->github_url ?? ''?>"class="white-text" />

                <label for="github_url_name">GitHub Repository Name:</label>
                <input type="text" name="project[github_url_name]" id="github_url_name" value="<?=$item->github_url_name ?? ''?>"class="white-text" />

                <label for="other_url">Other/ Demo URL:</label>
                <input type="text" name="project[other_url]" id="other_url" value="<?=$item->other_url ?? ''?>"class="white-text" />

                <label for="other_url_name">Name of URL:</label>
                <input type="text" name="project[other_url_name]" id="other_url_name" value="<?=$item->other_url_name ?? ''?>"class="white-text" />

                <label for="project_type">Select Project Type: (click below - may not be properly visible)</label>
                <select name="project[project_type]" id="project_type">
                    <?php if($item->project_type == 'university'){
                        echo "<option selected=\"selected\" value=\"university\">University</option>\r\n";
                        echo "<option value=\"personal\">Personal</option>\r\n";
                    }
                    else if($item->project_type == 'personal'){
                        echo "<option selected=\"selected\" value=\"personal\">Personal</option>\r\n";
                        echo "<option value=\"university\">University</option>\r\n";
                    }
                    else { ?>
                        <option selected="selected" value="personal">Personal</option>
                        <option value="university">University</option>
                    <?php } ?>
                </select>

                <input type="submit" value="Submit"/>
            </form>
        </div>
    </div>
</main>