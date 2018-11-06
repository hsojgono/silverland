
<form class="form-horizontal" action="<?php echo site_url('employees/add_employee_sanction/'.$employee_id); ?>" method="post">
	<div class="modal-header">
		<h3 class="modal-title"><?php echo $modal_title; ?></h3>
	</div>
		<div class="form-group">
			<label for="" class="control-label col-sm-4">Sanction</label>
			<div class="col-sm-6">
				<select name="sanction_id" class="form-control">
					<option value="">-- SELECT SANCTION --</option>
					<?php foreach ($sanctions as $sanction): ?>
					<option value="<?php echo $sanction['id']; ?>"><?php echo $sanction['name']; ?></option>
					<?php endforeach; ?>
				</select>
				<div class="validation_error"><?php echo form_error('sanction_id'); ?></div>
			</div>
		</div>

	<div class="modal-footer">
		<input type="hidden" name="mode" value="add">
		<a href="<?php echo site_url('employees/cancel_add/'.$employee_id); ?>" class="btn btn-default">Cancel</a>
		<button type="submit" class="btn btn-primary">Submit</button>
	</div>
</form>

