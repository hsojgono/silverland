<div class="row">
    <div class="col-md-3">
        <div class="box box-primary">
            <div class="box-body">
                <h3 class="text-center"><strong><?php echo date('F d', strtotime($payroll['start_date'])); ?> -
                        <?php echo date('d, Y', strtotime($payroll['end_date'])); ?></strong> </h3>
                
                <p class="text-muted text-center">
                    <h4 class="text-center""<?php echo site_url('payroll_order/details/' . $payroll['id']); ?>">
                        Processed by: <strong><?php echo $processedBy; ?></strong>
                </p>
            </div>
        </div>
    </div>

    <div class="col-md-9">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#tab1" data-toggle="tab">Daily Workers</a>
                </li>                
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade in active" id="tab1">
                    <table class="table table-bordered table-striped table-hover" id="datatables-daily-workers-payroll">
                        <thead>
                            <tr>
                                <th class="text-left" style="width: 50px;">Code</th>
                                <th class="text-left" style="width: 200px;">Full Name</th>
                                <th class="text-left"style="width: 125px;">Net Pay</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($payroll_employees)): ?>

                                <?php foreach ($payroll_employees as $payroll_employee): ?>
                                
                                    <tr>
                                        <td class="text-right" ><?php echo $payroll_employee['employee_code']; ?></td>
                                        <td>
                                            <a href="<?php echo site_url('employee_payslips/view/' . $payroll_employee['payroll_employee_id']); ?>">
                                                <?php echo $payroll_employee['full_name']; ?>
                                            </a>
                                        </td>
                                        <td class="text-right"><?php echo number_format($payroll_employee['net_pay'], 2, '.', ','); ?></td>
                                        <?php $total_net_pay = $total_net_pay + $payroll_employee['net_pay']; ?>        
                                    </tr>
                                <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td class="text-center" colspan="8">No Records Found!</td>
                                    </tr>
                                <?php endif; ?>
                            <thead>
                                <tr>
                                    <th class="text-left" ></th>
                                    <td class="text-right" >&nbsp;</td>
                                    <td class="text-right"><strong>TOTAL : <?php echo number_format($total_net_pay, 2);?></strong></td>
                                </tr>
                            </thead>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    $('#datatables-daily-workers-payroll').DataTable();
});
</script>
