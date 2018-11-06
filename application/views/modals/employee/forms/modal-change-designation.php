<form action="<?php echo site_url('employees/change_designation/' . $employee_id); ?>" method="post" class="form-horizontal">
	<div class="modal-header">
		<h4 class="modal-title"><?php echo $modal_title; ?></h4>
	</div>
	<div class="modal-body">
		<div class="form-group">
			<label for="position_id" class="col-lg-4 control-label">Position</label>
			<div class="col-lg-7">
				<?php $key = array_search($current_position['position_id'], array_column($positions, 'id')); ?>
				<?php unset($positions[$key]); ?>
				<select name="position_id" id="position_id" class="form-control" required="true">
					<?php if ($current_position['position_id']): ?>
					<option value="<?php echo $current_position['position_id']; ?>"><?php echo $current_position['position']; ?></option>
					<option value="">----</option>
					<?php else: ?>
					<option value="">-- SELECT POSITION --</option>
					<?php endif ?>
					<?php foreach ($positions as $index => $position): ?>
					<option value="<?php echo $position['id']; ?>"><?php echo $position['name']; ?></option>
					<?php endforeach ?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label for="date_started" class="col-lg-4 control-label">Date Started</label>
			<div class="col-lg-7">
				<input type="text" class="form-control datepicker" id="date_started" name="date_started" value="<?php echo date('Y-m-d'); ?>">
			</div>
		</div>
		<div class="form-group">
			<label for="remarks" class="col-lg-4 control-label">Remarks</label>
			<div class="col-lg-7">
				<textarea rows="10" cols="10" class="form-control" id="remarks" name="remarks" style="resize: none;"></textarea>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<input type="hidden" name="mode" value="post">
		<button class="btn btn-primary" type="submit">Submit</button>
	</div>
</form>
<script>
	$(function() {
		$('#date_started').datepicker({
			format:'yyyy-mm-dd',
		});
	});
</script>
<style>
	.datepicker {
		z-index: 1151 !important;
	}
</style>