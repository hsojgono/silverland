<div class="modal-header">
	<h4 class="modal-title"><strong><?php echo $employee_benefit['full_name']; ?></strong> Details</h4>
</div>
<div class="modal-body">

	<table class="table table-striped">
		<tr>
			<td>Benefit Name:</td>
			<td><?php echo $employee_benefit['benefit_name']; ?></td>
		</tr>
		<tr>
			<td>Benefit Amount:</td>
			<td><?php echo $employee_benefit['employee_benefit_amount']; ?></td>
		</tr>
	</table>
</div>
<div class="modal-footer">
	<button class="btn btn-primary" data-dismiss="modal">Close</button>
</div>