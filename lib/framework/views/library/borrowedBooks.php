<div class="row">
    <div class="col-12 mt-4">
        <div class="card w-100">
            <div class="card-header">
                <h5 class="card-title">Books borrowed</h5>
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
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
