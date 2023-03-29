<main id="cv-page">
    <div class="cv-container">
        <div class="row col s12 m12 center">
            <h2 class="header">Other Experience</h2>
            <img src="https://timireland.uk/images/homelab_1.jpg" alt="homelab">
        </div>
    </div>
    <?php foreach($otherExperienceList as $row): ?>
        <div class="cv-container">
        <div class="row">
            <div class="col s12 m12 center">
                <div class="card horizontal card-opacity-cv center white-text">
                    <div class="card-stacked">
                        <div class="card-content">
                            <h4><?=$row->title ?? ''?></h4>
                            <br />
                            <?=$row->details ?? '' ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</main>