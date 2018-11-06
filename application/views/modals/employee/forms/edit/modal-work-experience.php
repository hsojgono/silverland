<form class="form-horizontal" action="<?php echo site_url('employees/edit_employee_work_experience/'.$employee_work_experience_id); ?>" method="post">
    <div class="modal-header">
        <h4 class="modal-title">Edit Work Experience</h4>
    </div>
	<div class="modal-body">
		<div class="form-group">
			<label for="" class="control-label col-sm-4">Company Name</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="company_name" value="<?php echo $employee_work_experience['company_name']; ?>">
				<div class="validation_error"><?php echo form_error('company_name'); ?></div>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="control-label col-sm-4">Position</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="position" value="<?php echo $employee_work_experience['position']; ?>">
				<div class="validation_error"><?php echo form_error('position'); ?></div>
			</div>
		</div>

		<div class="form-group">
			<label for="" class="control-label col-sm-4">Immediate Superior</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="immediate_superior" value="<?php echo $employee_work_experience['immediate_superior']; ?>">
				<div class="validation_error"><?php echo form_error('immediate_superior'); ?></div>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="control-label col-sm-4">Duties</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="duties" value="<?php echo $employee_work_experience['duties']; ?>">
				<div class="validation_error"><?php echo form_error('duties'); ?></div>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="control-label col-sm-4">Employment Type</label>
			<div class="col-sm-6">
				<select name="employment_type_id" class="form-control">
					<option value="<?php echo $employee_work_experience['employment_type_id']; ?>"><?php echo $employee_work_experience['employment_type_name']; ?></option>
					<option value="">-- SELECT EMPLOYMENT TYPE --</option>
					<?php foreach ($employment_types as $employment_type): ?>
					<option value="<?php echo $employment_type['id']; ?>"><?php echo $employment_type['type_name']; ?></option>
					<?php endforeach; ?>
				</select>
				<div class="validation_error"><?php echo form_error('employment_type_id'); ?></div>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="control-label col-sm-4">Salary</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="salary" value="<?php echo $employee_work_experience['salary']; ?>">
				<div class="validation_error"><?php echo form_error('salary'); ?></div>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="control-label col-sm-4">Reason for Leaving</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="reason_for_leaving" value="<?php echo $employee_work_experience['reason_for_leaving']; ?>">
				<div class="validation_error"><?php echo form_error('reason_for_leaving'); ?></div>
			</div>
		</div>

	    <div class="form-group ">
            <label class="col-sm-4 control-label">Date Hired</label>
            <div class="col-sm-6">
                <input type="date" name="date_hired" class="form-control" value="<?php echo date('Y-m-d', strtotime($employee_work_experience['date_hired'])); ?>">
                <span class="fa fa-calendar form-control-feedback"></span><br>
                <div class="validation_error"><?php echo form_error('date_hired'); ?></div>
            </div>
        </div>
	    <div class="form-group ">
            <label class="col-sm-4 control-label">Date Separated</label>
            <div class="col-sm-6">
                <input type="date" name="date_separated" class="form-control" value="<?php echo date('Y-m-d', strtotime($employee_work_experience['date_separated'])); ?>">
                <span class="fa fa-calendar form-control-feedback"></span><br>
                <div class="validation_error"><?php echo form_error('date_separated'); ?></div>
            </div>
        </div>

		<!-- numbers -->
		<div class="form-group">
			<label for="" class="control-label col-sm-4">Mobile Number</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="mobile_number" value="<?php echo $employee_work_experience['mobile_number']; ?>">
				<div class="validation_error"><?php echo form_error('mobile_number'); ?></div>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="control-label col-sm-4">Telephone Number</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="telephone_number" value="<?php echo $employee_work_experience['telephone_number']; ?>">
				<div class="validation_error"><?php echo form_error('telephone_number'); ?></div>
			</div>
		</div>
		<!-- address -->
		<div class="form-group">
			<label for="" class="control-label col-sm-4">Block Number</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="block_number" value="<?php echo $employee_work_experience['block_number']; ?>">
				<div class="validation_error"><?php echo form_error('block_number'); ?></div>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="control-label col-sm-4">Lot Number</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="lot_number" value="<?php echo $employee_work_experience['lot_number']; ?>">
				<div class="validation_error"><?php echo form_error('lot_number'); ?></div>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="control-label col-sm-4">Floor Number</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="floor_number" value="<?php echo $employee_work_experience['floor_number']; ?>">
				<div class="validation_error"><?php echo form_error('floor_number'); ?></div>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="control-label col-sm-4">Building Number</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="building_number" value="<?php echo $employee_work_experience['building_number']; ?>">
				<div class="validation_error"><?php echo form_error('building_number'); ?></div>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="control-label col-sm-4">Street</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="street" value="<?php echo $employee_work_experience['street']; ?>">
				<div class="validation_error"><?php echo form_error('street'); ?></div>
			</div>
		</div>
		<!-- <div class="form-group">
			<label for="" class="control-label col-sm-4">Location</label>
			<div class="col-sm-6">
				<select name="location" class="form-control">
                    <option value="<?php echo $employee_work_experience['location_id']; ?>"><?php echo $employee_work_experience['full_address']; ?></option>
					<option value="">-- SELECT LOCATION --</option>
					<?php foreach ($locations as $location): ?>
					<option value="<?php echo $location['id']; ?>"><?php echo $location['barangay']; ?></option>
					<?php endforeach; ?>
				</select>
				<div class="validation_error"><?php echo form_error('location_id'); ?></div>
			</div>
		</div> -->
    </div>  

    <div class="modal-footer">
        <input type="hidden" name="save">
        <a href="<?php site_url('employees/cancel_edit'); ?>" class="btn btn-default">Cancel</a>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
