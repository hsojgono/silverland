<div class="modal-header">
	<h4 class="modal-title"><strong><?php echo $employee_dependent['dependent_full_name']; ?></strong> Details</h4>
</div>
<div class="modal-body">

	<table class="table table-striped">
		<tr>
			<td>Block Number:</td>
			<td><?php echo $employee_dependent['block_number']; ?></td>
		</tr>
		<tr>
			<td>Lot Number:</td>
			<td><?php echo $employee_dependent['lot_number']; ?></td>
		</tr>
		<tr>
			<td>Floor Number:</td>
			<td><?php echo $employee_dependent['floor_number']; ?></td>
		</tr>
		<tr>
			<td>Building Number:</td>
			<td><?php echo $employee_dependent['building_number']; ?></td>
		</tr>
		<tr>
			<td>Building Name:</td>
			<td><?php echo $employee_dependent['building_name']; ?></td>
		</tr>
		<tr>
			<td>Street:</td>
			<td><?php echo $employee_dependent['street']; ?></td>
		</tr>
		<tr>
			<td>Relation:</td>
			<td><?php echo $employee_dependent['relation_name']; ?></td>
		</tr>
	</table>
</div>
<div class="modal-footer">
	<button class="btn btn-primary" data-dismiss="modal">Close</button>
</div>