<form action="<?php echo site_url('roles/update_status/'.$role_data['id']); ?>" method="post">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">Update Role Permission Status</h4>
	</div>
	<div class="modal-body">
		<h4>Do you want to <strong><?php echo $role_data['status_label']; ?></strong> role permission status?</h4>
	</div>
	<div class="modal-footer">
		<input type="hidden" name="mode" value="<?php echo $role_data['status_label']; ?>">
		<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
		<button type="submit" class="btn btn-default">Yes</button>
	</div>
</form>