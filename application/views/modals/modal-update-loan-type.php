<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal">&times;</button>
	<h4 class="modal-title">Update Loan Type</h4>
</div> 
<div class="modal-body">
	<h4>Do you want to edit details of <strong><?php echo $edit_loan_type['name']; ?></strong>?</h4>
</div>
<div class="modal-footer">
	<input type="hidden" name="mode" value="<?php echo $edit_loan_type['status_action']; ?>">
	<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
	<a href="<?php echo site_url('loan_types/edit/'.$edit_loan_type['id']); ?>" class="btn btn-primary">Yes</a>
</div>
