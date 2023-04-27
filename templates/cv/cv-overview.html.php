<main id="cv-page">
    <div class="row">
        <div class="col s12 m12 center white-text">
            <h1 class="center">Timothy Andrew Ireland</h1>
            <h2 class="center">CV</h2>
            <img src="/images/tim.jpg" alt="profile picture" class="profile center">

        </div>
    </div>

    <div class="cv-container">
        <div class="row">
            <div class="col s12 m12 center">
                <h2 class="header" id="education">Education</h2>
                    <div class="card horizontal card-opacity-cv center">
                        <div class="card-stacked">
                            <div class="card-content">
                                <?php foreach($educationList as $education): ?>
                                    <h3><a href="<?=$education->institute_url ?? '' ?>"><?=$education->institute_name ?? ''?></a></h3>
                                    <?php if(!empty($education->start_year) && !empty($education->end_year)){ ?>
                                        <h4><?=$education->start_year ?? ''?> - <?=$education->end_year ?? '' ?></h4>
                                    <?php } 
                                    if(!empty($education->start_year) && empty($education->end_year)){ ?>
                                        <h4><?=$education->start_year ?? ''?></h4>
                                    <?php }?>   

                                    <p class="cv-text"><?=$education->course_names ?? ''?></p>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
            </div>            
        </div>
        <div class="row">
            <div class="col s12 m12 center">
                <h2 class="header" id="certifications">Professional Certifications</h2>
                <div class="card horizontal card-opacity-cv center">
                    <div class="card-stacked">
                        <div class="card-content">
                            <?php foreach($certsList as $certs): ?>
                                <h3><a href="<?=$certs->vendor_url ?? '' ?>"><?=$certs->vendor_name ?? '' ?></a></h3>
                                <p class="cv-text"><?=$certs->cert_name ?? '' ?> - &emsp; <?=$certs->vaid_from ?? '' ?> - <?=$certs->valid_to ?? ''?></p>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s12 m12 center">
                <h2 class="header" id="pro-exp">Professional Experience</h2>
                    <?php foreach($employmentList as $row): ?>
                        <div class="card horizontal card-opacity-cv center">
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
                    <?php endforeach; ?>
            </div>
        </div>

        <div class="row">
            <div class="col s12 m12 center">
                <h2 class="header" id="other-exp">Other Experience</h2>
                <img src="/images/homelab_1.jpg" alt="homelab picture" class="profile center">
                <?php foreach($otherExperienceList as $row): ?>
                    <div class="card horizontal card-opacity-cv center">
                        <div class="card-stacked">
                            <div class="card-content">
                                <h4><?=$row->title ?? ''?></h4>
                                <br />
                                <?=$row->details ?? '' ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="row">
            <div class="col s12 m12 center">
                <h2 class="header" id="skills">Skills</h2>
                <div class="card horizontal card-opacity-cv center">
                    <div class="card-stacked">
                        <div class="card-content">
                            <div id="cvSkillsList">
                                <?php foreach($skillsList as $row): ?>
                                    <span class="label label-default"><?=$row->skill_name ?? '' ?></span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>