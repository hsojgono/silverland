<div class="row">
	<div class="col-md-3">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Details</h3>
			</div>
			<div class="box-body box-profile">
				<ul class="list-group list-group-unbordered">
					<li class="list-group-item">
						<b>Year Effective</b> <a class="pull-right"><?php echo $hdmf_matrix['year_effective']; ?></a>
					</li>
					<li class="list-group-item">
						<b>Description</b> <a class="pull-right"><?php echo $hdmf_matrix['description']; ?></a>
					</li>
					<li class="list-group-item">
						<b>Status Label</b> <a class="pull-right"><?php echo $hdmf_matrix['status_label']; ?></a>
					</li>
					<li class="list-group-item">
						<b>Created</b> <a class="pull-right"><?php echo date('F d, Y', strtotime($hdmf_matrix['created'])); ?></a>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="col-md-9">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">HDMF Rates</h3>
				<div class="box-tools">
					<a href="<?php echo site_url('hdmf_contribution_rates/load_form/' . $hdmf_matrix['id']); ?>" class="btn btn-box-tool" data-toggle="modal" data-target="#modal-add-hdmf">
						<i class="fa fa-plus"></i> <span class="text-blue">Add New HDMF Rate</span>
					</a>
				</div>
			</div>
			<div class="box-body">
				<div class="table-responsive">
					<table class="table table-bordered" id="datatables-tax-rates">
						<thead>
							<tr>
								<th>Action</th>
								<th>Minimum Monthly Salary</th>
								<th>Maximum Monthly Salary</th>
								<th>Employee Shares</th>
								<th>Employer Shares</th>
							</tr>
						</thead>
						<tbody>
							<?php if ( ! empty($hdmf_rates)): ?>
							<?php foreach ($hdmf_rates as $index => $hdmf_rate): ?>
							<tr>
								<td>
									<a href="<?php echo site_url('hdmf_contribution_rates/details/' . $hdmf_rate['hdmf_rate_id']); ?>" class="btn btn-link btn-sm" data-toggle="modal" data-target="#modal-details-<?php echo $index; ?>">
										<i class="fa fa-eye"></i> View
									</a>
									<a href="<?php echo site_url('hdmf_contribution_rates/confirmation/edit/' . $hdmf_rate['hdmf_rate_id']); ?>" class="btn btn-link btn-sm" data-toggle="modal" data-target="#modal-edit-<?php echo $index; ?>">
										<i class="fa fa-edit"></i> Edit
									</a>
									<a href="<?php echo site_url('hdmf_contribution_rates/confirmation/' . $hdmf_rate['hr_status_url'] . '/' . $hdmf_rate['hdmf_rate_id']); ?>" class="btn btn-link btn-sm" data-toggle="modal" data-target="#modal-update-status-<?php echo $index; ?>">
										<i class="fa <?php echo $hdmf_rate['hr_status_icon']; ?>"></i> <?php echo $hdmf_rate['hr_status_action']; ?>
									</a>
								</td>
								<td><?php echo $hdmf_rate['hr_minimum_range']; ?></td>
								<td><?php echo $hdmf_rate['hr_maximum_range']; ?></td>
								<td><?php echo $hdmf_rate['hr_employee_share']; ?></td>
								<td><?php echo $hdmf_rate['hr_employer_share']; ?></td>
							</tr>
							<div class="modal fade" id="modal-details-<?php echo $index; ?>">
								<div class="modal-dialog">
									<div class="modal-content"></div>
								</div>
							</div>
							<div class="modal fade" id="modal-edit-<?php echo $index; ?>">
								<div class="modal-dialog">
									<div class="modal-content"></div>
								</div>
							</div>
							<div class="modal fade" id="modal-update-status-<?php echo $index; ?>">
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
			<div class="modal fade" id="modal-add-hdmf">
				<div class="modal-dialog">
					<div class="modal-content"></div>
				</div>
			</div>
			<?php if ($show_modal): ?>
				<div class="modal fade" id="modal-edit-hdmf-rate">
					<div class="modal-dialog">
						<div class="modal-content"><?php $this->load->view($modal_file_path); ?></div>
					</div>
				</div>
				<script type="text/javascript">
					$(function() {
						$('#modal-edit-hdmf-rate').modal({
							backdrop: false,
							keyboard: false
						});
					});
				</script>
			<?php endif ?>
		</div>
	</div>
</div>