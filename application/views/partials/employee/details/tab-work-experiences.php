<div class="tab-pane fade" id="tab-work-experiences">
	<div class="row">
		<div class="col-lg-12">	
			<h3 class="box-title">List of Work Experiences</h3>

			<div class="pull-right">
				<a class="btn btn-primary" data-toggle="modal" data-target="#confirmation-add-work-experiences" href="<?php echo site_url('employees/confirmation/add/work_experience/'.$employee_id); ?>"><i class="fa fa-plus"></i> Add Work Experience</a>
				<div class="modal fade" id="confirmation-add-work-experiences">
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
			<table class="table table-bordered table-striped" id="datatables-employees">
				<thead>
					<tr>
						<th style="width: 50px;">&nbsp;</th>
						<th>Company</th>
						<th>Position</th>
                        <th>Immediate Supervisor</th>
                        <th>Employment Type</th>
                        <th>Salary</th>
                        <th>Date Hired</th>
                        <th>Date Separated</th>

					</tr>
				</thead>
				<tbody>
					<?php foreach ($employee_work_experiences as $index => $employee_work_experience): ?>
					<tr>
						<td class="text-center">
							
							<a href="<?php echo site_url('employees/edit_employee_work_experience/'.$employee_work_experience['employee_work_experience_id']); ?>" data-toggle="modal" data-target="#confirmation-edit-employee-work-experience-<?php echo $index; ?>">
								<i class="fa fa-pencil-square-o" title="Edit" data-toggle="tooltip"></i> 
							</a>	

						</td>
						<td><?php echo $employee_work_experience['company_name']; ?></td>
						<td><?php echo $employee_work_experience['position']; ?></td>
						<td><?php echo $employee_work_experience['immediate_superior']; ?></td>
						<td><?php echo $employee_work_experience['employment_type_name']; ?></td>
						<td><?php echo $employee_work_experience['salary']; ?></td>
						<td><?php echo date('M d, Y', strtotime($employee_work_experience['date_hired'])); ?></td>
						<td><?php echo date('M d, Y', strtotime($employee_work_experience['date_separated'])); ?></td>
					</tr>

					<div class="modal fade" id="employee-work-experience-view-more-<?php echo $index; ?>">
						<div class="modal-dialog">
							<div class="modal-content"></div>
						</div>
					</div>
                        <div class="modal fade" id="confirmation-edit-employee-work-experience-<?php echo $index; ?>">
                            <div class="modal-dialog">
                                <div class="modal-content"></div>
                            </div>
                        </div>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
