<div class="row">
	<div class="col-md-3">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Details</h3>
			</div>
			<div class="box-body box-profile">
				<ul class="list-group list-group-unbordered">
					<li class="list-group-item">
						<b>Year Effective</b> <a class="pull-right"><?php echo $sss_matrix['year_effective']; ?></a>
					</li>
					<li class="list-group-item">
						<b>Description</b> <a class="pull-right"><?php echo $sss_matrix['description']; ?></a>
					</li>
					<li class="list-group-item">
						<b>Status Label</b> <a class="pull-right"><?php echo $sss_matrix['status_label']; ?></a>
					</li>
					<li class="list-group-item">
						<b>Created</b> <a class="pull-right"><?php echo date('F d, Y', strtotime($sss_matrix['created'])); ?></a>
					</li>
				</ul>
			</div>
		</div>
	</div>

	<div class="col-md-9">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">SSS Rates</h3>
				<div class="box-tools">
					<a href="<?php echo site_url('sss_contribution_rates/load_form/' . $sss_matrix['id']); ?>" class="btn btn-box-tool" data-toggle="modal" data-target="#md-add-sss-rate">
						<i class="fa fa-plus"></i> <span class="text-blue">Add New SSS Rate</span>
					</a>
				</div>
			</div>
			<div class="box-body">
				<div class="table-responsive">
					<table class="table table-bordered" id="datatables-sss-rates">
						<thead>
							<tr>
								<th>Action</th>
								<th>Minimum Range</th>
								<th>Maximum Range</th>
								<th>Monthly Salary Base</th>
								<th>Employer Share</th>
								<th>Employee Share</th>
								<th>Total</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
							<?php if ( ! empty($sss_rates)): ?>
							<?php foreach ($sss_rates as $index => $sss_rate): ?>
							<tr>
								<td>
									<a href="<?php echo site_url('sss_contribution_rates/details/' . $sss_rate['sss_rate_id']); ?>" class="btn btn-link" data-toggle="modal" data-target="#modal-details-<?php echo $index; ?>">
										<i class="fa fa-eye"></i> View
									</a>
									<a href="<?php echo site_url('sss_contribution_rates/confirmation/edit/' . $sss_rate['sss_rate_id']); ?>" class="btn btn-link" data-toggle="modal" data-target="#modal-confirmation-<?php echo $index; ?>">
										<i class="fa fa-edit"></i> Edit
									</a>
									<a href="<?php echo site_url('sss_contribution_rates/confirmation/' . $sss_rate['sr_status_url'] . '/' . $sss_rate['sss_rate_id']); ?>" class="btn btn-link" data-toggle="modal" data-target="#modal-confirmation-<?php echo $index; ?>">
										<i class="fa <?php echo $sss_rate['sr_status_icon']; ?>"></i> <?php echo $sss_rate['sr_status_action']; ?>
									</a>
								</td>
								<td><?php echo $sss_rate['sr_minimum_range']; ?></td>
								<td><?php echo $sss_rate['sr_maximum_range']; ?></td>
								<td><?php echo $sss_rate['sr_monthly_salary_base']; ?></td>
								<td><?php echo $sss_rate['sr_employer_share']; ?></td>
								<td><?php echo $sss_rate['sr_employee_share']; ?></td>
								<td><?php echo $sss_rate['sr_total']; ?></td>
								<td><?php echo $sss_rate['sr_status_label']; ?></td>
							</tr>

							<div class="modal fade" id="modal-details-<?php echo $index; ?>">
								<div class="modal-dialog">
									<div class="modal-content"></div>
								</div>
							</div>

							<div class="modal fade" id="modal-confirmation-<?php echo $index; ?>">
								<div class="modal-dialog">
									<div class="modal-content"></div>
								</div>
							</div>
							<?php endforeach ?>
							<?php endif ?>
						</tbody>
					</table>
				</div>
			</div>

			<div class="modal fade" id="md-add-sss-rate">
				<div class="modal-dialog">
					<div class="modal-content"></div>
				</div>
			</div>

			<?php if ($show_modal): ?>
				<div class="modal fade" id="modal-edit-tax-rate">
					<div class="modal-dialog">
						<div class="modal-content"><?php $this->load->view($modal_file_path); ?></div>
					</div>
				</div>
				<script type="text/javascript">
					$(function() {
						$('#modal-edit-tax-rate').modal({
							backdrop: false,
							keyboard: false
						});
					});
				</script>
			<?php endif ?>
		</div>
	</div>


</div>