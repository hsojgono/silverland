<div class="tab-pane fade" id="tab-benefits">
	<div class="row">
		<div class="col-lg-12">
			<div class="pull-right">
				<a class="btn btn-primary" data-toggle="modal" data-target="#confirmation-add-benefit" href="<?php echo site_url('employees/confirmation/add/employee_benefits/'.$employee_id); ?>"><i class="fa fa-plus"></i> Add Benefit</a>
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
			<table class="table table-striped">
				<thead>
					<tr>
						<th colspan="4">LIST OF BENEFITS</th>
					</tr>
					<tr>
						<th class="text-center">Action</th>
						<th>Benefit</th>
						<th>Amount</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($employee_benefits as $index => $benefit): ?>
					<tr>
						<td class="text-center">
							<a href="<?php echo site_url('employees/view_benefit_information/'.$benefit['employee_benefits_id']); ?>" data-toggle="modal" data-target="#employee-benefit-view-more-<?php echo $index; ?>">View More</a>
						</td>
						<td><?php echo $benefit['benefit_name']; ?></td>
						<td>
							<a href="<?php echo site_url('employees/confirmation/edit/employee_benefits/'.$benefit['employee_benefits_id']); ?>" data-toggle="modal" data-target="#confirmation-edit-employee-benefit-amount-<?php echo $index; ?>"><?php echo $benefit['employee_benefit_amount']; ?></a>
						</td>
						<td><?php echo $benefit['status_label']; ?></td>
					</tr>
					<div class="modal fade" id="employee-benefit-view-more-<?php echo $index; ?>">
						<div class="modal-dialog">
							<div class="modal-content"></div>
						</div>
					</div>
					<div class="modal fade" id="confirmation-edit-employee-benefits-amount-<?php echo $index; ?>">
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
