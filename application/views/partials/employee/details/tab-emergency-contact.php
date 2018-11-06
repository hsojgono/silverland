<div class="tab-pane fade" id="tab-emergency-contact">
	<div class="row">
		<div class="col-lg-12">
			<table class="table table-striped">
				<thead>
					<tr>
						<th colspan="4">LIST OF EMERGENCY CONTACT</th>
					</tr>
					<tr>
						<th class="text-center" colspan="1">Action</th>
						<th>Fullname</th>
						<th>Address</th>
						<th>Relation</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($emergency_contacts as $index => $contact): ?>
					<tr>
						<td class="text-center">
							<a href="<?php echo site_url('employees/view_emergency_contact/'.$contact['eec_id']); ?>" data-toggle="modal" data-target="#emergency-contact-view-more-<?php echo $index; ?>">View More</a>
						</td>
						<td><?php echo $contact['eec_full_name']; ?></td>
						<td><?php echo $contact['eec_full_address']; ?></td>
						<td><?php echo $contact['relation_name']; ?></td>
						<td><?php echo $contact['status_label']; ?></td>
					</tr>
					<div class="modal fade" id="emergency-contact-view-more-<?php echo $index; ?>">
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
