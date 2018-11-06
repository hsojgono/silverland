<div class="tab-pane fade" id="tab-contact-numbers">
	<!-- <div class="row">
		<div class="col-lg-12">
			<div class="pull-right">
				<a class="btn btn-primary" data-toggle="modal" data-target="#confirmation-add-contact-number" href="<?php echo site_url('employees/confirmation/add/employee_contact_number/'.$employee_id); ?>"><i class="fa fa-plus"></i> Add address</a>
				<div class="modal fade" id="confirmation-add-contact-number">
					<div class="modal-dialog">
						<div class="modal-content"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<br> -->
	<div class="row">
		<div class="col-lg-12">
			<table class="table table-striped">
				<thead>
					<tr>
						<th colspan="4">LIST OF CONTACT NUMBERS</th>
					</tr>
					<tr>
						<th class="text-center">Action</th>
						<th>Telephone Number</th>
						<th>Mobile Number</th>
						<th>Email</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($employee_contacts as $index => $contact): ?>
					<tr>
						<td class="text-center">
							<a href="<?php echo site_url('employees/view_contact_information/'.$contact['employee_contact_id']); ?>" data-toggle="modal" data-target="#employee-contact-view-more-<?php echo $index; ?>">View More</a>
						</td>
						<td><?php echo $contact['employee_telephone_number']; ?></td>
						<td><?php echo $contact['employee_mobile_number']; ?></td>
						<td><?php echo $contact['employee_email']; ?></td>
						<td><?php echo $contact['status_label']; ?></td>
					</tr>
					<div class="modal fade" id="employee-contact-view-more-<?php echo $index; ?>">
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
