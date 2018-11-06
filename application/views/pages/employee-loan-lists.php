
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<i class="fa fa-list"></i> <h3 class="box-title">List of Employee Loans</h3>
				<div class="box-tools">
					<a href="<?php echo site_url('employee_loans/add'); ?>" class="btn btn-box-tool text-blue">
						<i class="fa fa-plus"></i>
						<span>Add Employee Loan</span>
					</a>
				</div>
			</div>
            <br>
            <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#employee_loans" data-toggle="tab">Employee Loans</a>
                </li>
                <li class="">
                    <a href="#loan_approvals" data-toggle="tab">Approvals &nbsp; <span data-toggle="tooltip" title="" class="badge bg-yellow" data-original-title=" <?php echo $total_pending; ?> Approvals" ><?php echo $total_pending; ?></span></a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade in active" id="employee_loans">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover" id="datatables-employee-loans">
                            <thead>
                                <tr>
                                    <th style="width: 20px;">&nbsp;</th>
                                    <th class="text-left">Employee</th>
                                    <th class="text-left">Type</th>
                                    <th class="text-left">Start Date</th>
                                    <th class="text-left">Maturity Date</th>
                                    <th class="text-left">Terms</th>
                                    <th class="text-left">Remaining Terms</th>
                                    <th class="text-left">Loan Amount</th>
                                    <th class="text-left">Interest / Month</th>
                                    <th class="text-left">Amortization</th>
                                    <th class="text-left">Amount Paid</th>
                                    <th class="text-left">Balance</th>
                                    <th class="text-left">Approval Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ( ! empty($employee_loans)): ?>
                                <?php foreach ($employee_loans as $employee_loan): ?>
                                <tr>
                                    <td>
                                        <!-- <a class="<?php echo $btn_view; ?>" href="<?php echo site_url('employees/informations/' . $employee_loan['employee_id']); ?>">
                                            <i class="fa fa-eye" title="View" data-toggle="tooltip"></i>
                                        </a> -->
                                        <a class="<?php echo $btn_update; ?>" href="<?php echo site_url('employee_loans/edit/' . $employee_loan['employee_loan_id']); ?>">
                                            <i class="fa fa-pencil-square-o" title="Edit" data-toggle="tooltip"></i>
                                        </a>
                                    </td>
                                    <td class="text-left"><?php echo $employee_loan['full_name']; ?></td>
                                    <td class="text-left"><?php echo $employee_loan['loan_type']; ?></td>
                                    <td class="text-right"><?php echo $employee_loan['date_start']; ?></td>
                                    <td class="text-right"><?php echo $employee_loan['maturity_date']; ?></td>
                                    <td class="text-right"><?php echo $employee_loan['months_to_pay']; ?></td>
                                    <td class="text-right"><?php echo $employee_loan['remaining_term']; ?></td>
                                    <td class="text-right"><?php echo number_format($employee_loan['loan_amount'], 2, '.', ','); ?></td>
                                    <td class="text-right"><?php echo ($employee_loan['interest_per_month']) * 100 . ' %'; ?></td>
                                    <td class="text-right"><?php echo number_format($employee_loan['monthly_amortization'], 2, '.', ','); ?></td>
                                    <td class="text-right"><?php echo number_format(($employee_loan['monthly_amortization']) * ($employee_loan['count']), 2, '.', ','); ?></td>
                                    <td class="text-right"><?php echo number_format($employee_loan['balance'], 2, '.', ','); ?></td>
                                    <td class="text-center"><?php echo $employee_loan['status_loan_label']; ?></td>
                                </tr>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade in" id="loan_approvals">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover" id="datatables-employee-loans-approvals">
                            <thead>
                                <tr>
                                    <!-- <th class="text-left">ID</th> -->
                                    <th style="width: 120px;">&nbsp;</th>
                                    <th class="text-left">Employee</th>
                                    <th class="text-left">Type</th>
                                    <th class="text-left">Start Date</th>
                                    <th class="text-left">Maturity Date</th>
                                    <th class="text-left">Terms</th>
                                    <th class="text-left">Remaining Terms</th>
                                    <th class="text-left">Loan Amount</th>
                                    <th class="text-left">Interest / Month</th>
                                    <th class="text-left">Amortization</th>
                                    <th class="text-left">Amount Paid</th>
                                    <th class="text-left">Balance</th>
                                    <th class="text-left">Approval Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ( ! empty($for_approvals)): ?>
                                <?php foreach ($for_approvals as $index => $for_approval): ?>
                                <tr>
                                    <td>
                                        <a class="<?php echo $btn_view; ?>" href="<?php echo site_url('employee_loans/confirmation/approve/' . $for_approval['id']); ?>" class="btn btn-link" data-toggle="modal" data-target="#modal-confirmation-<?php echo $index; ?>">
                                            <i class="fa fa-check text-green" title="Approve" data-toggle="tooltip"></i>
                                        </a>
                                        <a class="<?php echo $btn_view; ?>" href="<?php echo site_url('employee_loans/confirmation/reject/' . $for_approval['id']); ?>" class="btn btn-link" data-toggle="modal" data-target="#modal-confirmation-<?php echo $index; ?>">
                                            <i class="fa fa-times text-red" title="Reject" data-toggle="tooltip"></i>
                                        </a>  
                                        <a class="<?php echo $btn_update; ?>" href="<?php echo site_url('employee_loans/edit/' . $for_approval['id']); ?>">
                                            <i class="fa fa-pencil-square-o" title="Edit" data-toggle="tooltip"></i>
                                        </a>
                                    </td>
                                    <td class="text-left"><?php echo $for_approval['full_name']; ?></td>
                                    <td class="text-left"><?php echo $for_approval['loan_type']; ?></td>
                                    <td class="text-right"><?php echo $for_approval['date_start']; ?></td>
                                    <td class="text-right"><?php echo $for_approval['maturity_date']; ?></td>
                                    <td class="text-right"><?php echo $for_approval['months_to_pay']; ?></td>
                                    <td class="text-right"><?php echo $for_approval['remaining_term']; ?></td>
                                    <td class="text-right"><?php echo number_format($for_approval['loan_amount'], 2, '.', ','); ?></td>
                                    <td class="text-right"><?php echo ($for_approval['interest_per_month']) * 100 . ' %'; ?></td>
                                    <td class="text-right"><?php echo number_format($for_approval['monthly_amortization'], 2, '.', ','); ?></td>
                                    <td class="text-right"><?php echo number_format(($for_approval['monthly_amortization']) * ($for_approval['count']), 2, '.', ','); ?></td>
                                    <td class="text-right"><?php echo number_format($for_approval['balance'], 2, '.', ','); ?></td>
                                    <td class="text-center"><?php echo $for_approval['status_loan_label']; ?></td>
                                </tr>
                                <div class="modal fade" id="modal-confirmation-<?php echo $index; ?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content"></div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
			
		</div>
		
	</div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    $('#datatables-employee-loans').DataTable();
    $('#datatables-employee-loans-approvals').DataTable();
});
</script>
