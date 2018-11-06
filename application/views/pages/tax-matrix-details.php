<div class="row">
	<div class="col-md-3">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Details</h3>
			</div>
			<div class="box-body box-profile">
				<ul class="list-group list-group-unbordered">
					<li class="list-group-item">
						<b>Year Effective</b> <a class="pull-right"><?php echo $tax_matrix['year_effective']; ?></a>
					</li>
					<li class="list-group-item">
						<b>Description</b> <a class="pull-right"><?php echo $tax_matrix['description']; ?></a>
					</li>
					<li class="list-group-item">
						<b>Status Label</b> <a class="pull-right"><?php echo $tax_matrix['status_label']; ?></a>
					</li>
					<li class="list-group-item">
						<b>Created</b> <a class="pull-right"><?php echo date('F d, Y', strtotime($tax_matrix['created'])); ?></a>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="col-md-9">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Tax Rates</h3>
				<div class="box-tools">
					<a href="<?php echo site_url('tax_rates/load_form/' . $tax_matrix['id']); ?>" class="btn btn-box-tool" data-toggle="modal" data-target="#modal-add-tax-rate">
						<i class="fa fa-plus"></i> <span class="text-blue">Add New Tax Rate</span>
					</a>
				</div>
			</div>
			<div class="box-body">
				<div class="table-responsive">
					<table class="table table-bordered" id="datatables-tax-rates">
						<thead>
							<tr>
								<th class="text-center">Action</th>
								<th class="text-center">Tax Excemption Status</th>
								<th class="text-center">Base Tax</th>
								<th class="text-center">Percentage Over</th>
								<th class="text-center">Minimum Monthly Salary</th>
								<th class="text-center">Maximum Monthly Salary</th>
							</tr>
						</thead>
						<tbody>
							<?php if ( ! empty($tax_rates)): ?>
							<?php foreach ($tax_rates as $index => $tax_rate): ?>
							<tr>
								<td class="text-center">
									<a href="<?php echo site_url('tax_rates/details/' . $tax_rate['tax_rate_id']); ?>" class="btn btn-link btn-sm" data-toggle="modal" data-target="#modal-tax-rate-detail-<?php echo $index; ?>">
										<i class="fa fa-eye"></i> View
									</a>
									<a href="<?php echo site_url('tax_rates/confirmation/edit/' . $tax_rate['tax_rate_id']); ?>" class="btn btn-link btn-sm" data-toggle="modal" data-target="#modal-confirmation-<?php echo $index; ?>">
										<i class="fa fa-edit"></i> Edit
									</a>
									<a href="<?php echo site_url('tax_rates/confirmation/' . $tax_rate['tr_status_url'] . '/' . $tax_rate['tax_rate_id']); ?>" class="btn btn-link btn-sm" data-toggle="modal" data-target="#modal-confirmation-<?php echo $index; ?>">
										<i class="fa <?php echo $tax_rate['tr_status_icon']; ?>"></i> <?php echo $tax_rate['tr_status_action']; ?>
									</a>
								</td>
								<td class="text-center"><?php echo $tax_rate['te_tax_code']; ?></td>
								<td class="text-center"><?php echo $tax_rate['tr_base_tax']; ?></td>
								<td class="text-center"><?php echo $tax_rate['tr_percentage_over']; ?></td>
								<td class="text-center"><?php echo $tax_rate['tr_minimum_monthly_salary']; ?></td>
								<td class="text-center"><?php echo $tax_rate['tr_maximum_monthly_salary']; ?></td>
							</tr>

							<!-- MODAL FORM DETAILS TAX RATE -->
							<div class="modal fade" id="modal-tax-rate-detail-<?php echo $index; ?>">
								<div class="modal-dialog">
									<div class="modal-content"></div>
								</div>
							</div>

							<!-- MODAL FORM EDIT TAX RATE -->
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
			
			<!-- MODAL FORM ADD TAX RATE -->
			<div class="modal fade" id="modal-add-tax-rate">
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
<script type="text/javascript" src="<?php echo site_url('assets/js/form_validations/tax-rates.js'); ?>"></script>