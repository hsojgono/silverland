<form action="<?php echo site_url('loan_types/update_status/'.$loan_type['id']); ?>" method="post">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">Update Loan Type Status</h4>
	</div>
	<div class="modal-body">
		<h4>Do you want to <strong><?php echo $loan_type['status_action']; ?></strong> <?php echo $loan_type['name']; ?>?</h4>
	</div>
	<div class="modal-footer">
		<input type="hidden" name="mode" value="<?php echo $loan_type['status_action']; ?>">
		<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
		<button type="submit" class="btn btn-primary">Yes</button>
	</div>
</form>