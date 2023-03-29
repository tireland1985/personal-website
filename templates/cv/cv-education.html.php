<main id="cv-page">
<div class="row">
    <div class="col s12 m12 center white-text">
        <h2 class="header">Education</h2>
        <div class="cv-container">
            <?php foreach($educationList as $row): ?>
                <div class="card horizontal center card-opacity-cv">
                    <div class="card-stacked">
                        <div class="card-content">
                            <h3><a href="<?=$row->institute_url ?? ''?>"><?=$row->institute_name ?? '' ?></a></h3>
                            <?php if(!empty($row->start_year) && !empty($row->end_year)): ?>
                                <h4><?=$row->start_year ?? ''?> - <?=$row->end_year ?? '' ?></h4>
                            <?php endif; 
                            if(!empty($row->start_year) && empty($row->end_year)): ?>
                                <h4><?=$row->start_year ?? ''?></h4>
                            <?php endif; ?>
                            
                            <p class="cv-text"><?=$row->course_names ?? '' ?></p>
                        </div>
                    </div>
                </div>
          <?php  endforeach; ?>
            </div>
    </div>
</div>
</main>