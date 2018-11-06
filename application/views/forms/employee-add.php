<div class="row">
    <div class="col-md-3">
        <div class="box box-primary">
            <div class="box-body box-profile">
                <img class="profile-user-img img-responsive img-circle" src="<?php echo site_url('assets/custom/img/app/mariner_avatar.png'); ?>" alt="User Profile Picture">
                <!-- <h3 class="profile-username text-center">Kevin Sagun</h3> -->
                <p class="text-muted text-center">&nbsp;</p>
                <a href="javascript:void(0);" class="btn btn-primary btn-block">
                    <b><i class="fa fa-camera"></i> Take a Picture</b>
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-pencil-square-o"></i> <h3 class="box-title">Add New Employee</h3>
            </div>
            <div class="box-body">
                <form class="form-horizontal" action="<?php echo site_url('employees/add'); ?>" method="post">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Employee Code</label>
                        <div class="col-md-6">
                            <input type="text" name="employee_code" class="form-control" value="<?php echo set_value('employee_code'); ?>">
                            <div class="validation_error"><?php echo form_error('employee_code'); ?></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Salutation</label>
                        <div class="col-md-6">
                            <select class="form-control select2" name="name_prefix" id="salutation">
                                <option value="">-- Select a Company --</option>
                                <option value="Mr."> Mr. </option>
                                <option value="Ms."> Ms. </option>
                                <option value="Mrs."> Mrs. </option>
                                <option value="Dr."> Dr. </option>
                                <option value="Engr."> Engr. </option>
                                <option value="Atty."> Atty. </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">First Name</label>
                        <div class="col-md-6">
                            <input type="text" name="first_name" class="form-control" value="<?php echo set_value('first_name'); ?>">
                            <div class="validation_error"><?php echo form_error('first_name'); ?></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Middle Name</label>
                        <div class="col-md-6">
                            <input type="text" name="middle_name" class="form-control" value="<?php echo set_value('middle_name'); ?>">
                            <div class="validation_error"><?php echo form_error('middle_name'); ?></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Last Name</label>
                        <div class="col-md-6">
                            <input type="text" name="last_name" class="form-control" value="<?php echo set_value('last_name'); ?>">
                            <div class="validation_error"><?php echo form_error('last_name'); ?></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Name Extension</label>
                        <div class="col-md-6">
                            <input type="text" name="name_suffix" class="form-control" value="<?php echo set_value('name_suffix'); ?>">
                            <div class="validation_error"><?php echo form_error('name_suffix'); ?></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Birth Date</label>
                        <div class="col-md-6">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                <input type="text" name="birthdate" class="form-control pull-right datepicker" value="<?php echo date('m/d/Y'); ?>">
                            </div>
                            <div class="validation_error"><?php echo form_error('birthdate'); ?></div>
                        </div>
                    </div>
                     <div class="form-group">
                        <label class="col-md-3 control-label">Birth Place</label>
                        <div class="col-md-6">
                            <input type="text" name="birthplace" class="form-control" value="<?php echo set_value('birthplace'); ?>">
                            <div class="validation_error"><?php echo form_error('birthplace'); ?></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Gender</label>
                        <div class="col-md-6">
                            <select class="form-control select2" name="gender" id="gender">
                                <option value="">-- Select Gender --</option>
                                <option value="0"> Female </option>
                                <option value="1"> Male </option>
                                <option value="2"> Others </option>
                            </select>
                            <div class="validation_error"><?php echo form_error('gender'); ?></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-3 col-md-6">
                            <button type="submit" class="<?php echo $btn_submit; ?>">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
