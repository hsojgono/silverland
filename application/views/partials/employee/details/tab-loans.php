<div class="tab-pane fade" id="tab-loans">
	<div class="row">
		<div class="col-lg-12">

					<div class="modal-dialog">
						<div class="modal-content"></div>
					</div>

		</div>
	</div>
	<br>
    <div class="row">
    	<div class="col-lg-5">
    		<div class="well">
    			<table class="table table-striped">
					<tr>
						<td>Start Date</td>
						<td><?php echo date('d F Y', strtotime($employee_loans['date_start'])); ?></td>
					</tr>
					<tr>
						<td>Loan</td>
						<td><?php echo number_format($employee_loans['loan_amount'],2); ?></td>
					</tr>
					<tr>
						<td>Interest</td>
						<td><?php echo number_format($employee_loans['interest_per_month'],2);?>/month</td>
					</tr>
					<tr>
						<td>Term(s)</td>
						<td><?php echo $employee_loans['months_to_pay']; ?></td>
					</tr>
					<tr>
						<td>Total Loan</td>
						<td><?php echo number_format($employee_loans['total_amount'],2); ?></td>
					</tr>
					<tr>
						<td>Amortization</td>
						<td><?php echo number_format($employee_loans['monthly_amortization'],2); ?>/month</td>
					</tr>
					<tr>
						<td>Remaining Terms</td>
						<td><?php echo $employee_loans['remaining_term']; ?></td>
					</tr>
					<tr>
						<td>Balance</td>
						<td><?php echo number_format($employee_loans['balance'],2); ?></td>
					</tr>	
					<tr>
						<td>Approved by</td>
						<td><?php echo $employee_loans['full_name']; ?></td>
					</tr>	
				</table>
    		</div>
    	</div>
    	<div class="col-lg-7">
    		<div class="well">
    			<table class="table table-striped" id="datatables-employee-positions">
					<thead>
						<tr>
							<th>Payroll ID</th>
							<th>Date</th>
							<th>Amount</th>
						</tr>
					</thead>
					<tbody data-link="row" class="rowlink">
						<tr>
							<td><?php echo $employee_loans['payroll_employees_id']; ?></td>
							<td>
									<?php echo date('d F Y', strtotime($employee_loans['payroll_start_date'])); ?> -
									<?php echo date('d F Y', strtotime($employee_loans['payroll_end_date'])); ?>
							</td>
							<td><?php echo $employee_loans['total_amount']; ?></td>
						</tr>
			
					</tbody>
				</table>
    		</div>
    	</div>
    </div>
</div>

<script>
	$(function() {
		var test = $('#test');

		test.on('click', function() {
			alert('running......');
		});
	});
</script>