<main id="cv-page">
    <div class="row">
        <div class="col s12 m12 center">
            <h1>Skills</h1>
            <h2>Click an item for more details</h2>
            <?php foreach($skillsList as $row){ ?>
                <a href="#<?=$row->modal_name ?? ''?>" class="btn modal-trigger waves-effect waves-light card-opacity-cv" id="skillsModal"><?=$row->skill_name ?? ''?></a>

                <div class="modal card-opacity-cv" id="<?=$row->modal_name ?? ''?>">
                    <div class="modal-content card-opacity-cv white-text">
                        <h4><?=$row->skill_name_long ?? ''?></h4>
                        <p><?=$row->skill_desc ?? ''?></p>
                    </div>
                    <div class="modal-footer card-opacity-cv">
                        <a href="#!" class="modal-action modal-close btn blue darken-4 white-text">Close</a>
                    </div>
                </div> &nbsp; &nbsp;
            <?php } ?>
        </div>
    </div>
</main>