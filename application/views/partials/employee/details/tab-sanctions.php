<div class="tab-pane fade" id="tab-sanctions">
	<div class="row">
		<div class="col-lg-12">
			<div class="pull-right">
				<a class="btn btn-primary" data-toggle="modal" data-target="#confirmation-add-sanction" href="<?php echo site_url('employees/confirmation/add/employee_sanctions/'.$employee_id); ?>"><i class="fa fa-plus"></i> Add Sanction</a>
				<div class="modal fade" id="confirmation-add-sanction">
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
						<th colspan="4">LIST OF SANCTIONS</th>
					</tr>
					<tr>
						<!-- <th class="text-center">Action</th> -->
						<th>Sanction</th>
						<!-- <th>sanction Level</th>
						<th>sanction Type</th> -->
						<th>Status</th>                        
					</tr>
				</thead>
				<tbody>
					<?php foreach ($employee_sanctions as $index => $employee_sanction): ?>
					<tr>
						<!-- <td class="text-center">
							<a href="<//?php echo site_url('employees/view_sanction_information/'.$sanction['employee_sanctions_id']); ?>" data-toggle="modal" data-target="#employee-sanction-view-more-<//?php echo $index; ?>">View More</a>
						</td> -->
						<td><?php echo $employee_sanction['sanction_name']; ?></td>
						<!-- <td><//?php echo $employee_sanction['sanction_level_name']; ?></td>
						<td><//?php echo $employee_sanction['sanction_type_name']; ?></td> -->                      
						<td><?php echo $employee_sanction['status_label']; ?></td>
					</tr>
					<!-- <div class="modal fade" id="employee-sanction-view-more-<//?php echo $index; ?>">
						<div class="modal-dialog">
							<div class="modal-content"></div>
						</div>
					</div> -->
					<!-- <div class="modal fade" id="confirmation-edit-employee-sanctions-amount-<//?php echo $index; ?>">
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


