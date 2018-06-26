<div class="row">
    <div class="card w-100">
        <? if (isset($this->data['course'])) $course = $this->data['course']; ?>
        <div class="card-header">
            <h5 class="card-title"><?php if (isset($course)) echo "Edit"; else echo "Add"; ?> Course</h5>
        </div>
        <? if (sizeof($this->data['departments']) < 1) { ?>
            <div class="alert alert-warning" role="alert">
                No departments available :(
            </div>
        <?php } ?>
        <? if (isset($this->data['error'])) { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $this->data['error']; ?>
            </div>
        <?php } ?>
        <div class="card-body">
            <form action="<?php if (isset($course)) {
                echo BASE_URL . "course/edit/" . $course['c_code'] . "/validate";
            } else echo BASE_URL . "course/add/validate";?>" method="post" class="needs-validation" novalidate>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="inputName" class="bmd-label-floating">Name</label>
                            <input type="text" class="form-control" name="name" id="inputName" value="<?php if (isset($course['name'])) echo $course['name']; ?>" required>
                            <div class="invalid-feedback">Name is required</div>
                        </div>
                        <div class="form-group">
                            <label for="inputCredit" class="bmd-label-floating">Credit</label>
                            <input type="text" class="form-control" name="credit" id="inputCredit" value="<?php if (isset($course['credit'])) echo $course['credit']; ?>" required>
                            <div class="invalid-feedback">Credit is required</div>
                        </div>
                        <div class="form-group">
                            <label for="inputHours" class="bmd-label-floating">Hours</label>
                            <input type="text" class="form-control" name="hours" id="inputHours" value="<?php if (isset($course['hours'])) echo $course['hours']; ?>" required>
                            <div class="invalid-feedback">Hours is required</div>
                        </div>
                        <div class="form-group">
                            <label for="inputCollege" class="bmd-label-floating">College</label>
                            <input type="text" class="form-control" name="college" id="inputCollege" value="<?php if (isset($course['college'])) echo $course['college']; ?>" required>
                            <div class="invalid-feedback">College is required</div>
                        </div>
                        <div class="form-group">
                            <label for="inputPrerequisite" class="bmd-label-floating">Prerequisite</label>
                            <select class="form-control" name="prerequisite" id="inputPrerequisite">
                                <option value="-1">None</option>
                                <?php foreach ($this->data['courses'] as $precourse) {?>
                                    <option value="<?php echo $precourse['c_code']; ?>" <?php if (isset($course['c_code']) && $precourse['c_code'] == $course['c_code']) echo 'selected' ?>><?php echo $precourse['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputDCode" class="bmd-label-floating">Department</label>
                            <select class="form-control" name="d_code" id="inputDCode">
                                <?php foreach ($this->data['departments'] as $department) {?>
                                    <option value="<?php echo $department['d_code']; ?>" <?php if (isset($course) && $course['d_code'] == $department['d_code']) echo 'selected' ?>><?php echo $department['d_name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <input type="hidden" value="<?php if (isset($course['c_code'])) echo $course['c_code']; ?>" name="code" />
                        <button type="submit" <?php if (sizeof($this->data['departments']) < 1) echo "disabled";?>  class="btn btn-raised btn-info action-submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
