<div class="row">
    <div class="card w-100">
        <div class="card-header">
            <h5 class="card-title">
                <a href="<?php echo BASE_URL;?>" class="btn btn-secondary bmd-btn-icon"><i class="material-icons">arrow_back</i></a>&nbsp;
                Departments
                <a href="department/add" class="btn btn-raised btn-info ml-2">ADD</a>
            </h5>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                <tr>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Location</th>
                    <th>Head</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($this->data['departments'] as $department) { ?>
                    <tr >
                        <td><?php echo $department['d_code']?></td>
                        <td><?php echo $department['d_name']?></td>
                        <td><?php echo $department['phone']?></td>
                        <td><?php echo $department['d_location']?></td>
                        <td><?php  if (isset($department['head_name'])) echo $department['head_name']; else  echo "N/A"; ?></td>
                        <td>
                            <a href="department/edit/<?php echo $department['d_code'] ?>" class="btn bmd-btn-icon">
                                <i class="material-icons">edit</i>
                            </a>
                            <a href="department/delete/<?php echo $department['d_code'] ?>" class="btn bmd-btn-icon">
                                <i class="material-icons">delete</i>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
