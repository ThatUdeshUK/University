<div class="modal fade" id="borrowModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="borrowBook" method="post">
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

<div class="row">
    <div class="card w-100">
        <div class="card-header">
            <h5 class="card-title">
                Borrowed Books
                <button type="button" class="btn btn-raised btn-info ml-2"  data-toggle="modal" data-target="#borrowModel">BORROW BOOK</button>
            </h5>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                <tr>
                    <th>Book ID</th>
                    <th>ISBN</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Student Id</th>
                    <th>Student Name</th>
                    <?php if ($this->data['can_edit']) { ?><th>Actions</th><?php } ?>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($this->data['books'] as $book) { ?>
                    <tr >
                        <td><?php echo $book['b_id']?></td>
                        <td><?php echo $book['isbn']?></td>
                        <td><?php echo $book['title']?></td>
                        <td><?php echo $book['author']?></td>
                        <td><?php echo $book['s_id']?></td>
                        <td><?php echo $book['name']?></td>
                        <?php if ($this->data['can_edit']) { ?>
                            <td>
                                <a href="library/returnBook/<?php echo $book['b_id'] ?>" class="btn bmd-btn-icon">
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
