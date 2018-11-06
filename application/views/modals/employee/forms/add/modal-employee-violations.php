<form class="form-horizontal" action="<?php echo site_url('employees/add_employee_violation/'.$employee_id); ?>" method="post">
	<div class="modal-header">
		<h3 class="modal-title"><?php echo $modal_title; ?></h3>
	</div>
		<div class="form-group">
			<label for="" class="control-label col-sm-4">Violation</label>
			<div class="col-sm-6">
				<select name="violation_id" class="form-control">
					<option value="">-- SELECT VIOLATION --</option>
					<?php foreach ($violations as $violation): ?>
					<option value="<?php echo $violation['id']; ?>"><?php echo $violation['name']; ?></option>
					<?php endforeach; ?>
				</select>
				<div class="validation_error"><?php echo form_error('violation_id'); ?></div>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="control-label col-sm-4">Number of offense</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="number_of_offense" value="">
				<div class="validation_error"><?php echo form_error('number_of_offense'); ?></div>
			</div>
		</div>





	<div class="modal-footer">
		<input type="hidden" name="mode" value="add">
		<a href="<?php echo site_url('employees/cancel_add/'.$employee_id); ?>" class="btn btn-default">Cancel</a>
		<button type="submit" class="btn btn-primary">Submit</button>
	</div>
</form>
