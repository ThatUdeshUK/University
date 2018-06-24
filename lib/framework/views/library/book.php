<div class="row">
    <div class="card w-100">
        <div class="card-header">
            <h5 class="card-title">
                Books
                <a href="library/addBook" class="btn btn-raised btn-info ml-2">ADD BOOK</a>
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
                    <th>Year</th>
                    <th>Publisher</th>
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
                        <td><?php echo $book['year']?></td>
                        <td><?php echo $book['publisher']?></td>
                        <?php if ($this->data['can_edit']) { ?>
                            <td>
                                <a href="library/editBook/<?php echo $book['b_id'] ?>" class="btn bmd-btn-icon">
                                    <i class="material-icons">edit</i>
                                </a>
                                <a href="library/deleteBook/<?php echo $book['b_id'] ?>" class="btn bmd-btn-icon">
                                    <i class="material-icons">delete</i>
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
