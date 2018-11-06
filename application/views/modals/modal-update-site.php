<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal">&times;</button>
	<h4 class="modal-title">Update Site</h4>
</div>
<div class="modal-body">
	<h4>Do you want to edit details of <strong><?php echo $edit_site['name']; ?></strong>?</h4>
</div>
<div class="modal-footer">
	<input type="hidden" name="mode" value="<?php echo $edit_site['status_action']; ?>">
	<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
	<a href="<?php echo site_url('sites/edit/'.$edit_site['id']); ?>" class="btn btn-default">Yes</a>
</div>
