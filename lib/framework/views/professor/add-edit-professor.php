<div class="row">
    <div class="card w-100">
        <? if (isset($this->data['professor'])) $professor = $this->data['professor']; ?>
        <div class="card-header">
            <h5 class="card-title"><?php if (isset($professor)) echo "Edit"; else echo "Add"; ?> Professor</h5>
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
            <form action="<?php if (isset($professor)) {
                echo BASE_URL . "professor/edit/" . $professor['e_id'] . "/validate";
            } else echo BASE_URL . "professor/add/validate";?>" method="post" class="needs-validation" novalidate>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="inputName" class="bmd-label-floating">Name</label>
                            <input type="text" class="form-control" name="name" id="inputName" value="<?php if (isset($professor)) echo $professor['p_name']; ?>">
                            <div class="invalid-feedback">Name is required</div>
                        </div>
                        <div class="form-group">
                            <label for="inputPhone" class="bmd-label-floating">Phone</label>
                            <input type="text" class="form-control" name="phone" id="inputPhone" value="<?php if (isset($professor)) echo $professor['phone']; ?>">
                            <div class="invalid-feedback">Phone is required</div>
                        </div>
                        <div class="form-group">
                            <label for="inputOffice" class="bmd-label-floating">Office</label>
                            <input type="text" class="form-control" name="office" id="inputOffice" value="<?php if (isset($professor)) echo $professor['office']; ?>">
                            <div class="invalid-feedback">Office is required</div>
                        </div>
                        <div class="form-group">
                            <label for="inputDCode" class="bmd-label-floating">Department</label>
                            <select class="form-control" name="d_code" id="inputDCode">
                                <?php foreach ($this->data['departments'] as $department) {?>
                                    <option value="<?php echo $department['d_code']; ?>" <?php if (isset($professor) && $professor['d_code'] == $department['d_code']) echo 'selected' ?>><?php echo $department['d_name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <input type="hidden" value="<?php if (isset($professor)) echo $professor['e_id']; ?>" name="code" />
                        <button type="submit" <?php if (sizeof($this->data['departments']) < 1) echo "disabled";?>  class="btn btn-raised btn-info action-submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
