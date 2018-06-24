<div class="row">
    <div class="card w-100">
        <? if (isset($this->data['book'])) $book = $this->data['book']; ?>
        <div class="card-header">
            <h5 class="card-title"><?php if (isset($book)) echo "Edit"; else echo "Add"; ?> Book</h5>
        </div>
        <div class="card-body">
            <form action="<?php if (isset($book)) {
                echo $book['b_id'] . "/validate";
            } else echo "addBook/validate";?>" method="post">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="inputISBN" class="bmd-label-floating">ISBN</label>
                            <input type="text" class="form-control" name="isbn" id="inputISBN" value="<?php if (isset($book)) echo $book['isbn']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="inputTitle" class="bmd-label-floating">Title</label>
                            <input type="text" class="form-control" name="title" id="inputTitle" value="<?php if (isset($book)) echo $book['title']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="inputAuthor" class="bmd-label-floating">Author</label>
                            <input type="text" class="form-control" name="author" id="inputAuthor" value="<?php if (isset($book)) echo $book['author']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="inputYear" class="bmd-label-floating">Year</label>
                            <input type="text" class="form-control" name="year" id="inputYear" value="<?php if (isset($book)) echo $book['year']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="inputPublisher" class="bmd-label-floating">Publisher</label>
                            <input type="text" class="form-control" name="publisher" id="inputPublisher" value="<?php if (isset($book)) echo $book['publisher']; ?>">
                        </div>
                        <input type="hidden" value="<?php if (isset($book)) echo $book['b_id']; ?>" name="code" />
                        <button type="submit" class="btn btn-raised btn-info action-submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>