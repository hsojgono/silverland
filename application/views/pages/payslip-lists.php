<div class="row">
	<div class="col-sm-12">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">List of Employee Payslips</h3>
			</div>
			<div class="box-body">
				<div class="table-responsive">
					<table class="table table-bordered table-striped table-hover" id="datatables-payslips">
						<thead>
							<tr>
								<th style="width: 100px;">CODE</th>
								<th>EMPLOYEE NAME</th>
								<th>PAYROLL PERIOD</th>
								<th>PAYROLL CUTOFF</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($payslips as $index => $payslip): ?>
								<tr>
									<td class="text-right">
										<?php echo $payslip['employee_code']; ?>
									</td>
									<td>
										<a href="<?php echo site_url('employee_payslips/view/' . $payslip['id']); ?>">
											<span>
												<?php echo $payslip['full_name']; ?>
											</span>
										</a>
									</td>
									<td>
										<strong><?php echo date('F d', strtotime($payslip['start_date'])); ?> -
										<?php echo date('d, Y', strtotime($payslip['end_date'])); ?></strong>
									</td>
									<td>
										<?php echo $payslip['cut_off']; ?>
									</td>
								</tr>
								<div class="modal fade" id="modal-confirmation-<?php echo $index; ?>">
									<div class="modal-dialog">
										<div class="modal-content"></div>
									</div>
								</div>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">

	$(document).ready(function() {
		$('#datatables-payslips').DataTable({
			'aaSorting': [
				[2, 'desc'],
				[0, 'asc']
			]
		});
	});
	
</script>
