<div class="tab-pane fade" id="tab-address">
	<div class="row">
		<div class="col-lg-12">
			<div class="pull-right">
				<a class="btn btn-primary" data-toggle="modal" data-target="#confirmation-add-address" href="<?php echo site_url('employees/confirmation/add/employee_address/'.$employee_id); ?>"><i class="fa fa-plus"></i> Add address</a>
				<div class="modal fade" id="confirmation-add-address">
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
						<th colspan="4">LIST OF ADDRESS</th>
					</tr>
					<tr>
						<!-- <th class="text-center">Action</th> -->
						<th>Type</th>
						<th>Address</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($employee_adresses as $index => $address): ?>
					<tr>
						<!-- <td class="text-center">
							<a href="<?php echo site_url('employees/view_address_information/'.$address['employee_address_id']); ?>" data-toggle="modal" data-target="#employee-address-view-more-<?php echo $index; ?>">View More</a>
						</td> -->
						<td><?php echo $address['address_type_label']; ?></td>
						<td><?php echo $address['full_address']; ?></td>
					</tr>
					<div class="modal fade" id="employee-address-view-more-<?php echo $index; ?>">
						<div class="modal-dialog">
							<div class="modal-content"></div>
						</div>
					</div>
					<div class="modal fade" id="confirmation-edit-employee-addresss-amount-<?php echo $index; ?>">
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
