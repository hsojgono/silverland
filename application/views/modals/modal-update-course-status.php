<form action="<?php echo site_url('courses/update_status/'.$course_data['id']); ?>" method="post">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">Update Course Status</h4>
	</div>
	<div class="modal-body">
		<h4>Do you want to <strong><?php echo $course_data['status_action']; ?></strong> <?php echo $course_data['course']; ?>?</h4>
	</div>
	<div class="modal-footer">
		<input type="hidden" name="mode" value="<?php echo $course_data['status_action']; ?>">
		<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
		<button type="submit" class="btn btn-default">Yes</button>
	</div>
</form>