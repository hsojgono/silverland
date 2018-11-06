<form action="<?php echo site_url('companies/update_status/'.$company_data['id']); ?>" method="post">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">Update Company Status</h4>
	</div>
	<div class="modal-body">
		<h4>Do you want to <strong><?php echo $company_data['status_action']; ?></strong> <?php echo $company_data['name']; ?>?</h4>
	</div>
	<div class="modal-footer">
		<input type="hidden" name="mode" value="<?php echo $company_data['status_action']; ?>">
		<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
		<button type="submit" class="btn btn-default">Yes</button>
	</div>
</form>