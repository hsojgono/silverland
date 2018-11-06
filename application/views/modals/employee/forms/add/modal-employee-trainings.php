
<form class="form-horizontal" action="<?php echo site_url('employees/add_employee_training/'.$employee_id); ?>" method="post">
	<div class="modal-header">
		<h3 class="modal-title"><?php echo $modal_title; ?></h3>
	</div>
		<div class="form-group">
			<label for="" class="control-label col-sm-4">Training</label>
			<div class="col-sm-6">
				<select name="training_id" class="form-control">
					<option value="">-- SELECT TRAINING --</option>
					<?php foreach ($trainings as $training): ?>
					<option value="<?php echo $training['id']; ?>"><?php echo $training['title']; ?></option>
					<?php endforeach; ?>
				</select>
				<div class="validation_error"><?php echo form_error('training_id'); ?></div>
			</div>
		</div>

		<div class="form-group">
			<label for="" class="control-label col-sm-4">Company</label>
			<div class="col-sm-6">
				<select name="company_id" class="form-control">
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
					<option value="">-- SELECT --</option>
					<option value="0">Pre-employment</option>
					<option value="1">Current</option>
				
				</select>
				<div class="validation_error"><?php echo form_error('acquired_from'); ?></div>
			</div>
		</div>




	<div class="modal-footer">
		<input type="hidden" name="mode" value="add">
		<a href="<?php echo site_url('employees/cancel_add/'.$employee_id); ?>" class="btn btn-default">Cancel</a>
		<button type="submit" class="btn btn-primary">Submit</button>
	</div>
</form>
