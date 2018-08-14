<div class="row">
    <div class="card w-100">
        <div class="card-header">
            <h5 class="card-title">
                <a href="<?php echo BASE_URL;?>" class="btn btn-secondary bmd-btn-icon"><i class="material-icons">arrow_back</i></a>&nbsp;
                Courses
                <?php if ($this->data['can_edit']) {?>
                    <a href="course/add" class="btn btn-raised btn-info ml-2">ADD</a>
                <?php } ?>
            </h5>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                <tr>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Credit</th>
                    <th>Hours</th>
                    <th>College</th>
                    <th>Prerequisite</th>
                    <th>Department</th>
                    <?php if ($this->data['can_edit']) {?>
                        <th>Actions</th>
                    <?php } ?>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($this->data['courses'] as $course) { ?>
                    <tr >
                        <td><?php echo $course['c_code']?></td>
                        <td><?php echo $course['name']?></td>
                        <td><?php echo $course['credit']?></td>
                        <td><?php echo $course['hours']?></td>
                        <td><?php echo $course['college']?></td>
                        <td><?php if (isset($course['prerequisite_name']))echo $course['prerequisite_name']?></td>
                        <td><?php  if (isset($course['department'])) echo $course['department']; else  echo "N/A"; ?></td>
                        <?php if ($this->data['can_edit']) {?>
                            <td>
                                <a href="course/edit/<?php echo $course['c_code'] ?>" class="btn bmd-btn-icon">
                                    <i class="material-icons">edit</i>
                                </a>
                                <a href="course/delete/<?php echo $course['c_code'] ?>" class="btn bmd-btn-icon">
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
