<div class="row">
    <div class="card w-100">
        <div class="card-header">
            <h5 class="card-title">
                Professors
                <a href="professor/add" class="btn btn-raised btn-info ml-2">ADD</a>
            </h5>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                <tr>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Office</th>
                    <th>Department</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($this->data['professors'] as $professor) { ?>
                    <tr >
                        <td><?php echo $professor['e_id']?></td>
                        <td><?php echo $professor['p_name']?></td>
                        <td><?php echo $professor['phone']?></td>
                        <td><?php echo $professor['office']?></td>
                        <td><?php  if (isset($professor['department'])) echo $professor['department']; else  echo "N/A"; ?></td>
                        <td>
                            <a href="professor/edit/<?php echo $professor['e_id'] ?>" class="btn bmd-btn-icon">
                                <i class="material-icons">edit</i>
                            </a>
                            <a href="professor/delete/<?php echo $professor['e_id'] ?>" class="btn bmd-btn-icon">
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
