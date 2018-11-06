<div class="row">
	<div class="col-md-3">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Details</h3>
			</div>
			<div class="box-body box-profile">
				<ul class="list-group list-group-unbordered">
					<li class="list-group-item">
						<b>Date Effective</b> <a class="pull-right"><?php echo $salary['effectivity_date']; ?></a>
					</li>
					<li class="list-group-item">
						<b>Description</b> <a class="pull-right"><?php echo $salary['description']; ?></a>
					</li>
					<li class="list-group-item">
						<b>Status Label</b> <a class="pull-right"><?php echo $salary['status_label']; ?></a>
					</li>
					<li class="list-group-item">
						<b>Created</b> <a class="pull-right"><?php echo date('F d, Y', strtotime($salary['created'])); ?></a>
					</li>
				</ul>
			</div>
		</div>
	</div>

	<div class="col-md-9">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Salaries</h3>
				<div class="box-tools">
					<a href="<?php echo site_url('salaries/load_form/' . $salary['id']); ?>" class="btn btn-box-tool" data-toggle="modal" data-target="#md-add-salary-matrix">
						<i class="fa fa-plus"></i> <span class="text-blue">Add Salary</span>
					</a>
				</div>
			</div>
			<div class="box-body">
				<div class="table-responsive">
					<table class="table table-bordered" id="datatables-salaries">
						<thead>
							<tr>
								<th>Action</th>
								<th>Salary Matrix</th>
								<th>Monthly Salary</th>
							</tr>
						</thead>
						<tbody>
							<?php if ( ! empty($salaries)): ?>
							<?php foreach ($salaries as $index => $salary): ?>
							<tr>
								<td>
									<a href="<?php echo site_url('salaries/details/' . $salary['id']); ?>" class="btn btn-link" data-toggle="modal" data-target="#modal-details-<?php echo $index; ?>">
										<i class="fa fa-eye"></i> View
									</a>
									<a href="<?php echo site_url('salaries/confirmation/edit/' . $salary['id']); ?>" class="btn btn-link" data-toggle="modal" data-target="#modal-confirmation-<?php echo $index; ?>">
										<i class="fa fa-edit"></i> Edit
									</a>
									<a href="<?php echo site_url('salaries/confirmation/' . $salary['sr_status_url'] . '/' . $salary['id']); ?>" class="btn btn-link" data-toggle="modal" data-target="#modal-confirmation-<?php echo $index; ?>">
										<i class="fa <?php echo $salary['sr_status_icon']; ?>"></i> <?php echo $salary['sr_status_action']; ?>
									</a>
								</td>
								<td><?php echo $salary['sr_minimum_range']; ?></td>
								<td><?php echo $salary['sr_maximum_range']; ?></td>
								<td><?php echo $salary['sr_status_label']; ?></td>
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

			<div class="modal fade" id="md-add-salary-matrix">
				<div class="modal-dialog">
					<div class="modal-content"></div>
				</div>
			</div>

			<?php if ($show_modal): ?>
				<div class="modal fade" id="modal-edit-salary-matrix">
					<div class="modal-dialog">
						<div class="modal-content"><?php $this->load->view($modal_file_path); ?></div>
					</div>
				</div>
				<script type="text/javascript">
					$(function() {
						$('#modal-edit-salary-matrix').modal({
							backdrop: false,
							keyboard: false
						});
					});
				</script>
			<?php endif ?>
		</div>
	</div>


</div>