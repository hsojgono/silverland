<form action="<?php echo site_url('holidays/update_status/' . $holiday_data['id']); ?>" method="post">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">Update Holiday Status</h4>
	</div>
	<div class="modal-body">
		<h4>Do you want to <strong><?php echo $holiday_data['status_action']; ?></strong> <?php echo $holiday_data['name']; ?>?</h4>
	</div>
	<div class="modal-footer">
		<input type="hidden" name="mode" value="<?php echo $holiday_data['status_action']; ?>">
		<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
		<button type="submit" class="btn btn-success">Yes</button>
	</div>
</form>