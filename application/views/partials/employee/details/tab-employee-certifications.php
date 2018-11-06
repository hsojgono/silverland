<div class="tab-pane fade" id="tab-employee-certifications">
	<div class="row">
		<div class="col-lg-12">	
				<h3 class="box-title">List of Certifications </h3>
				
			<div class="pull-right">
				<a class="btn btn-primary" data-toggle="modal" data-target="#confirmation-add-employee-certifications" href="<?php echo site_url('employees/confirmation/add/employee_certifications/'.$employee_id); ?>"><i class="fa fa-plus"></i> Add Certification</a>
				<div class="modal fade" id="confirmation-add-employee-certifications">
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
						<th>Name</th>
						<th>Number of Certificate</th>
                        <th>Issuing Authority</th>
                        <th>Date Received</th>
                        <th>Validity</th>
                        <th>Company</th>
                        <!-- <th>Attachment</th> -->

					</tr>
				</thead>
				<tbody>
					<?php foreach ($employee_certifications as $index => $certification): ?>
					<tr>
						<td class="text-center">
							
							<a href="<?php echo site_url('employees/edit_employee_certifications/'.$certification['employee_certification_id']); ?>" data-toggle="modal" data-target="#confirmation-edit-employee-certification-<?php echo $index; ?>">
								<i class="fa fa-pencil-square-o" title="Edit" data-toggle="tooltip"></i> 
							</a>	

						</td>
						<td class="text-left"><?php echo $certification['name']; ?></td>
						<td class="text-right"><?php echo $certification['number']; ?></td>
						<td class="text-left"><?php echo $certification['issuing_authority']; ?></td>
						<td class="text-right"><?php echo date('Y-m-d', strtotime($certification['date_received'])); ?></td>
						<td class="text-right"><?php echo date('Y-m-d', strtotime($certification['validity'])); ?></td>
						<td class="text-left"><?php echo $certification['company_name']; ?></td>
						<!-- <td><?php echo $certification['attachment']; ?></td> -->
					</tr>

				    <div class="modal fade" id="employee-work-experience-view-more-<?php echo $index; ?>">
						<div class="modal-dialog">
							<div class="modal-content"></div>
						</div>
					</div>
					<div class="modal fade" id="confirmation-edit-employee-certification-<?php echo $index; ?>">
						<div class="modal-dialog">
							<div class="modal-content"></div>
						</div>
					</div>
                        </div>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
