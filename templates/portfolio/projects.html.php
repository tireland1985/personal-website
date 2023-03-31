<main id="portfolio-page">
    <div class="row">
        <?php require_once('../templates/portfolio/view_types.html.php'); ?>
    </div>

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
                            <a href="#">no link (yet)</a>
                        <?php endif; ?>


                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>