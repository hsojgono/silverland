<div class="tab-pane fade" id="tab-salary">
	
	<div class="row">
		<div class="col-lg-12">
			<div class="pull-right">
				<!-- <a class="btn btn-primary" data-toggle="modal" data-target="#confirmation-add-benefit" href="<?php //echo site_url('employees/test_confirm/add_salary/'.$employee_id); ?>"><i class="fa fa-plus"></i> Add Salary</a>
				<div class="modal fade" id="confirmation-add-benefit">
					<div class="modal-dialog">
						<div class="modal-content"></div>
					</div>
				</div> -->

				<a class="btn btn-primary" data-toggle="modal" data-target="#confirmation-add-benefit" href="<?php echo site_url('employees/test_confirm/set_salary/'.$employee_id); ?>"><i class="fa fa-plus"></i> Set Salary</a>
				<div class="modal fade" id="confirmation-add-benefit">
					<div class="modal-dialog">
						<div class="modal-content"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-lg-12">
			<table class="table table-striped" id="datatables-employee-salaries">
				<tr>
					<!-- <th>&nbsp;</th> -->
					<th>Salary Matrix Effective Date</th>
					<th>Salary Grade Code</th>
					<th>Monthly Salary</th>
					<th>Status</th>
				</tr>
				<?php foreach ($employee_salaries as $index => $salary): ?>
				<tr>
					<!-- <td>
						<a href="<?php echo site_url('employees/confirmation/edit/'.$salary['employee_id']); ?>">
							<i class="fa fa-pencil"></i> Edit
						</a>
					</td> -->
					<!-- <td class="text-center">
						<a href="<?php //echo site_url('employees/view_salary_information/'.$salary['employee_salaries_id']); ?>" data-toggle="modal" data-target="#employee-salary-view-more<?php //echo $index; ?>">View More</a>
					</td> -->
					<td><?php echo $salary['salary_matrix_effectivity_date']; ?></td>
					<td><?php echo $salary['salary_grade_code']; ?></td>
					<td><?php echo $salary['employee_monthly_salary']; ?></td>
					<td><?php echo $salary['status_label']; ?></td>
				</tr>
				<div class="modal fade" id="employee-salary-view-more<?php echo $index; ?>">
					<div class="modal-dialog">
						<div class="modal-content"></div>
					</div>
				</div>
				<?php endforeach ?>
			</table>
		</div>
	</div>
</div>
