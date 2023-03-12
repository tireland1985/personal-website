<main id="cv-page">
    <div class="cv-container">
        <div class="row">
            <div class="col s12 m12 center">
                <h2 class="header">Other Experience</h2>
                <img src="https://timireland.uk/images/homelab_1.jpg" alt="homelab picture" class="profile center">
                    <?php foreach($otherExperienceList as $row){ ?>
                        <div class="card horizontal card-opacity-cv white-text">
                            <h4><?=$row->title ?? ''?></h4>
                            <?=$row->details ?? '' ?>
                        </div>

                    <?php } ?>
            </div>
        </div>
    </div>
</main>