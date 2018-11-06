<div class="modal-header">
	<h4 class="modal-title"><strong><?php echo $emergency_contact['employee_full_name']; ?></strong> Details</h4>
</div>
<div class="modal-body">
	<table class="table table-striped">
		<tr>
			<td>Full name: </td>
			<td><?php echo $emergency_contact['eec_full_name']; ?></td>
		</tr>
		<tr>
			<td>Address</td>
			<td><?php echo $emergency_contact['eec_full_address']; ?></td>
		</tr>
		<tr>
			<td>Relation</td>
			<td><?php echo $emergency_contact['relation_name']; ?></td>
		</tr>
		<tr>
			<td>Telephone Number</td>
			<td><?php echo $emergency_contact['eec_telephone_number']; ?></td>
		</tr>
		<tr>
			<td>Mobile Number</td>
			<td><?php echo $emergency_contact['eec_mobile_number']; ?></td>
		</tr>
	</table>
</div>
<div class="modal-footer">
	<button class="btn btn-primary" data-dismiss="modal">Close</button>
</div>

