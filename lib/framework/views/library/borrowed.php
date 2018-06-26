<div class="modal fade" id="borrowModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?php echo BASE_URL ?>library/borrowBook" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Borrow Book</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="inputBId" class="bmd-label-floating">Book ID</label>
                        <input type="text" class="form-control" name="b_id" id="inputBId">
                    </div>
                    <div class="form-group">
                        <label for="inputSId" class="bmd-label-floating">Student ID</label>
                        <input type="text" class="form-control" name="s_id" id="inputSId">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-raised btn-info">Borrow</button>
                </div>
            </form>
        </div>
    </div>
</div>
<h5 class="card-title">
    Borrowed Books
    <button type="button" class="btn btn-raised btn-info ml-2"  data-toggle="modal" data-target="#borrowModel">BORROW BOOK</button>
</h5>
<div class="row">
    <div class=" col-6">
        <div class="card">
            <div class="card-body">
                <h6 class="text-secondary">Search by Book</h6>
                <form action="<?php echo BASE_URL ?>library/borrowed/book" method="get">
                    <div class="form-group">
                        <label for="inputBId" class="bmd-label-floating">Book ID</label>
                        <input type="text" class="form-control" name="b_id" id="inputBId" value="<?php if (isset($this->data['what']) && $this->data['what'] == "book") echo $this->data['id']; ?>">
                    </div>
                    <button type="submit" class="btn btn-raised btn-info float-right">Search</button>
                </form>
            </div>
        </div>
    </div>
    <div class=" col-6">
        <div class="card">
            <div class="card-body">
                <h6 class="text-secondary">Search by Student</h6>
                <form action="<?php echo BASE_URL ?>library/borrowed/by" method="get">
                    <div class="form-group">
                        <label for="inputSId" class="bmd-label-floating">Student ID</label>
                        <input type="text" class="form-control" name="s_id" id="inputSId" value="<?php if (isset($this->data['what']) && $this->data['what'] == "by") echo $this->data['id']; ?>">
                    </div>
                    <button type="submit" class="btn btn-raised btn-info float-right">Search</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php if (isset($this->data['what']) && $this->data['what'] == "book") { ?>
    <div class="row">
        <div class="col-12 mt-4">
            <div class="card w-100">
                <div class="card-header">
                    <h5 class="card-title">Students who borrowed book: <?php echo $this->data['id']?></h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Student ID</th>
                            <th>Name</th>
                            <th>Borrow Date</th>
                            <th>Return Date</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($this->data['students'] as $student) { ?>
                            <tr >
                                <td><?php echo $student['s_id']?></td>
                                <td><?php echo $student['name']?></td>
                                <td><?php echo $student['borrow_date']?></td>
                                <td><?php echo $student['return_date']?></td>
                                <?php if (!$student['return_date']) { ?>
                                    <td>
                                        <a href="<?php echo BASE_URL ?>library/returnBook/<?php echo $this->data['id']?>/<?php echo $student['s_id'] ?>" class="btn bmd-btn-icon">
                                            <i class="material-icons">bookmark_border</i>
                                        </a>
                                    </td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<?php if (isset($this->data['what']) && $this->data['what'] == "by") { ?>
    <div class="row">
        <div class="col-12 mt-4">
            <div class="card w-100">
                <div class="card-header">
                    <h5 class="card-title">Books borrowed by student: <?php echo $this->data['id']?></h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Book ID</th>
                            <th>ISBN</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Borrow Date</th>
                            <th>Return Date</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($this->data['books'] as $book) { ?>
                            <tr >
                                <td><?php echo $book['b_id']?></td>
                                <td><?php echo $book['isbn']?></td>
                                <td><?php echo $book['title']?></td>
                                <td><?php echo $book['author']?></td>
                                <td><?php echo $book['borrow_date']?></td>
                                <td><?php echo $book['return_date']?></td>
                                <?php if (!$book['return_date']) { ?>
                                    <td>
                                        <a href="<?php echo BASE_URL ?>library/returnBook/<?php echo $book['b_id'] ?>/<?php echo $this->data['id']?>" class="btn bmd-btn-icon">
                                            <i class="material-icons">bookmark_border</i>
                                        </a>
                                    </td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
