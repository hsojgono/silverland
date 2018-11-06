<div class="tab-pane fade" id="tab-employee-trainings">
	<div class="row">
		<div class="col-lg-12">	
				<h3 class="box-title">List of Trainings </h3>
				
			<div class="pull-right">
				<a class="btn btn-primary" data-toggle="modal" data-target="#confirmation-add-employee-trainings" href="<?php echo site_url('employees/confirmation/add/employee_trainings/'.$employee_id); ?>"><i class="fa fa-plus"></i> Add training</a>
				<div class="modal fade" id="confirmation-add-employee-trainings">
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
						<th style="width: 80px;">&nbsp;</th>
						<th>Training Title</th>
						<th>Acquired From</th>
                        <th>Company</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($employee_trainings as $index => $employee_training): ?>
					<tr>
						<td class="text-center">
							 <a href="<?php echo site_url('employees/edit_employee_training/'.$employee_training['training_id']); ?>" data-toggle="modal" data-target="#confirmation-edit-employee-training-<?php echo $index; ?>">
							 	<i class="fa fa-pencil-square-o" title="Edit" data-toggle="tooltip"></i> 
							</a>					
						</td>
                        <td><?php echo $employee_training['training_title']; ?></td>
                        <td><?php echo $employee_training['job_status']; ?></td>
						<td><?php echo $employee_training['company_name']; ?></td>
					</tr>

                         <div class="modal fade" id="confirmation-edit-employee-training-<?php echo $index; ?>">
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

