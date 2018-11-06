<div class="modal-header">
	<h4 class="modal-title"><strong><?php echo $daily_time_records['full_name']; ?></strong> Details</h4>
</div>
<div class="modal-body">

	<table class="table table-striped">
		<tr>
			<td>Remarks:</td>
			<td><?php echo $daily_time_records['remarks']; ?></td>
		</tr>
		<tr>
			<td>Shift Schedule:</td>
			<td><?php echo $daily_time_records['shift']; ?></td>
		</tr>
	</table>
</div>
<div class="modal-footer">
	<button class="btn btn-primary" data-dismiss="modal">Close</button>
</div>