<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal">&times;</button>
	<h4 class="modal-title">Update Leave Type</h4>
</div>
<div class="modal-body">
	<h4>Do you want to edit details of <strong><?php echo $edit_leave_type['name']; ?></strong>?</h4>
</div>
<div class="modal-footer">
	<input type="hidden" name="mode" value="<?php echo $edit_leave_type['status_label']; ?>">
	<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
	<a href="<?php echo site_url('leave_types/edit/'.$edit_leave_type['id']); ?>" class="btn btn-default">Yes</a>
</div>