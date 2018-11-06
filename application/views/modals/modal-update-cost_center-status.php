<form action="<?php echo site_url('cost_centers/update_status/'.$cost_center_data['id']); ?>" method="post">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">Update Cost Center Status</h4>
	</div>
	<div class="modal-body">
		<h4>Do you want to <strong><?php echo $cost_center_data['status_action']; ?></strong> <?php echo $cost_center_data['name']; ?>?</h4>
	</div>
	<div class="modal-footer">
		<input type="hidden" name="mode" value="<?php echo $cost_center_data['status_action']; ?>">
		<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
		<button type="submit" class="btn btn-default">Yes</button>
	</div>
</form>