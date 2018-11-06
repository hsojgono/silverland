<form class="form-horizontal" action="<?php echo site_url('employees/edit/employee_parent_information/'.$employee_id); ?>" method="post">
    <div class="modal-header">
        <h4 class="modal-title">Update Parents Information</h4>
    </div>
    <div class="modal-body">
        <div class="nav-tabs-custom">

            <ul class="nav nav-tabs" id="tabContent">
            <?php foreach ($parents_information as $k => $navtabtitle): ?>
            <?php
                $relationship_id = $navtabtitle['relationship_id'];
                $index_id = array_search($relationship_id, array_column($relationships, 'id'));
                $relationship = $relationships[$index_id]['name'];
            ?>
            <li class="<?php echo ($k == 0) ? 'active':''; ?>">
                <a href="<?php echo '#'.strtolower($relationship); ?>" data-toggle="tab"><?php echo ucwords($relationship); ?></a>
            </li>
            <?php endforeach; ?>
            </ul>

            <div class="tab-content">
                <?php foreach ($parents_information as $j => $parent_information): ?>
                <?php
                    $relationship_id = $parent_information['relationship_id'];
                    $index_id = array_search($relationship_id, array_column($relationships, 'id'));
                    $relationship = $relationships[$index_id]['name'];
                ?>
                <div class="tab-pane fade in <?php echo ($j == 0) ? 'active':''; ?>" id="<?php echo strtolower($relationship); ?>">
                    <div class="form-group">
                        <div class="form-group">
                            <label for="" class="control-label col-sm-3">First Name</label>
                            <div class="col-sm-8">
                                <input type="text" name="first_name[<?php echo $relationship_id; ?>]" class="form-control" value="<?php echo $parent_information['first_name']; ?>">
                                <div class="validation_error"><?php echo form_error('first_name'); ?></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label col-sm-3">Middle Name</label>
                            <div class="col-sm-8">
                                <input type="text" name="middle_name[<?php echo $relationship_id; ?>]" class="form-control" value="<?php echo $parent_information['middle_name']; ?>">
                                <div class="validation_error"><?php echo form_error('middle_name'); ?></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label col-sm-3">Last Name</label>
                            <div class="col-sm-8">
                                <input type="text" name="last_name[<?php echo $relationship_id; ?>]" class="form-control" value="<?php echo $parent_information['last_name']; ?>">
                                <div class="validation_error"><?php echo form_error('last_name'); ?></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label col-sm-3">Birthdate</label>
                            <div class="col-sm-8">
                                <input type="text" name="birthdate[<?php echo $relationship_id; ?>]" class="form-control" value="<?php echo $parent_information['birthdate']; ?>">
                                <div class="validation_error"><?php echo form_error('birthdate'); ?></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label col-sm-3">Birthplace</label>
                            <div class="col-sm-8">
                                <input type="text" name="birthplace[<?php echo $relationship_id; ?>]" class="form-control" value="<?php echo $parent_information['birthplace']; ?>">
                                <div class="validation_error"><?php echo form_error('birthplace'); ?></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label col-sm-3">Gender</label>
                            <div class="col-sm-8">
                                <label for="" class="radio-inline"><input type="radio" name="gender[<?php echo $relationship_id; ?>]" class="form-group" <?php echo ($parent_information['gender'] == 1) ? 'checked value="1"' : ''; ?>/> Male</label>
                                <label for="" class="radio-inline"><input type="radio" name="gender[<?php echo $relationship_id; ?>]" class="form-group" <?php echo ($parent_information['gender'] == 0) ? 'checked value="0"' : ''; ?>/> Female</label>
                                <div class="validation_error"><?php echo form_error('gender'); ?></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-5 col-sm-offset-1">
                                <label for="">Block Number</label>
                                <input type="text" name="block_number[<?php echo $relationship_id; ?>]" class="form-control" value="<?php echo $parent_information['block_number']; ?>">
                                <div class="validation_error"><?php echo form_error('block_number'); ?></div>
                            </div>
                            <div class="col-sm-5">
                                <label for="">Lot Number</label>
                                <input type="text" name="lot_number[<?php echo $relationship_id; ?>]" class="form-control" value="<?php echo $parent_information['lot_number']; ?>">
                                <div class="validation_error"><?php echo form_error('lot_number'); ?></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-5 col-sm-offset-1">
                                <label for="">Floor Number</label>
                                <input type="text" name="floor_number[<?php echo $relationship_id; ?>]" class="form-control" value="<?php echo $parent_information['floor_number']; ?>">
                                <div class="validation_error"><?php echo form_error('floor_number'); ?></div>
                            </div>
                            <div class="col-sm-5">
                                <label for="">Building Number</label>
                                <input type="text" name="building_number[<?php echo $relationship_id; ?>]" class="form-control" value="<?php echo $parent_information['building_number']; ?>">
                                <div class="validation_error"><?php echo form_error('building_number'); ?></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-5 col-sm-offset-1">
                                <label for="">Building Name</label>
                                <input type="text" name="building_name[<?php echo $relationship_id; ?>]" class="form-control" value="<?php echo $parent_information['building_name']; ?>">
                                <div class="validation_error"><?php echo form_error('building_name'); ?></div>
                            </div>
                            <div class="col-sm-5">
                                <label for="">Street</label>
                                <input type="text" name="street[<?php echo $relationship_id; ?>]" class="form-control" value="<?php echo $parent_information['street']; ?>">
                                <div class="validation_error"><?php echo form_error('street'); ?></div>
                            </div>
                        </div>
                        <input type="hidden" name="employee_id[<?php echo $relationship_id; ?>]" class="form-control" value="<?php echo $parent_information['employee_id']; ?>">
                        <input type="hidden" name="relationship_id[<?php echo $relationship_id; ?>]" class="form-control" value="<?php echo $parent_information['relationship_id']; ?>">
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a href="<?php site_url('employees/cancel_edit'); ?>" class="btn btn-default">Cancel</a>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
