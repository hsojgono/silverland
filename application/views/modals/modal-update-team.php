<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal">&times;</button>
	<h4 class="modal-title">Update Team</h4>
</div>
<div class="modal-body">
	<h4>Do you want to edit details of <strong><?php echo $team_data['name']; ?></strong>?</h4>
</div>
<div class="modal-footer">
	<input type="hidden" name="mode" value="<?php echo $team_data['status_label']; ?>">
	<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
	<a href="<?php echo site_url('teams/edit/'.$team_data['id']); ?>" class="btn btn-default">Yes</a>
</div>