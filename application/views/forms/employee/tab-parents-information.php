<div class="tab-pane fade" id="tab-parents-information">
    <div class="form-horizontal">
        <?php //dump($personal_background['parents_information']); ?>

        <?php if (count($personal_background['parents_information']) > 1): ?>
        <?php foreach ($personal_background['parents_information'] as $parents_information): ?>
        <?php $male   = ($parents_information['gender'] == 1) ? 'checked':''; ?>
        <?php $female = ($parents_information['gender'] == 0) ? 'checked':''; ?>
        <div class="form-group">
            <div class="col-md-4">
                <label class="">First Name</label>
                <input type="text" name="parents_information[first_name][]" class="form-control" placeholder="First Name" value="<?php echo $parents_information['first_name']; ?>">
                <div class="validation_error"><?php echo form_error('first_name'); ?></div>
            </div>
            <div class="col-md-4">
                <label class="">Middle Name</label>
                <input type="text" name="parents_information[middle_name][]" class="form-control" placeholder="Middle Name" value="<?php echo $parents_information['middle_name']; ?>">
                <div class="validation_error"><?php echo form_error('middle_name'); ?></div>
            </div>
            <div class="col-md-4">
                <label class="">Last Name</label>
                <input type="text" name="parents_information[last_name][]" class="form-control" placeholder="Last Name" value="<?php echo $parents_information['last_name']; ?>">
                <div class="validation_error"><?php echo form_error('last_name'); ?></div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-4">
                <label>Birthdate</label>
                <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                    <input type="text" name="parents_information[birthdate][]" class="form-control datepicker" value="<?php echo $parents_information['birthdate']; ?>">
                </div>
                <div class="validation_error"><?php echo form_error('birthdate'); ?></div>
            </div>
            <div class="col-md-4">
                <label>Birthplace</label>
                <input type="text" name="parents_information[birthplace][]" class="form-control" value="<?php echo $parents_information['birthplace']; ?>">
                <div class="validation_error"><?php echo form_error('birthplace'); ?></div>
            </div>
            <div class="col-md-4">
                <label>Gender
                    <input type="radio" name="personal_information[gender][]" class="flat-red" <?php echo $male; ?>>
                    <label>Male</label>
                    <input type="radio" name="personal_information[gender][]" class="flat-red" <?php echo $female; ?>>
                    <label>Female</label>
                </label>
                <div class="validation_error"><?php echo form_error('civil_status'); ?></div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-6">
                <label>Relationshhip</label>
                <select class="form-control">
                    <?php foreach ($relationships as $relationship): ?>
                    <option value="<?php echo $relationship['id']; ?>"><?php echo $relationship['name']; ?></option>
                    <?php endforeach; ?>
                </select>
                <input type="text" name="parents_information[relationship][]" class="form-control" value="<?php echo $parents_information['relationship_id']; ?>">
                <div class="validation_error"><?php echo form_error('relationship'); ?></div>
            </div>
            <div class="col-md-6">
                <label>Occupation</label>
                <input type="text" name="parents_information[occupation][]" class="form-control" value="<?php echo $parents_information['occupation']; ?>">
                <div class="validation_error"><?php echo form_error('occupation'); ?></div>
            </div>
        </div>
        <hr>
        <?php endforeach; ?>
        <?php else: ?>
        <div class="form-group">
            <div class="col-md-4">
                <label class="">First Name</label>
                <input type="text" name="parents_information[first_name][]" class="form-control" placeholder="First Name" value="<?php echo $personal_background['personal_information']['first_name']; ?>">
                <div class="validation_error"><?php echo form_error('first_name'); ?></div>
            </div>
            <div class="col-md-4">
                <label class="">Middle Name</label>
                <input type="text" name="parents_information[middle_name][]" class="form-control" placeholder="Middle Name" value="<?php echo $personal_background['personal_information']['middle_name']; ?>">
                <div class="validation_error"><?php echo form_error('middle_name'); ?></div>
            </div>
            <div class="col-md-4">
                <label class="">Last Name</label>
                <input type="text" name="parents_information[last_name][]" class="form-control" placeholder="Last Name" value="<?php echo $personal_background['personal_information']['last_name']; ?>">
                <div class="validation_error"><?php echo form_error('last_name'); ?></div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-3">
                <label>Birthdate</label>
                <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                    <input type="text" name="parents_information[birthdate][]" class="form-control datepicker" value="<?php echo $personal_background['personal_information']['birthdate']; ?>">
                </div>
                <div class="validation_error"><?php echo form_error('birthdate'); ?></div>
            </div>
            <div class="col-md-3">
                <label>Birthplace</label>
                <input type="text" name="parents_information[birthplace][]" class="form-control" value="<?php echo $personal_background['personal_information']['birthplace']; ?>">
                <div class="validation_error"><?php echo form_error('birthplace'); ?></div>
            </div>
            <div class="col-md-3">
                <label>Civil Status</label>
                <select class="form-control" name="parents_information[civil_status_id][]">
                    <option value="<?php echo $current_civil_status['id']; ?>"><?php echo $current_civil_status['status_name']; ?></option>
                    <option value="">--</option>
                    <?php foreach ($civil_status as $cs): ?>
                    <option value="<?php echo $cs['id']; ?>"><?php echo $cs['status_name']; ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="validation_error"><?php echo form_error('civil_status'); ?></div>
            </div>
            <div class="col-md-3">
                <label>Gender</label>
                <div class="form-group">
                    <input type="radio" name="parents_information[gender][]" class="flat-red" <?php echo $male; ?>>
                    <label>Male</label>
                    <input type="radio" name="parents_information[gender][]" class="flat-red" <?php echo $female; ?>>
                    <label>Female</label>
                </div>
                <div class="validation_error"><?php echo form_error('civil_status'); ?></div>
            </div>
        </div>
        <?php endif; ?>

    </div>
</div>
