<form method="post" action=" <?php echo site_url('attendance_undertimes/reject_undertime/'.$undertime_data['id']); ?> ">
	
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">Reject Undertime</h4>
	</div>
	<div class="modal-body">
		<h4>Do you want to reject this undertime?</h4>
	</div>
	<div class="modal-footer">
		<input type="hidden" name="mode" value="reject">
		<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
		<button type="submit" class="btn btn-success">Yes</button>
	</div>

</form>