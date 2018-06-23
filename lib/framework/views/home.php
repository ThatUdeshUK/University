<div class="row">
    <?php if($_SESSION['type'] = 'director') { ?>
        <div class="action-container col-12 col-md-6 col-lg-4">
            <a href="department" class="btn btn-raised action">
                <i class="material-icons action-icon">
                    business
                </i>
                <div class="action-text">
                    Department
                </div>
            </a>
        </div>
        <div class="action-container col-12 col-md-6 col-lg-4">
            <a href="" class="btn btn-raised action">
                <i class="material-icons action-icon">
                    person
                </i>
                <div class="action-text">
                    Professor
                </div>
            </a>
        </div>
    <?php } ?>
</div>
