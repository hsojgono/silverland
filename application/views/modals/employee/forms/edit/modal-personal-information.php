<form class="form-horizontal" action="<?php echo site_url('employees/save/employee_personal_information/'.$employee_id); ?>" method="post">
    <div class="modal-header">
        <h4 class="modal-title"><?php echo $modal_title; ?></h4>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label for="" class="control-label col-sm-4">First Name</label>
            <div class="col-sm-6">
                <input type="text" name="first_name" class="form-control" value="<?php echo $personal_information['first_name']; ?>">
                <div class="validation_error"><?php echo form_error('first_name'); ?></div>
            </div>
        </div>
        <div class="form-group">
            <label for="" class="control-label col-sm-4">Middle Name</label>
            <div class="col-sm-6">
                <input type="text" name="middle_name" class="form-control" value="<?php echo $personal_information['middle_name']; ?>">
                <div class="validation_error"><?php echo form_error('middle_name'); ?></div>
            </div>
        </div>
        <div class="form-group">
            <label for="" class="control-label col-sm-4">Last Name</label>
            <div class="col-sm-6">
                <input type="text" name="last_name" class="form-control" value="<?php echo $personal_information['last_name']; ?>">
                <div class="validation_error"><?php echo form_error('last_name'); ?></div>
            </div>
        </div>
        <div class="form-group">
            <label for="" class="control-label col-sm-4">Birthdate</label>
            <div class="col-sm-6">
                <input type="text" name="birthdate" class="form-control" value="<?php echo $personal_information['birthdate']; ?>">
                <div class="validation_error"><?php echo form_error('birthdate'); ?></div>
            </div>
        </div>
        <div class="form-group">
            <label for="" class="control-label col-sm-4">Birthplace</label>
            <div class="col-sm-6">
                <input type="text" name="birthplace" class="form-control" value="<?php echo $personal_information['birthplace']; ?>">
                <div class="validation_error"><?php echo form_error('birthplace'); ?></div>
            </div>
        </div>
        <div class="form-group">
            <label for="" class="control-label col-sm-4">Civil Status</label>
            <div class="col-sm-6">
                <select class="form-control" name="civil_status_id">
                    <option value="<?php echo $current_civil_status['id']; ?>"><?php echo $current_civil_status['status_name']; ?></option>
                    <option value="">--</option>
                    <?php foreach ($civil_status as $cs): ?>
                    <option value="<?php echo $cs['id']; ?>"><?php echo $cs['status_name']; ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="validation_error"><?php echo form_error('civil_status_id'); ?></div>
            </div>
        </div>
        <div class="form-group">
            <label for="" class="control-label col-sm-4">Gender</label>
            <div class="col-sm-6">
                <label for="" class="radio-inline"><input type="radio" name="gender" class="form-group" <?php echo ($personal_information['gender'] == 1) ? 'checked value="1"' : ''; ?>/> Male</label>
                <label for="" class="radio-inline"><input type="radio" name="gender" class="form-group" <?php echo ($personal_information['gender'] == 0) ? 'checked value="0"' : ''; ?>/> Female</label>
                <div class="validation_error"><?php echo form_error('gender'); ?></div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a href="<?php site_url('employees/cancel_edit'); ?>" class="btn btn-default">Cancel</a>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
