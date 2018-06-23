<div class="row">
    <?php if($_SESSION['type'] = 'director') { ?>
        <div class="action-container col-12 col-md-6 col-lg-4">
            <a href="department" class="btn action">
                <i class="material-icons action-icon">
                    business
                </i>
                <div class="action-text">
                    Departments
                </div>
            </a>
        </div>
        <div class="action-container col-12 col-md-6 col-lg-4">
            <a href="professor" class="btn action">
                <i class="material-icons action-icon">
                    person
                </i>
                <div class="action-text">
                    Professors
                </div>
            </a>
        </div>
    <?php } ?>
</div>
