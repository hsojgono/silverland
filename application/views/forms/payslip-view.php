        

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <h2 class="panel-default">                                
            <!-- <?php foreach($payslips as  $payslip): ?>

                     <?php echo $payslip['company_name']; ?>
            <?php endforeach; ?> -->

            <?php echo $payslip['company_name']; ?>
            <!--<?php if (empty($payslips)): ?>
            <tr class="text-center">
                <td colspan="3">-- NO RECORD FOUND --</td>
            </tr>
            <?php endif; ?>--> 
                    <!-- <br><small> 120 Cordilera St. Lourdes Quezon City </small> -->

        </div>            
            <?php $ytd_current = 80108.115; ?>
            <?php $earnings = $ytd_current; ?>
            <?php $ytd_demo = $ytd_current * 2; ?>
            <?php $percent_over = ($ytd_current - 25000) * .32; ?>
            <?php $deductions = 5000 + $percent_over; ?>
            <?php $net_pay = $earnings - $deductions; ?>
            <?php $current_gross = $earnings - $deductions; ?>
            
            <div class="col-xs-12">
            <div class="panel panel-primary">
            </div>
                    <li class="list-group-item">
                    <h4></h4>
                    <table class="table table-hover">
                        <thead>
                                <h4> <i>&nbsp;&nbsp;Payroll Period:<?php echo date('M d', strtotime($payslip['start_date'])); ?> -  <?php echo date('M d, Y', strtotime($payslip['end_date'])); ?></i></h4>

                            <tr>
                                <th><h3>
                                NAME: <?php echo $payslip['full_name']; ?><br>
                                CODE: <?php echo $payslip['employee_code']; ?><br>
                                </h3></th>
                                <th><h3 class ="pull-right">
                                
                                DEPARTMENT: <?php echo $department['department_id']; ?><br>
                                POSITION:<?php echo $position['position_name']; ?><br>
                                </h3></th>
                            </tr>

                        </thead>
                    </table>
                    <!--account data-->
                    <table class="table table-hover text-center">
                        <thead>
                            <tr >
                                <th>SSS</th>
                                <th>TIN</th>
                                <th>HDMF</th>
                                <th>PHIC</th>
                                <th>Tax Code</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo $employee_government_id_numbers['employee_government_id_numbers_sss']; ?></td>
                                <td><?php echo $employee_government_id_numbers['employee_government_id_numbers_tin']; ?></td>
                                <td><?php echo $employee_government_id_numbers['employee_government_id_numbers_hdmf']; ?></td>
                                <td><?php echo $employee_government_id_numbers['employee_government_id_numbers_phic']; ?></td>
                                <td><?php echo $tax_exemption_status['tax_code']; ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <!--period-->
                    <!-- <table class="table table-hover text-center">
                        <thead>
                            <tr >
                                <th>Period Start</th>
                                <th>Period End</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <tr>
                                <td><?php echo date('d F Y', strtotime($payslip['start_date'])); ?></td>
                                <td><?php echo date('d F Y', strtotime($payslip['end_date'])); ?></td>
                            </tr>
                        </tbody>

                    </table> -->
                    </li>
                    </div>


        <div class="col-md-7">
                <div class="panel panel-primary">
                <!-- Default panel contents -->
                <div class="panel-heading">
                    <h2 class="panel-title text-center ">
                        EARNINGS
                    </h2>
                </div> 
                    <ul class="list-group">
                    <li class="list-group-item">
                    <table class="table table-hover ">
                        <thead>
                            <tr >
                                <th>Description</th>
                                <th class="text-center">Hours</th>
                                <th class="text-right">Current</th>
                                <th class="text-right">YTD</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>REG BASIC</td>
                                <td> </td>
                                <td class="text-right"><?php echo number_format($payslip['current_salary'],2); ?></td>
                                <td class="text-right"><?php echo number_format($payslip['salary_ytd'],2); ?></td>
                            </tr>
                            <?php foreach ($employee_benefits as $employee_benefit): ?>
                             <tr>
                                 <td><?php echo $employee_benefit['benefits_name']; ?></td>
                                 <td class="text-right"> </td>
                                 <td class="text-right"><?php echo $employee_benefit['employee_benefits_amount']; ?></td>
                                 <td class="text-right"> </td>
                            </tr>
                            <?php endforeach ?>
                            <tr>
                                 <td>TARDY</td>
                                 <td class="text-right"><?php echo $payslip['tardy_hours']; ?></td>
                                 <td class="text-right"><?php echo $payslip['tardy_deduction']; ?></td>
                                 <td class="text-right"><?php echo $payslip['tardy_deductions_ytd']; ?></td>
                            </tr>

                            <tr>
                                 <td>UNPAID LEAVES / ABSENT<td>
                                 <td class="text-right">(<?php echo $payslip['unpaid_leave_days']; ?>)</td>
                                 <td class="text-right">(<?php echo $payslip['unpaid_leave_deduction']; ?>)</td>
                                 <td class="text-right">(<?php echo $payslip['unpaid_leave_deduction_ytd']; ?>)</td>
                            </tr>
                        </tbody>
                    </table>
                    </table>
                    </li>
                    </div>
                    </div>

                 <div class="col-md-5">
                <div class="panel panel-primary">
                <!-- Default panel contents -->
                <div class="panel-heading">
                    <h2 class="panel-title text-center ">
                        DEDUCTIONS
                    </h2>
                </div> 
                    <ul class="list-group">
                    <li class="list-group-item">
                    <table class="table table-hover ">
                        <thead>
                            <tr >
                                <th>Description</th>
                                <th class="text-right">Current</th>
                                <th class="text-right">YTD</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- <tr>
                                <td>UCA</td>
                                <td class="text-right"><?php echo number_format($ytd_demo / 2, 2); ?></td>
                                <td class="text-right"><?php echo number_format($ytd_demo, 2); ?></td>
                            </tr> -->
                                <?php foreach ($employee_deductions as $employee_deduction): ?>
                             <tr>
                                 <td><?php echo $employee_deduction['deduction_name']; ?></td>
                                 <td class="text-right"><?php echo $employee_deduction['deduction_amount']; ?></td>
                                 <td class="text-right"> </td>
                            </tr>
                                <?php endforeach ?>
                               
                            <tr>
                                <td>WTAX</td>
                                <td class="text-right"><?php echo number_format($payslip['current_tax'],2); ?></td>
                                <td class="text-right"><?php echo number_format($payslip['tax_ytd'],2); ?></td>
                            </tr>
                                
                            <tr>
                                <td>HDMFEE</td>
                                <td class="text-right"><?php echo number_format($payslip['current_hdmf'],2); ?></td>
                                <td class="text-right"><?php echo number_format($payslip['hdmf_ytd'],2); ?></td>
                            </tr>
                            <tr>
                                <td>PHICEE</td>
                                <td class="text-right"><?php echo number_format($payslip['current_phic'],2); ?></td>
                                <td class="text-right"><?php echo number_format($payslip['phic_ytd'],2); ?></td>
                            </tr>
                            <tr>
                                <td>SSSEE</td>
                                <td class="text-right"><?php echo number_format($payslip['current_sss'],2); ?></td>
                                <td class="text-right"><?php echo number_format($payslip['sss_ytd'],2); ?></td>
                            </tr>
                        </tbody>
                    </table>
                    </table>
                    </li>
                    </div>
                    </div>

                 <div class="col-md-3">
                <div class="panel panel-primary">
                <!-- Default panel contents -->
                <div class="panel-heading">
                    <h2 class="panel-title text-center ">
                        LEAVES
                    </h2>
                </div> 
                    <ul class="list-group">
                    <li class="list-group-item">
                    <table class="table table-hover ">
                    
                        <thead>
                            <tr >
                                <th>Leave Types</th>
                                <th class="text-right">Balance</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($leave_balances as $leave_balance): ?>
                             <tr>
                                 <td><?php echo $leave_balance['leave_type']; ?></td>
                                 <td class="text-right"><?php echo $leave_balance['elc_balance']; ?></td>
                            </tr>
                            <?php endforeach ?>
				
                            <!-- <tr>
                                <td>Paternity Leave</td>
                                <td class="text-right">0.00</td>
                            </tr>
                            <tr>
                                <td>Service Incentive Leave</td>
                                <td class="text-right">0.00</td>
                            </tr>
                            <tr>
                                <td>Sick / Emergency Leave</td>
                                <td class="text-right">0.00</td>
                            </tr>
                            <tr>
                                <td>Vacation Leave</td>
                                <td class="text-right">0.00</td>
                            </tr> -->
                        </tbody>
                    </table>
                    </table>
                    </li>
                    </div>
                    </div>
                 <div class="col-md-4">
                <div class="panel panel-primary">
                <!-- Default panel contents -->
                <div class="panel-heading">
                    <h2 class="panel-title text-center ">
                        CURRENT TOTALS
                    </h2>
                </div> 
                    <ul class="list-group">
                    <li class="list-group-item">
                    <table class="table table-hover ">
                        <thead>
                            <tr >
                                <th>Earnings</th>
                                <th class="text-center">Deductions</th>
                                <th class="text-right">Net Pay</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <!-- <td><?php echo number_format($ytd_demo, 2); ?></td>
                                <td class="text-center"><?php echo number_format($deductions, 2); ?></td>
                                <td class="text-right"><?php echo number_format($net_pay, 2); ?></td> -->
                                <td><?php echo number_format($payslip['current_gross'],2); ?></td>
                                <td class="text-center"><?php echo number_format($payslip['current_deductions'],2); ?></td>
                                <td class="text-right"><?php echo number_format($payslip['current_net_pay'],2); ?></td>
                            </tr>
                        </tbody>
                    </table>
                    </table>
                    </li>
                    </div>
                    </div>
                 <div class="col-md-5">
                <div class="panel panel-primary">
                <!-- Default panel contents -->
                <div class="panel-heading">
                    <h2 class="panel-title text-center ">
                        YTD TOTALS
                    </h2>
                </div> 
                    <ul class="list-group">
                    <li class="list-group-item">
                    <table class="table table-hover ">
                        <thead>
                            <tr >
                                <th >Earnings</th>
                                <th class="text-center">Deductions</th>
                                <th class="text-right">Net Pay</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <!-- <td><?php echo number_format($earnings, 2); ?></td>
                                <td class="text-center"><?php echo number_format($deductions, 2); ?></td>
                                <td class="text-right"><?php echo number_format($net_pay, 2); ?></td> -->
                                <td><?php echo number_format($payslip['gross_ytd'],2); ?></td>
                                <td class="text-center"><?php echo number_format($payslip['deductions_ytd'],2); ?></td>
                                <td class="text-right"><?php echo number_format($payslip['net_pay_ytd'],2); ?></td>
                            </tr>
                        </tbody>
                    </table>
                    </table>
                    </li>
                    </div>
                    </div>
                 <div class="col-md-12">
                <div class="panel panel-primary">
                <!-- Default panel contents -->
                <!-- <div class="panel-heading">
                    <h2 class="panel-title text-center ">
                        DIRECT DEPOSIT
                    </h2>
                </div> 
                    <ul class="list-group">
                    <li class="list-group-item">
                    <table class="table table-hover ">
                        <thead>
                            <tr >
                                <th>Bank Account</th>
                                <th class="text-center">Account Number</th>
                                <th class="text-center">Account Type</th>
                                <th class="text-right">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Metrobank</td>
                                <td class="text-center">2345689</td>
                                <td class="text-center"></td>
                                <td class="text-right"><?php echo number_format($ytd_demo, 2); ?></td>
                            </tr>
                        </tbody>
                    </table>
                    </table> 
                    </li>-->
                    </div>
                    </div>                    
               
                </ul>
            </div>
        </div>
    </div>
</div>