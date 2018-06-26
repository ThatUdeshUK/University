<div class="row">
    <?php if($_SESSION['type'] == 'director') { ?>
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
    <?php } else if($_SESSION['type'] == 'librarian') { ?>
        <div class="action-container col-12 col-md-6 col-lg-4">
            <a href="library" class="btn action">
                <i class="material-icons action-icon">
                    book
                </i>
                <div class="action-text">
                    Library
                </div>
            </a>
        </div>
        <div class="action-container col-12 col-md-6 col-lg-4">
            <a href="library/borrowed" class="btn action">
                <i class="material-icons action-icon">
                    bookmark
                </i>
                <div class="action-text">
                    Borrow
                </div>
            </a>
        </div>
    <?php } else if($_SESSION['type'] == 'registrar') { ?>
        <div class="action-container col-12 col-md-6 col-lg-4">
            <a href="student/undergraduate" class="btn action">
                <i class="material-icons action-icon">
                    person
                </i>
                <div class="action-text">
                    Undergraduate
                </div>
            </a>
        </div>
        <div class="action-container col-12 col-md-6 col-lg-4">
            <a href="student/graduate" class="btn action">
                <i class="material-icons action-icon">
                    person
                </i>
                <div class="action-text">
                    Graduate
                </div>
            </a>
        </div>
        <div class="action-container col-12 col-md-6 col-lg-4">
            <a href="student/nonMatriculating" class="btn action">
                <i class="material-icons action-icon">
                    person
                </i>
                <div class="action-text">
                    Non Matriculating
                </div>
            </a>
        </div>
    <?php } else if($_SESSION['type'] == 'student') { ?>
        <div class="action-container col-12 col-md-6 col-lg-4">
            <a href="course" class="btn action">
                <i class="material-icons action-icon">
                    info
                </i>
                <div class="action-text">
                    Courses
                </div>
            </a>
        </div>
        <div class="action-container col-12 col-md-6 col-lg-4">
            <a href="library/borrowedBooks" class="btn action">
                <i class="material-icons action-icon">
                    book
                </i>
                <div class="action-text">
                    Books
                </div>
            </a>
        </div>
    <?php } else if($_SESSION['type'] == 'professor') { ?>
        <div class="action-container col-12 col-md-6 col-lg-4">
            <a href="course" class="btn action">
                <i class="material-icons action-icon">
                    info
                </i>
                <div class="action-text">
                    Courses
                </div>
            </a>
        </div>
    <?php } ?>
</div>
