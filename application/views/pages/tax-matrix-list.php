<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Tax Matrices</h3>
				<div class="box-tools">
					<a href="<?php echo site_url('tax_matrix/load_form'); ?>" class="btn btn-box-tool" data-toggle="modal" data-target="#md-add-matrix">
						<i class="fa fa-plus"></i> <span class="text-blue">Add New Tax Matrix</span>
					</a>
				</div>
			</div>
			<div class="box-body">
				<div class="table-responsive">
					<table class="table table-bordered" id="datatables-tax-matrix">
						<thead>
							<tr>
								<th>Action</th>
								<th>Year Effective</th>
								<th>Description</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
							<?php if ( ! empty($tax_matrices)): ?>
							<?php foreach ($tax_matrices as $index => $tax_matrix): ?>
							<tr>
								<td>
									<a href="<?php echo site_url('tax_matrix/details/' . $tax_matrix['id']); ?>" class="btn btn-link">
										<i class="fa fa-eye"></i> View
									</a>
									<a href="<?php echo site_url('tax_matrix/confirmation/edit/' . $tax_matrix['id']); ?>" class="btn btn-link" data-toggle="modal" data-target="#modal-confirmation-<?php echo $index; ?>">
										<i class="fa fa-edit"></i> Edit
									</a>
									<a href="<?php echo site_url('tax_matrix/confirmation/' . $tax_matrix['status_url'] . '/' . $tax_matrix['id']); ?>" class="btn btn-link" data-toggle="modal" data-target="#modal-confirmation-<?php echo $index; ?>">
										<i class="fa <?php echo $tax_matrix['status_icon']; ?>"></i> <?php echo $tax_matrix['status_action']; ?>
									</a>
								</td>
								<td><?php echo $tax_matrix['year_effective']; ?></td>
								<td><?php echo $tax_matrix['description']; ?></td>
								<td><?php echo $tax_matrix['status_label']; ?></td>
							</tr>

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
		</div>

		<div class="modal fade" id="md-add-matrix">
			<div class="modal-dialog">
				<div class="modal-content"></div>
			</div>
		</div>

		<?php if ($show_modal): ?>
				<div class="modal fade" id="modal-show">
					<div class="modal-dialog">
						<div class="modal-content"><?php $this->load->view($modal_file_path); ?></div>
					</div>
				</div>
				<script type="text/javascript">
					$(function() {
						$('#modal-show').modal({
							backdrop: false,
							keyboard: false
						});
					});
				</script>
			<?php endif ?>
	</div>
</div>