<div class="row">
    <div class="card w-100">
        <? if (isset($this->data['book'])) $book = $this->data['book']; ?>
        <div class="card-header">
            <h5 class="card-title">
                <a href="<?php echo BASE_URL;?>library" class="btn btn-secondary bmd-btn-icon"><i class="material-icons">arrow_back</i></a>&nbsp;
                <?php if (isset($book)) echo "Edit"; else echo "Add"; ?> Book
            </h5>
        </div>
        <? if (isset($this->data['error'])) { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $this->data['error']; ?>
            </div>
        <?php } ?>
        <div class="card-body">
            <form action="<?php if (isset($book)) {
                echo BASE_URL . "library/editBook/" .$book['b_id'] . "/validate";
            } else echo BASE_URL . "library/addBook/validate";?>" method="post" class="needs-validation" novalidate>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="inputISBN" class="bmd-label-floating">ISBN</label>
                            <input type="text" class="form-control" name="isbn" id="inputISBN" value="<?php if (isset($book)) echo $book['isbn']; ?>" required>
                            <div class="invalid-feedback">ISBN is required</div>
                        </div>
                        <div class="form-group">
                            <label for="inputTitle" class="bmd-label-floating">Title</label>
                            <input type="text" class="form-control" name="title" id="inputTitle" value="<?php if (isset($book)) echo $book['title']; ?>" required>
                            <div class="invalid-feedback">Title is required</div>
                        </div>
                        <div class="form-group">
                            <label for="inputAuthor" class="bmd-label-floating">Author</label>
                            <input type="text" class="form-control" name="author" id="inputAuthor" value="<?php if (isset($book)) echo $book['author']; ?>" required>
                            <div class="invalid-feedback">Author is required</div>
                        </div>
                        <div class="form-group">
                            <label for="inputYear" class="bmd-label-floating">Year</label>
                            <input type="text" class="form-control" name="year" id="inputYear" value="<?php if (isset($book)) echo $book['year']; ?>" required>
                            <div class="invalid-feedback">Year is required</div>
                        </div>
                        <div class="form-group">
                            <label for="inputPublisher" class="bmd-label-floating">Publisher</label>
                            <input type="text" class="form-control" name="publisher" id="inputPublisher" value="<?php if (isset($book)) echo $book['publisher']; ?>" required>
                            <div class="invalid-feedback">Publisher is required</div>
                        </div>
                        <input type="hidden" value="<?php if (isset($book)) echo $book['b_id']; ?>" name="code" />
                        <button type="submit" class="btn btn-raised btn-info action-submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
