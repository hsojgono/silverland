<form class="form-horizontal" action="<?php echo site_url('employees/edit_employee_training/'.$training_id); ?>" method="post">
    <div class="modal-header">
        <h4 class="modal-title">Edit Training</h4>
    </div>
    <div class="modal-body">
    <div class="tab-content">

		<div class="form-group">
			<label for="" class="control-label col-sm-4">Training</label>
			<div class="col-sm-6">
				<select name="training_id" class="form-control">
					<option value="<?php echo $training['training_id']; ?>"><?php echo $training['training_title']; ?></option>
					<option value="">-- SELECT TRAINING --</option>
					<?php foreach ($trainings as $trainingg): ?>
					<option value="<?php echo $trainingg['id']; ?>"><?php echo $trainingg['title']; ?></option>
					<?php endforeach; ?>
				</select>
				<div class="validation_error"><?php echo form_error('training_id'); ?></div>
			</div>
		</div>
	    <div class="form-group">
			<label for="" class="control-label col-sm-4">Company</label>
			<div class="col-sm-6">
				<select name="company_id" class="form-control">
					<option value="<?php echo $training['company_id']; ?>"><?php echo $training['company_name']; ?></option>
					<option value="">-- SELECT COMPANY --</option>
					<?php foreach ($companies as $company): ?>
					<option value="<?php echo $company['id']; ?>"><?php echo $company['name']; ?></option>
					<?php endforeach; ?>
				</select>
				<div class="validation_error"><?php echo form_error('company_id'); ?></div>
			</div>
		</div>
        <div class="form-group">
			<label for="" class="control-label col-sm-4">Acquired From</label>
			<div class="col-sm-6">
				<select name="acquired_from" class="form-control">
					<option value=""><?php echo $training['job_status']; ?></option>
					<option value="0">-- SELECT ACQUIRED FROM --</option>
					<option value="1">Pre-Employment</option>
					<option value="2">Current</option>
				</select>
				<div class="validation_error"><?php echo form_error('acquired_from'); ?></div>
			</div>
		</div>
    </div>

    <div class="modal-footer">
        <input type="hidden" name="save">
        <a href="<?php site_url('employees/cancel_edit'); ?>" class="btn btn-default">Cancel</a>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
