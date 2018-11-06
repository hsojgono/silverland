<div class="tab-pane fade" id="tab-dependents">
	<div class="row">
		<div class="col-lg-12">
			<div class="pull-right">
				<a class="btn btn-primary" data-toggle="modal" data-target="#confirmation-add-dependent" href="<?php echo site_url('employees/confirmation/add/employee_dependent/'.$employee_id); ?>"><i class="fa fa-plus"></i> Add Dependent</a>
				<div class="modal fade" id="confirmation-add-dependent">
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
						<th colspan="4">LIST OF DEPENDENTS</th>
					</tr>
					<tr>
						<th class="text-center" colspan="1">Action</th>
						<th>Fullname</th>
						<th>Address</th>
						<th>Relation</th>
						<th>Birthdate</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($employee_dependents as $index => $dependent): ?>
					<tr>
						<td class="text-center">
							<a href="<?php echo site_url('employees/view_dependent_information/'.$dependent['employee_dependent_id']); ?>" data-toggle="modal" data-target="#employee-dependent-view-more-<?php echo $index; ?>">View More</a>
						</td>
						<!-- <td>
							<a href="<?php // echo site_url('employees/confirmation/edit/employee_dependents/'.$dependent['employee_dependent_id']); ?>" data-toggle="modal" data-target="#confirmation-edit-employee-dependent-<?php echo $index; ?>">Edit</a>
						</td> -->
						<td><?php echo $dependent['dependent_full_name']; ?></td>
						<td><?php echo $dependent['dependent_address']; ?></td>
						<td><?php echo $dependent['relation_name']; ?></td>
						<td><?php echo $dependent['birthdate']; ?></td>
					</tr>
					<div class="modal fade" id="employee-dependent-view-more-<?php echo $index; ?>">
						<div class="modal-dialog">
							<div class="modal-content"></div>
						</div>
					</div>
					<div class="modal fade" id="confirmation-edit-employee-dependents-amount-<?php echo $index; ?>">
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
