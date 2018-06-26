<div class="row">
    <div class="card w-100">
        <? if (isset($this->data['student'])) $student = $this->data['student']; ?>
        <div class="card-header">
            <h5 class="card-title">
                <?php if (isset($student)) echo "Edit "; else echo "Add "; ?>
                <?php  if ($this->data['type'] == "graduate") { ?>
                    Graduate Student
                <?php  } else if ($this->data['type'] == "nonMatriculating") { ?>
                    Non Matriculating Student
                <?php  } else { ?>
                    Undergraduate Student
                <?php  } ?>
            </h5>
        </div>
        <? if (isset($this->data['error'])) { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $this->data['error']; ?>
            </div>
        <?php } ?>
        <div class="card-body">
            <form action="<?php if (isset($student)) {
                echo BASE_URL . "student/edit/" . $this->data['type'] . "/" . $student['s_id'] . "/validate";
            } else echo BASE_URL . "student/add/" . $this->data['type'] . "/validate"; ?>" method="post" class="needs-validation" novalidate>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="inputName" class="bmd-label-floating">Name</label>
                            <input type="text" class="form-control" name="name" id="inputName" value="<?php if (isset($student)) echo $student['name']; ?>" required>
                            <div class="invalid-feedback">Name is required</div>
                        </div>
                        <div class="form-group">
                            <label for="inputAddress" class="bmd-label-floating">Address</label>
                            <input type="text" class="form-control" name="address" id="inputAddress" value="<?php if (isset($student)) echo $student['address']; ?>" required>
                            <div class="invalid-feedback">Address is required</div>
                        </div>
                        <div class="form-group">
                            <label for="inputStatus" class="bmd-label-floating">Status</label>
                            <select class="form-control" name="status" id="inputStatus">
                                <option value="Active">Active</option>
                                <option value="Non Active">Non Active</option>
                            </select>
                        </div>
                        <?php  if ($this->data['type'] == "graduate") { ?>
                        <div class="form-group">
                            <label for="inputUGMajor" class="bmd-label-floating">Undergraduate Major</label>
                            <input type="text" class="form-control" name="ug_major" id="inputUGMajor" value="<?php if (isset($student)) echo $student['ug_major']; ?>" required>
                            <div class="invalid-feedback">Undergraduate major is required</div>
                        </div>
                        <?php  } else if ($this->data['type'] == "nonMatriculating") { ?>
                        <div class="form-group">
                            <label for="inputStudyHours" class="bmd-label-floating">Study Hours</label>
                            <input type="text" class="form-control" name="study_hours" id="inputStudyHours" value="<?php if (isset($student)) echo $student['study_hours']; ?>" required>
                            <div class="invalid-feedback">Study hours is required</div>
                        </div>
                        <?php  } ?>
                        <input type="hidden" value="<?php if (isset($student)) echo $student['s_id']; ?>" name="s_id" />
                        <button type="submit" class="btn btn-raised btn-info action-submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
