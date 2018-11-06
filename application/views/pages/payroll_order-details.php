<div class="row">
    <div class="col-md-4">
        <div class="box box-primary">
            <div class="box-body">
                <h3 class="text-center"><strong><?php echo date('F d', strtotime($payroll['start_date'])); ?> -
                        <?php echo date('d, Y', strtotime($payroll['end_date'])); ?></strong> </h3>
                <p class="text-muted text-center">
                    <!-- <h4 class="text-center""<?php echo site_url('payroll_order/details/' . $payroll['id']); ?>">
                        <?php echo $payroll['status_label']; ?>
                    </a> -->
                </p>
                <p class="text-muted text-center">
                    <h4 class="text-center""<?php echo site_url('payroll_order/details/' . $payroll['id']); ?>">
                        <?php echo $payroll['cut_off']; ?>
                    </a>
                </p>
                <p class="text-muted text-center">
                    <h4 class="text-center""<?php echo site_url('payroll_order/details/' . $payroll['id']); ?>">
                        Processed by: <strong><?php echo $processedBy; ?></strong>
                    </a>
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#employees" data-toggle="tab">Employees</a>
                </li>
                <li class="">
                    <a href="#employee_benefits" data-toggle="tab">Benefits</a>
                </li>
                <li class="">
                    <a href="#employee_loans" data-toggle="tab">Loans</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade in active" id="employees">
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover" id="datatables-payroll-employees">
                                <thead>
                                    <tr>
                                        <th class="text-left" style="width: 50px;">Employee Code</th>
                                        <th class="text-left" style="width: 200px;">Full Name</th>
                                        <th class="text-left"style="width: 125px;">Gross Pay</th>
                                        <th class="text-left"style="width: 125px;">Total Benefits</th>
                                        <th class="text-left"style="width: 125px;">Tardiness</th>
                                        <th class="text-left"style="width: 125px;">Underpaid Leave</th>
                                        <th class="text-left"style="width: 125px;">Undertime</th>
                                        <th class="text-left"style="width: 125px;">Tax</th>
                                        <th class="text-left"style="width: 125px;">SSS</th>
                                        <th class="text-left"style="width: 125px;">PHIC</th>
                                        <th class="text-left"style="width: 125px;">HDMF</th>
                                        <th class="text-left"style="width: 125px;">Total Loan Deductions</th>
                                        <th class="text-left"style="width: 125px;">Net Pay</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($payroll_employees)) : ?>
                                        <?php foreach ($payroll_employees as $payroll_employee) : ?>
                                            <tr>
                                                <td class="text-right" ><?php echo $payroll_employee['employee_code']; ?></td>
                                                <td>
                                                    <a href="<?php echo site_url('employee_payslips/view/' . $payroll_employee['payroll_employee_id']); ?>">
                                                        <span>
                                                            <?php echo $payroll_employee['full_name']; ?>
                                                        </span>
                                                    </a>
                                                </td>
                                                <td class="text-right" ><?php echo number_format($payroll_employee['gross'], 2); ?></td>
                                                <td class="text-right" ><?php echo number_format($payroll_employee['benefits'], 2); ?></td>
                                                <td class="text-right" ><?php echo number_format($payroll_employee['tardy_deduction'], 2); ?></td>
                                                <td class="text-right" ><?php echo number_format($payroll_employee['unpaid_leave_deduction'], 2); ?></td>
                                                <td class="text-right" ><?php echo number_format($payroll_employee['undertime_deduction'], 2); ?></td>
                                                <td class="text-right" ><?php echo number_format($payroll_employee['tax'], 2); ?></td>
                                                <td class="text-right" ><?php echo number_format($payroll_employee['sss'], 2); ?></td>
                                                <td class="text-right" ><?php echo number_format($payroll_employee['phic'], 2); ?></td>
                                                <td class="text-right" ><?php echo number_format($payroll_employee['hdmf'], 2); ?></td>
                                                <td class="text-right" ><?php echo number_format($payroll_employee['deductions'], 2); ?></td>
                                                <td class="text-right" ><?php echo number_format($payroll_employee['net_pay'], 2); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <tr>
                                            <td class="text-center" colspan="8">No Records Found!</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                                <thead>
                                    <tr>
                                        <th class="text-center">&nbsp;</th>
                                        <th class="text-right">TOTAL</th>
                                        <td class="text-right"><strong><?php echo number_format($total_gross, 2); ?></strong></td>
                                        <td class="text-right"><strong><?php echo number_format($total_benefits, 2); ?></strong></td>
                                        <td class="text-right"><strong><?php echo number_format($total_tardiness_deduction, 2); ?></strong></td>
                                        <td class="text-right"><strong><?php echo number_format($total_unpaid_leave_deduction, 2); ?></strong></td>
                                        <td class="text-right"><strong><?php echo number_format($total_undertime_deduction, 2); ?></strong></td>
                                        <td class="text-right"><strong><?php echo number_format($total_sss, 2); ?></strong></td>
                                        <td class="text-right"><strong><?php echo number_format($total_phic, 2); ?></strong></td>
                                        <td class="text-right"><strong><?php echo number_format($total_hdmf, 2); ?></strong></td>
                                        <td class="text-right"><strong><?php echo number_format($total_benefits, 2); ?></strong></td>
                                        <td class="text-right"><strong><?php echo number_format($total_deductions, 2); ?></strong></td>
                                        <td class="text-right"><strong><?php echo number_format($total_net_pay, 2); ?></strong></td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>    
                <div class="tab-pane fade in" id="employee_benefits">
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover" id="datatables-payroll-employee-benefits">
                                <thead>
                                    <tr>
                                        <th class="text-left" style="width: 50px;">Employee Code</th>
                                        <th class="text-left" style="width: 200px;">Full Name</th>
                                        <th class="text-left"style="width: 125px;">Benefit</th>
                                        <th class="text-left"style="width: 125px;">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($payroll_employee_benefits)) : ?>
                                        <?php foreach ($payroll_employee_benefits as $payroll_employee_benefit) : ?>
                                            <tr>
                                                <td class="text-right" ><?php echo $payroll_employee_benefit['employee_code']; ?></td>
                                                <td>
                                                    <a href="<?php echo site_url('employee_payslips/view/' . $payroll_employee_benefit['payroll_employee_id']); ?>">
                                                        <span>
                                                            <?php echo $payroll_employee_benefit['full_name']; ?>
                                                        </span>
                                                    </a>
                                                </td>
                                                <td class="text-left" ><?php echo $payroll_employee_benefit['benefit']; ?></td>
                                                <td class="text-right" ><?php echo number_format($payroll_employee_benefit['benefit_amount'], 2); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <tr>
                                            <td class="text-center" colspan="8">No Records Found!</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                                <thead>
                                    <tr>
                                        <th class="text-center">&nbsp;</th>
                                        <th class="text-right">&nbsp;</th>
                                        <td class="text-right"><strong>TOTAL</strong></td>
                                        <td class="text-right"><strong><?php echo number_format($total_benefits, 2); ?></strong></td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>    
                <div class="tab-pane fade in" id="employee_loans">
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover" id="datatables-payroll-employee-loans">
                                <thead>
                                    <tr>
                                        <th class="text-left" style="width: 50px;">Employee Code</th>
                                        <th class="text-left" style="width: 200px;">Full Name</th>
                                        <th class="text-left"style="width: 125px;">Loan Type</th>
                                        <th class="text-left"style="width: 125px;">Loan Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($payroll_employee_loans)) : ?>
                                        <?php foreach ($payroll_employee_loans as $payroll_employee_loan) : ?>
                                            <tr>
                                                <td class="text-right" ><?php echo $payroll_employee_loan['employee_code']; ?></td>
                                                <td>
                                                    <a href="<?php echo site_url('employee_payslips/view/' . $payroll_employee_loan['payroll_employee_id']); ?>">
                                                        <span>
                                                            <?php echo $payroll_employee_loan['full_name']; ?>
                                                        </span>
                                                    </a>
                                                </td>
                                                <td class="text-left" ><?php echo $payroll_employee_loan['loan_name']; ?></td>
                                                <td class="text-right" ><?php echo number_format($payroll_employee_loan['amount_deduction'], 2); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <tr>
                                            <td class="text-center" colspan="8">No Records Found!</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                                <thead>
                                    <tr>
                                        <th class="text-center">&nbsp;</th>
                                        <th class="text-right">&nbsp;</th>
                                        <td class="text-right"><strong>TOTAL</strong></td>
                                        <td class="text-right"><strong><?php echo number_format($total_loans, 2); ?></strong></td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    $('#datatables-payroll-employees').DataTable();
    $('#datatables-payroll-employee-loans').DataTable();
    $('#datatables-payroll-employee-benefits').DataTable();
});
</script>

