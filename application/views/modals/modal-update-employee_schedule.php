<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal">&times;</button>
	<h4 class="modal-title">Update Employee Schedule</h4>
</div>
<div class="modal-body">
	<h4>Do you want to edit schedule of <strong><?php echo $edit_employee_schedule['full_name']; ?></strong>?</h4>
</div>
<div class="modal-footer">
	<input type="hidden" name="mode" value="<?php echo $edit_employee_schedule['status_label']; ?>">
	<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
	<a href="<?php echo site_url('employee_schedules/edit/'.$edit_employee_schedule['id']); ?>" class="btn btn-default">Yes</a>
</div>