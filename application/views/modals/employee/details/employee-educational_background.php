<div class="modal-header">
	<h4 class="modal-title"><strong><?php echo $employee_educational_background['full_name']; ?></strong> Details</h4>
</div>
<div class="modal-body">

	<table class="table table-striped">
		<tr>
			<td>Level </td>
			<td><?php echo $employee_educational_background['ea_name']; ?></td>
		</tr>
		<tr>
			<td>Course</td>
			<td><?php echo $employee_educational_background['ea_desc']; ?></td>
		</tr>
		<tr>
			<td>School</td>
			<td><?php echo $employee_educational_background['school']; ?></td>
		</tr>
		<tr>
			<td>Year Started</td>
			<td><?php echo $employee_educational_background['year_start']; ?></td>
		</tr>
		<tr>
			<td>Year Ended</td>
			<td><?php echo $employee_educational_background['year_end']; ?></td>
		</tr>
		<tr>
			<td>Certification</td>
			<td><?php echo $employee_educational_background['certification']; ?></td>
		</tr>
		<tr>
			<td>Awards</td>
			<td><?php echo $employee_educational_background['awards']; ?></td>
		</tr>
		<tr>
			<td>GPA</td>
			<td><?php echo $employee_educational_background['gpa']; ?></td>
		</tr>
		<tr>
			<td>Major GPA</td>
			<td><?php echo $employee_educational_background['country_number_code']; ?></td>
		</tr>
	</table>
</div>
<div class="modal-footer">
	<button class="btn btn-primary" data-dismiss="modal">Close</button>
</div>

