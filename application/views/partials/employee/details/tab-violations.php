<div class="tab-pane fade" id="tab-violations">
	<div class="row">
		<div class="col-lg-12">
			<div class="pull-right">
				<a class="btn btn-primary" data-toggle="modal" data-target="#confirmation-add-violation" href="<?php echo site_url('employees/confirmation/add/employee_violations/'.$employee_id); ?>"><i class="fa fa-plus"></i> Add violation</a>
				<div class="modal fade" id="confirmation-add-violation">
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
			<table class="table table-striped">
				<thead>
					<tr>
						<th colspan="4">LIST OF VIOLATIONS</th>
					</tr>
					<tr>
						<!-- <th class="text-center">Action</th> -->
						<th>Violation</th>
						<!-- <th>Violation Level</th>
						<th>Violation Type</th> -->
						<th>Number of Offense</th>
						<th>Status</th>                        
					</tr>
				</thead>
				<tbody>
					<?php foreach ($employee_violations as $index => $employee_violation): ?>
					<tr>
						<!-- <td class="text-center">
							<a href="<//?php echo site_url('employees/view_violation_information/'.$violation['employee_violations_id']); ?>" data-toggle="modal" data-target="#employee-violation-view-more-<//?php echo $index; ?>">View More</a>
						</td> -->
						<td><?php echo $employee_violation['violation_name']; ?></td>
						<!-- <td><//?php echo $employee_violation['violation_level_name']; ?></td>
						<td><//?php echo $employee_violation['violation_type_name']; ?></td> -->
						<td><?php echo $employee_violation['number_of_offense']; ?></td>                        
						<td><?php echo $employee_violation['status_label']; ?></td>
					</tr>
					<!-- <div class="modal fade" id="employee-violation-view-more-<//?php echo $index; ?>">
						<div class="modal-dialog">
							<div class="modal-content"></div>
						</div>
					</div> -->
					<!-- <div class="modal fade" id="confirmation-edit-employee-violations-amount-<//?php echo $index; ?>">
						<div class="modal-dialog">
							<div class="modal-content"></div>
						</div>
					</div> -->
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

