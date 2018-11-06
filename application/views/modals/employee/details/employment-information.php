<div class="modal-header">
	<h4 class="modal-title"><strong><?php echo $employment_information['full_name']; ?></strong> Details</h4>
</div>
<div class="modal-body">

	<table class="table table-striped">
		<tr>
			<td>Date Hired:</td>
			<td><?php echo $employment_information['date_hired']; ?></td>
		</tr>
		<tr>
			<td>Regularized:</td>
			<td><?php echo $employment_information['regularization_label']; ?></td>
		</tr>
		<tr>
			<td>Date Regularized:</td>
			<td><?php echo $employment_information['date_regularized']; ?></td>
		</tr>
		<tr>
			<td>Department:</td>
			<td><?php echo $employment_information['department']; ?></td>
		</tr>
		<tr>
			<td>Position:</td>
			<td><?php echo $employment_information['position']; ?></td>
		</tr>
		<tr>
			<td>Employee Type:</td>
			<td><?php echo $employment_information['employee_type']; ?></td>
		</tr>
		<tr>
			<td>TIN Number:</td>
			<td><?php echo $employment_information['tin']; ?></td>
		</tr>
		<tr>
			<td>SSS Number:</td>
			<td><?php echo $employment_information['sss']; ?></td>
		</tr>
		<tr>
			<td>HDMF Number:</td>
			<td><?php echo $employment_information['hdmf']; ?></td>
		</tr>
		<tr>
			<td>PhilHealth Number:</td>
			<td><?php echo $employment_information['phic']; ?></td>
		</tr>
	</table>
</div>
<div class="modal-footer">
	<button class="btn btn-primary" data-dismiss="modal">Close</button>
</div>