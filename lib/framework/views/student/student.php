<div class="row">
    <div class="card w-100">
        <div class="card-header">
            <h5 class="card-title">
                <a href="<?php echo BASE_URL;?>" class="btn btn-secondary bmd-btn-icon"><i class="material-icons">arrow_back</i></a>&nbsp;
                <?php  if ($this->data['type'] == "graduate") { ?>
                    Graduate Students
                <?php  } else if ($this->data['type'] == "nonMatriculating") { ?>
                    Non Matriculating Students
                <?php  } else { ?>
                    Undergraduate Students
                <?php  } ?>
                <a href="add/<?php echo $this->data['type'] ?>" class="btn btn-raised btn-info ml-2">ADD</a>
            </h5>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Status</th>
                    <?php  if ($this->data['type'] == "graduate") { ?><th>Undergraduate Major</th><?php } ?>
                    <?php  if ($this->data['type'] == "nonMatriculating") { ?><th>Study Hours</th><?php } ?>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($this->data['students'] as $student) { ?>
                    <tr >
                        <td><?php echo $student['s_id']?></td>
                        <td><?php echo $student['name']?></td>
                        <td><?php echo $student['address']?></td>
                        <td><?php echo $student['status']?></td>
                        <?php  if (isset($student['ug_major'])) { ?><td><?php echo $student['ug_major']; ?></td><?php } ?>
                        <?php  if (isset($student['study_hours'])) { ?><td><?php echo $student['study_hours']; ?></td><?php } ?>
                        <td>
                            <a href="edit/<?php echo $this->data['type'] . "/" . $student['s_id'] ?>" class="btn bmd-btn-icon">
                                <i class="material-icons">edit</i>
                            </a>
                            <a href="delete/<?php echo $this->data['type'] . "/" . $student['s_id'] ?>" class="btn bmd-btn-icon">
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
