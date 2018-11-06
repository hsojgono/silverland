<div class="modal-header">
	<h4 class="modal-title"><strong><?php echo $employee_contact['employee_full_name']; ?></strong> Details</h4>
</div>
<div class="modal-body">

	<table class="table table-striped">
		<tr>
			<td>Telephone Number: </td>
			<td><?php echo $employee_contact['employee_telephone_number']; ?></td>
		</tr>
		<tr>
			<td>Mobile Number:</td>
			<td><?php echo $employee_contact['employee_mobile_number']; ?></td>
		</tr>
		<tr>
			<td>Email</td>
			<td><?php echo $employee_contact['employee_email']; ?></td>
		</tr>
		<tr><td colspan="2"><h4><strong>Emergency Contact Person</strong></h4></td></tr>
		<tr>
			<td>Name</td>
			<td><?php echo $employee_contact['eec_full_name']; ?></td>
		</tr>
		<tr>
			<td>Telephone Number:</td>
			<td><?php echo $employee_contact['eec_telephone_number']; ?></td>
		</tr>
		<tr>
			<td>Mobile Number:</td>
			<td><?php echo $employee_contact['eec_mobile_number']; ?></td>
		</tr>
		<tr>
			<td>Address</td>
			<td><?php echo $employee_contact['eec_full_address']; ?></td>
		</tr>
	</table>
</div>
<div class="modal-footer">
	<button class="btn btn-primary" data-dismiss="modal">Close</button>
</div>

