<form class="form-horizontal" action="<?php echo site_url('employees/edit/employee_spouse_information/'.$employee_id); ?>" method="post">
    <div class="modal-header">
        <h4 class="modal-title">Modal Spouse Information</h4>
    </div>
    <?php dump($spouse_id); ?>
    <div class="modal-body">
        <div class="form-group">
            <label for="" class="control-label col-sm-4">First Name</label>
            <div class="col-sm-6">
                <input type="text" name="first_name" class="form-control" value="<?php echo $spouse_information['first_name']; ?>">
                <div class="validation_error"><?php echo form_error('first_name'); ?></div>
            </div>
        </div>
        <div class="form-group">
            <label for="" class="control-label col-sm-4">Middle Name</label>
            <div class="col-sm-6">
                <input type="text" name="middle_name" class="form-control" value="<?php echo $spouse_information['middle_name']; ?>">
                <div class="validation_error"><?php echo form_error('middle_name'); ?></div>
            </div>
        </div>
        <div class="form-group">
            <label for="" class="control-label col-sm-4">Last Name</label>
            <div class="col-sm-6">
                <input type="text" name="last_name" class="form-control" value="<?php echo $spouse_information['last_name']; ?>">
                <div class="validation_error"><?php echo form_error('last_name'); ?></div>
            </div>
        </div>
        <div class="form-group">
            <label for="" class="control-label col-sm-4">Birthdate</label>
            <div class="col-sm-6">
                <input type="text" name="birthdate" class="form-control" value="<?php echo $spouse_information['birthdate']; ?>">
                <div class="validation_error"><?php echo form_error('birthdate'); ?></div>
            </div>
        </div>
        <div class="form-group">
            <label for="" class="control-label col-sm-4">Block Number</label>
            <div class="col-sm-6">
                <input type="text" name="block_number" class="form-control" value="<?php echo $spouse_information['block_number']; ?>">
                <div class="validation_error"><?php echo form_error('block_number'); ?></div>
            </div>
        </div>
        <div class="form-group">
            <label for="" class="control-label col-sm-4">Lot Number</label>
            <div class="col-sm-6">
                <input type="text" name="lot_number" class="form-control" value="<?php echo $spouse_information['lot_number']; ?>">
                <div class="validation_error"><?php echo form_error('lot_number'); ?></div>
            </div>
        </div>
        <div class="form-group">
            <label for="" class="control-label col-sm-4">Floor Number</label>
            <div class="col-sm-6">
                <input type="text" name="floor_number" class="form-control" value="<?php echo $spouse_information['floor_number']; ?>">
                <div class="validation_error"><?php echo form_error('floor_number'); ?></div>
            </div>
        </div>
        <div class="form-group">
            <label for="" class="control-label col-sm-4">Building Number</label>
            <div class="col-sm-6">
                <input type="text" name="building_number" class="form-control" value="<?php echo $spouse_information['building_number']; ?>">
                <div class="validation_error"><?php echo form_error('building_number'); ?></div>
            </div>
        </div>
        <div class="form-group">
            <label for="" class="control-label col-sm-4">Building Name</label>
            <div class="col-sm-6">
                <input type="text" name="building_name" class="form-control" value="<?php echo $spouse_information['building_name']; ?>">
                <div class="validation_error"><?php echo form_error('building_name'); ?></div>
            </div>
        </div>
        <div class="form-group">
            <label for="" class="control-label col-sm-4">Street</label>
            <div class="col-sm-6">
                <input type="text" name="street" class="form-control" value="<?php echo $spouse_information['street']; ?>">
                <div class="validation_error"><?php echo form_error('street'); ?></div>
            </div>
        </div>
        <div class="form-group">
            <label for="" class="control-label col-sm-4">Barangay</label>
            <div class="col-sm-6">
                <input type="text" name="barangay" class="form-control" value="<?php echo $spouse_information['barangay']; ?>">
                <div class="validation_error"><?php echo form_error('barangay'); ?></div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a href="<?php site_url('employees/cancel_edit'.$employee_id); ?>" class="btn btn-default">Cancel</a>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
