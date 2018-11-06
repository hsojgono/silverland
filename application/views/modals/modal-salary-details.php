<div class="modal-header"><h4 class="modal-title"><?php echo $modal_title; ?></h4></div>
<div class="modal-body">
	<div class="table-responsive">
		<table class="table table-bordered" id="datatables-salaries">
			<tr>
				<td>Salary Matrix</td>
				<td><strong><?php echo $salary['salary_matrix_desc']; ?></strong></td>
			</tr>
			<tr>
				<td>Maximum Range</td>
				<td><strong><?php echo $salary['monthly_salary']; ?></strong></td>
			</tr>
			<tr>
				<td>Status</td>
				<td><strong><?php echo $salary['status_label']; ?></strong></td>
			</tr>
		</table>
	</div>
</div>
<div class="modal-footer">
	<button class="btn btn-default" data-dismiss="modal">Close</button>
</div>