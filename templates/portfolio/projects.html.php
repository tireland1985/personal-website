<main id="portfolio-page">
    <div class="row">
        <?php require_once('../templates/portfolio/view_types.html.php'); ?>
    </div>
<?php if(isset($_GET['id'])){
    // TODO:
    // load the specified project *if* it is listed as an extended project in the database
//    var_dump($project);
//    var_dump($images);
    //$projectObject = json_encode($project);
    //var_dump($projectObject);
   
    //$project = $test;
    //echo "extended project: " . $project->multiple_images;

 //   $test = (object)$project;
 //   var_dump($test);
    foreach($project as $row){ 
        if($row->multiple_images == 'true'){
        // load and display all the project images as a gallery ?>
        <!-- load the Material Box plugin -->
        <script src="/scripts/material-box.js"></script>
        <div class="row">
            <div class="col m12 s12 center">
                <h2><?=$row->project_title;?></h2>
            </div>
            <!-- remove the below paragraph once image functionality is finished-->
            <p class="center">project images will display here..</p>
            <?php foreach($images as $img){ ?>
                <div class="col m4">
                    <div class="card card-opacity-portfolio">
                        <div class="card-image">
                            <img src="<?=$img->file_name;?>" alt="<?=$img->image_title;?>" class="materialboxed">
                        </div>
                    </div>
                </div>
           <?php } ?>
        </div>
        <div class="row">
            <div class="col s12 m12 center white-text">
                <article>
                    <?=$row->extended_details;?>
                </article>
            </div>
        </div>
        <?php    }else {?>
            <div class="row">
                <div class="col m12 s12 center">
                    <h2 class="white-text center">No further details for the specified project exist.</h2>
                </div>
            </div>
        <?php } 
        }
} 
else {?>
    <div class="row">
        <?php foreach($projectsList as $row): ?>
            <div class="col m4">
                <div class="card card-opacity-portfolio">
                    <div class="card-image">
                        <img class="lazy-load"
                            src="https://cdn.glitch.com/3a5b333c-942b-4088-9930-e7ea1e516118%2Fplaceholder.png?v=1560442648212"
                            data-src="<?=$row->primary_image_url ?? ''?>"
                            alt="<?=$row->primary_image_alt_text ?? '' ?>"/>
                        <span class="card-title"><?=$row->project_title ?? ''?></span>
                    </div>
                    <div class="card-content">
                        <p><?=$row->project_desc ?? ''?></p>
                    </div>
                    <div class="card-action">
                        <?php if(isset($row->github_url) && !empty($row->github_url)): ?>
                            <a href="<?=$row->github_url ?? ''?>"><?=$row->github_url_name ?? ''?></a> &emsp;
                        <?php endif;
                        if(isset($row->other_url) && !empty($row->other_url)): ?>
                            <a href="<?=$row->other_url ?? ''?>"><?=$row->other_url_name ?? '' ?></a> &emsp;
                        <?php endif;
                        if(isset($row->multiple_images) && $row->multiple_images == 'true'): ?>
                            <a href="/portfolio/projects?id=<?=$row->id ?? ''?>">More Info</a>
                        <?php endif;
                        if(empty($row->github_url) && empty($row->other_url) && $row->multiple_images !== 'true'): ?>
                            <a href="#">no further details (yet)</a>
                        <?php endif; ?>


                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <?php } ?>
</main>
