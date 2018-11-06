<div class="modal-header">
	<h4 class="modal-title"><strong><?php echo $employee_position['full_name']; ?></strong> Details</h4>
</div>
<div class="modal-body">

	<table class="table table-striped">
		<tr>
			<td>Date Started:</td>
			<td><?php echo $employee_position['date_started']; ?></td>
		</tr>
		<tr>
			<td>Date Ended:</td>
			<td><?php echo $employee_position['date_ended']; ?></td>
		</tr>
		<tr>
			<td>Company:</td>
			<td><?php echo $employee_position['company']; ?></td>
		</tr>
		<tr>
			<td>Department:</td>
			<td><?php echo $employee_position['department']; ?></td>
		</tr>
	</table>
</div>
<div class="modal-footer">
	<button class="btn btn-primary" data-dismiss="modal">Close</button>
</div>