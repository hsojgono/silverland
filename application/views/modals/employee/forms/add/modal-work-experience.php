
<form class="form-horizontal" action="<?php echo site_url('employees/add_employee_work_experience/'.$employee_id); ?>" method="post">
	<div class="modal-header">
		<h3 class="modal-title"><?php echo $modal_title; ?></h3>
	</div>
	<div class="modal-body">
		<div class="form-group">
			<label for="" class="control-label col-sm-4">Company Name</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="company_name" value="">
				<div class="validation_error"><?php echo form_error('company_name'); ?></div>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="control-label col-sm-4">Position</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="position" value="">
				<div class="validation_error"><?php echo form_error('position'); ?></div>
			</div>
		</div>

		<div class="form-group">
			<label for="" class="control-label col-sm-4">Immediate Superior</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="immediate_superior" value="">
				<div class="validation_error"><?php echo form_error('immediate_superior'); ?></div>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="control-label col-sm-4">Duties</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="duties" value="">
				<div class="validation_error"><?php echo form_error('duties'); ?></div>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="control-label col-sm-4">Employment Type</label>
			<div class="col-sm-6">
				<select name="employment_type_id" class="form-control">
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
				<input type="text" class="form-control" name="salary" value="">
				<div class="validation_error"><?php echo form_error('salary'); ?></div>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="control-label col-sm-4">Reason for leaving</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="reason_for_leaving" value="">
				<div class="validation_error"><?php echo form_error('reason_for_leaving'); ?></div>
			</div>
		</div>

	    <div class="form-group ">
			<label class="col-sm-4 control-label">Date Hired</label>
			<div class="col-sm-6">
				<input type="date" name="date_hired" class="form-control" value="<?php echo set_value('date_hired'); ?>">
				<span class="glyphicon glyphicon-calendar form-control-feedback"></span><br>
				<div class="validation_error"><?php echo form_error('date_hired'); ?></div>
			</div>
		</div>
	    <div class="form-group ">
			<label class="col-sm-4 control-label">Date Separated</label>
			<div class="col-sm-6">
				<input type="date" name="date_separated" class="form-control" value="<?php echo set_value('date_separated'); ?>">
				<span class="glyphicon glyphicon-calendar form-control-feedback"></span><br>
				<div class="validation_error"><?php echo form_error('date_separated'); ?></div>
			</div>
		</div>

		<!-- numbers -->
		<div class="form-group">
			<label for="" class="control-label col-sm-4">Mobile Number</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="mobile_number" value="">
				<div class="validation_error"><?php echo form_error('mobile_number'); ?></div>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="control-label col-sm-4">Telephone Number</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="telephone_number" value="">
				<div class="validation_error"><?php echo form_error('telephone_number'); ?></div>
			</div>
		</div>
		<!-- address -->
		<div class="form-group">
			<label for="" class="control-label col-sm-4">Block Number</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="block_number" value="">
				<div class="validation_error"><?php echo form_error('block_number'); ?></div>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="control-label col-sm-4">Lot Number</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="lot_number" value="">
				<div class="validation_error"><?php echo form_error('lot_number'); ?></div>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="control-label col-sm-4">Floor Number</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="floor_number" value="">
				<div class="validation_error"><?php echo form_error('floor_number'); ?></div>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="control-label col-sm-4">Building Number</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="building_number" value="">
				<div class="validation_error"><?php echo form_error('building_number'); ?></div>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="control-label col-sm-4">Street</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="street" value="">
				<div class="validation_error"><?php echo form_error('street'); ?></div>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="control-label col-sm-4">Location</label>
			<div class="col-sm-6">
				<select name="location" class="form-control">
					<option value="">-- SELECT LOCATION --</option>
					<?php foreach ($locations as $location): ?>
					<option value="<?php echo $location['id']; ?>"><?php echo $location['barangay']; ?></option>
					<?php endforeach; ?>
				</select>
				<div class="validation_error"><?php echo form_error('location_id'); ?></div>
			</div>
		</div>
	</div>

	<div class="modal-footer">
		<input type="hidden" name="mode" value="add">
		<a href="<?php echo site_url('employees/cancel_add/'.$employee_id); ?>" class="btn btn-default">Cancel</a>
		<button type="submit" class="btn btn-primary">Submit</button>
	</div>
</form>

<script>

	$('.datepicker').datepicker({
        format: 'yyyy-mm-dd'
    });  

</script>

<style>

    .datepicker {z-index: 1151 !important;}

</style>