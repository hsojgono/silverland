<div class="modal-header">
	<h4 class="modal-title"><strong><?php echo $employee_salary['full_name']; ?></strong> Details</h4>
</div>
<div class="modal-body">
	<table class="table table-striped">
		<tr>
			<td>Monthly Salary:</td>
			<td><?php echo $employee_salary['employee_monthly_salary']; ?></td>
		</tr>
		<tr>
			<td>Salary Matrix Effective Date:</td>
			<td><?php echo $employee_salary['salary_matrix_effectivity_date']; ?></td>
		</tr>
		<tr>
			<td>Salary Grade Code:</td>
			<td><?php echo $employee_salary['salary_grade_code']; ?></td>
		</tr>
	</table>
</div>
<div class="modal-footer">
	<button class="btn btn-primary" data-dismiss="modal">Close</button>
</div>