<main id="cv-page">
    <div class="cv-container">
        <h2 class="header">Professional Experience</h2>
        <div class="row">
            <div class="col s12 m12 center">
                <?php foreach($employmentList as $row){ ?>
                    <div class="card horizontal center card-opacity-cv white-text">
                        <div class="card-stacked">
                            <div class="card-content">
                                <h4><a href="<?=$row->employer_url ?? '' ?>"><?=$row->employer_name ?? '' ?></a></h4>
                                <?php if(!empty($row->start_date) && !empty($row->end_date)){ ?>
                                <p class="cv-text"><?=$row->start_date ?? '' ?> - <?=$row->end_date ?? '' ?></p>
                                <?php } 
                                if(!empty($row->start_date) && empty($row->end_date)){ ?>
                                    <p class="cv-text"><?=$row->start_date ?? ''?> - present</p>
                                <?php } ?>
                                <p class="cv-text"><?=$row->duties ?? '' ?></p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</main>