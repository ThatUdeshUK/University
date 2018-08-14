<div class="row">
    <div class="card w-100">
        <div class="card-header">
            <h5 class="card-title">
                <a href="<?php echo BASE_URL;?>department" class="btn btn-secondary bmd-btn-icon"><i class="material-icons">arrow_back</i></a>&nbsp;
                <?php if (isset($this->data['department'])) echo "Edit"; else echo "Add"; ?> Department
            </h5>
        </div>
        <? if (isset($this->data['error'])) { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $this->data['error']; ?>
            </div>
        <?php } ?>
        <div class="card-body">
            <form action="<?php if (isset($this->data['department'])) {
                $department = $this->data['department'];
                echo BASE_URL . "department/edit/" . $department['d_code'] . "/validate";
            } else echo BASE_URL . "department/add/validate"; ?>" method="post" class="needs-validation" novalidate>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="inputName" class="bmd-label-floating">Department Name</label>
                            <input type="text" class="form-control" name="name" id="inputName" value="<?php if (isset($department)) echo $department['d_name']; ?>" required>
                            <div class="invalid-feedback">Department name is required</div>
                        </div>
                        <div class="form-group">
                            <label for="inputPhone" class="bmd-label-floating">Phone</label>
                            <input type="text" class="form-control" name="phone" id="inputPhone" value="<?php if (isset($department)) echo $department['phone']; ?>" required>
                            <div class="invalid-feedback">Phone is required</div>
                        </div>
                        <div class="form-group">
                            <label for="inputLocation" class="bmd-label-floating">Location</label>
                            <input type="text" class="form-control" name="location" id="inputLocation" value="<?php if (isset($department)) echo $department['d_location']; ?>" required>
                            <div class="invalid-feedback">Location is required</div>
                        </div>
                        <div class="form-group">
                            <label for="inputHead" class="bmd-label-floating">Head</label>
                            <select class="form-control" name="head" id="inputHead">
                                <option value="-1">None</option>
                                <?php foreach ($this->data['professors'] as $professor) {?>
                                    <option value="<?php echo $professor['e_id']; ?>" <?php if (isset($department) && $department['head'] == $professor['e_id']) echo 'selected' ?>><?php echo $professor['p_name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <input type="hidden" value="<?php if (isset($department)) echo $department['d_code']; ?>" name="code" />
                        <button type="submit" class="btn btn-raised btn-info action-submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
