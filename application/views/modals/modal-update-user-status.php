<form action="<?php echo site_url('users/update_status/'.$user_data->id); ?>" method="post">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">Update User Status</h4>
	</div>
	<div class="modal-body">
		<h4>Do you want to <strong><?php echo ($user_data->active) ? 'De-activate':'Activate'; ?></strong> user named <strong><?php echo strtoupper($user_data->first_name.' '.$user_data->last_name); ?></strong>?</h4>
	</div>
	<div class="modal-footer">
		<input type="hidden" name="mode" value="<?php echo $user_data->active; ?>">
		<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
		<button type="submit" class="btn btn-default">Yes</button>
	</div>
</form>
