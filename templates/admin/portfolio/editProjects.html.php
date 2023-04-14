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
            <div class="container">
            <script src="/scripts/materialize-forms.js" defer></script>
            <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="project[id]" value="<?=$_GET['id'] ?? ''?>" />
                
                <label for="project_title">Project Title:</label>
                <input type="text" name="project[project_title]" id="project_title" value="<?=$item->project_title ?? ''?>" class="white-text"/>

                <label for="project_desc">Description:</label><br />
                <!--<i class="material-icons prefix">mode_edit</i>-->
                <textarea name="project[project_desc]" id="project_desc" cols="30" rows="10" maxlength="512" class="materialize-textarea white-text"><?=$item->project_desc ?? ''?></textarea>
                
                <label for="primary_image_url">Enter full URL for image: </label>
                <input type="text" name="project[primary_image_url]" id="primary_image_url" value="<?=$item->primary_image_url ?? ''?>" class="white-text" />

                <label for="primary_image_alt_text">Image URL alt-text:</label>
                <input type="text" name="project[primary_image_alt_text]" id="primary_image_alt_text" value="<?=$item->primary_image_alt_text ?? ''?>" class="white-text" />
                
                <label for="github_url">GitHub Repository URL:</label>
                <input type="text" name="project[github_url]" id="github_url" value="<?=$item->github_url ?? ''?>"class="white-text" />

                <label for="github_url_name">GitHub Repository Name:</label>
                <input type="text" name="project[github_url_name]" id="github_url_name" value="<?=$item->github_url_name ?? ''?>"class="white-text" />

                <label for="other_url">Other/ Demo URL:</label>
                <input type="text" name="project[other_url]" id="other_url" value="<?=$item->other_url ?? ''?>"class="white-text" />

                <label for="other_url_name">Name of URL:</label>
                <input type="text" name="project[other_url_name]" id="other_url_name" value="<?=$item->other_url_name ?? ''?>"class="white-text" />
                
                
                <div class="input-field white-text">
                <label for="project_type">Select Project Type: (click below - may not be properly visible)</label> <br />
                <select name="project[project_type]" id="project_type" class="white-text">
                    <?php if($item->project_type == 'university'){
                        echo "<option class=\"white-text\" selected=\"selected\" value=\"university\">University</option>\r\n";
                        echo "<option class=\"white-text\" value=\"personal\" class=\white-text\">Personal</option>\r\n";
                    }
                    else if($item->project_type == 'personal'){
                        echo "<option class=\"white-text\" selected=\"selected\" value=\"personal\">Personal</option>\r\n";
                        echo "<option class=\"white-text\" value=\"university\">University</option>\r\n";
                    }
                    else { ?>
                        <option class="white-text" selected="selected" value="personal">Personal</option>
                        <option class="white-text" value="university">University</option>
                    <?php } ?>
                </select>
                </div>

                <div class="input-field white-text">
                <script src="/scripts/projects-form-images.js" defer></script>
                    <label for="multiple_images">Is this an extended project (if yes, you will need to edit this project after initial submission)?</label><br />
                    <select name="project[multiple_images]" id="multiple_images">
                        <?php if($item->multiple_images == 'true'){ ?>

                            <option value="true" selected="selected">Yes</option>
                            <option value="false">No</option>
                        <?php }
                        else if($item->multiple_images == 'false'){ ?>
                            <option value="false" selected="selected">No</option>
                            <option value="true">Yes</option>
                        <?php } else {?>
                            <option value="false" selected="selected">No</option>
                            <option value="true">Yes</option>
                        <?php } ?>
                    </select>
                </div>
                <br />
                <div class="input-field white-text" id="imageUpload">
                    <label for="images">Image(s) Upload</label><br /><br />
                    <input type="file" name="images[]" id="" multiple><br />
                </div>
                <div class="input-field white-text" id="extended_details">
                    <label for="extended_details">Extended Details:</label> <br />
                    <textarea name="project[extended_details]" id="extended_details" cols="30" rows="10" class="materialize-textarea white-text"><?=$item->extended_details ?? ''?></textarea>
                </div>

                <input type="submit" value="Submit"/>
            </form>
            </div>
        </div>
    </div>

</main>