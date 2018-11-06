<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal">&times;</button>
	<h4 class="modal-title">Cancel Official Business</h4>
</div>
<div class="modal-body">
	<h4>Do you want to cancel this official business <strong><?php echo $edit_branch['name']; ?></strong>?</h4>
</div>
<div class="modal-footer">
	<input type="hidden" name="mode" value="<?php echo $edit_branch['status_label']; ?>">
	<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
	<a href="<?php echo site_url('official_bu/edit/'.$edit_branch['id']); ?>" class="btn btn-default">Yes</a>
</div>