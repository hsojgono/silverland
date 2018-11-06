<div class="contrainer">
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-primary">
                  <li class="list-group-item">
                        <table class="table table-hover">
                            <thead>
                                <h4> 
                                    <i>&nbsp;&nbsp;Payroll Period:
                                                                <strong><?php echo date('F d', strtotime($payslip['start_date'])); ?> -  
                                                                <?php echo date('d, Y', strtotime($payslip['end_date'])); ?></strong></i><br>
                                </h4>

                                <tr>
                                    <th>
                                        <h3 class ="pull-left">
                                            Name: <strong><?php echo $employee_information['full_name']; ?></strong><br>
                                            Code : <strong><?php echo $employee_information['employee_code']; ?></strong><br>
                                        </h3>
                                    </th>

                                    <th>
                                        <h3 class ="pull-right">
                                            Department: <strong><?php echo $employee_information['department']; ?></strong><br>
                                            Position&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: 
                                            <strong><?php echo $employee_information['position']; ?></strong><br>
                                        </h3>
                                    </th>
                                </tr>
                            </thead>
                        </table>
                        <table class="table table-hover text-center">
                            <thead>
                                <tr >
                                    <th>SSS</th>
                                    <th>HDMF</th>
                                    <th>PHIC</th>
                                    <th>TIN</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?php echo $employee_information['sss']; ?></td>
                                    <td><?php echo $employee_information['hdmf']; ?></td>
                                    <td><?php echo $employee_information['phic']; ?></td>
                                    <td><?php echo $employee_information['tin']; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </li>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h2 class="panel-title text-center">
                        EARNINGS
                    </h2>
                </div>  
                <div>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="text-left"><strong>DESCRIPTION</strong></th>
                                <th class="text-right"><strong>CURRENT</strong></th>
                                <th class="text-right"><strong>YTD</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Salary</td>
                                <td class="text-right"><?php echo number_format($payslip['current_salary'], 2); ?></td>
                                <td class="text-right"><?php echo number_format($payslip['salary_ytd'], 2); ?></td>
                            </tr>
                            <?php foreach ($benefits as $benefit) : ?>
                                <tr>
                                    <td><?php echo $benefit['benefit_name']; ?></td>
                                    <td class="text-right"><?php echo number_format($benefit['amount'], 2); ?></td>
                                    <td class="text-right">0.00</td>
                                </tr>
                            <?php endforeach ?>
                            <tr>
                                <td>Tardiness</td>
                                <td class="text-right"><?php echo ($payslip['tardy_deduction'] <= 0.00) ?  '(' . number_format($payslip['tardy_deduction'], 2) . ')' :
                                                            number_format($payslip['tardy_deduction'], 2) ?></td>
                                <td class="text-right">(0.00)</td>
                            </tr>
                            <tr>
                                <td>Unpaid Leave</td>
                                <td class="text-right"><?php echo ($payslip['unpaid_leave_deduction'] <= 0.00) ? '(' . number_format($payslip['unpaid_leave_deduction'], 2) . ')' :
                                                            number_format($payslip['unpaid_leave_deduction'], 2) ?></td>
                                <td class="text-right">(0.00)</td>
                            </tr>
                            <tr>
                                <td>Undertime</td>
                                <td class="text-right"><?php echo ($payslip['undertime_deduction'] <= 0.00) ? '(' . number_format($payslip['undertime_deduction'], 2) . ')' :
                                                            number_format($payslip['undertime_deduction'], 2) ?></td>
                                <td class="text-right">(0.00)</td>
                            </tr>
                        </tbody>
                    </table>
                </div>       
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h2 class="panel-title text-center">
                        GOVERNMENT MANDATED DEDUCTIONS
                    </h2>
                </div>  
                <div>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="text-left"><strong>DESCRIPTION</strong></th>
                                <th class="text-right"><strong>CURRENT</strong></th>
                                <th class="text-right"><strong>YTD</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>SSS</td>
                                <td class="text-right"><?php echo number_format($payslip['current_sss'], 2); ?></td>
                                <td class="text-right"><?php echo number_format($payslip['sss_ytd'], 2); ?></td>
                            </tr>
                            <tr>
                                <td>HDMF</td>
                                <td class="text-right"><?php echo number_format($payslip['current_hdmf'], 2); ?></td>
                                <td class="text-right"><?php echo number_format($payslip['hdmf_ytd'], 2); ?></td>
                            </tr>
                            <tr>
                                <td>PHIC</td>
                                <td class="text-right"><?php echo number_format($payslip['current_phic'], 2); ?></td>
                                <td class="text-right"><?php echo number_format($payslip['hdmf_ytd'], 2); ?></td>
                            </tr>
                            <tr>
                                <td>WTAX</td>
                                <td class="text-right"><?php echo number_format($payslip['current_tax'], 2); ?></td>
                                <td class="text-right"><?php echo number_format($payslip['tax_ytd'], 2); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>          
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h2 class="panel-title text-center">
                        DEDUCTIONS
                    </h2>
                </div>      
                <div>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="text-left"><strong>DESCRIPTION</strong></th>
                                <th class="text-right"><strong>CURRENT</strong></th>
                                <!-- <th class="text-right"><strong>YTD</strong></th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($deductions as $deduction) : ?>
                                <tr>
                                    <td><?php echo $deduction['loan_name']; ?></td>
                                    <td class="text-right"><?php echo number_format($deduction['amount_deduction'], 2); ?></td>
                                    <!-- <td class="text-right"> </td> -->
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>      
            </div>
        </div>
    </div>

    <div class="row clearfix">
        <div class="col-md-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h2 class="panel-title text-center">
                        LEAVES
                    </h2>
                </div>
                <div>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="text-left"><strong>LEAVE TYPES</strong></th>
                                <th class="text-right"><strong>BALANCE</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($leave_balances as $leave_balance) : ?>
                                <tr>
                                    <td><?php echo $leave_balance['leave_type']; ?></td>
                                    <td class="text-right"><?php echo number_format($leave_balance['elc_balance'], 2); ?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h2 class="panel-title text-center">
                        TOTAL EARNINGS
                    </h2>
                </div>
                <div>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="text-left"><strong>EARNINGS</strong></th>
                                <th class="text-center"><strong>DEDUCTIONS</strong></th>
                                <th class="text-right"><strong>NET PAY</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-left"><?php echo number_format($total_earnings, 2); ?></td>
                                <td class="text-center"><?php echo number_format($total_deductions, 2); ?></td>
                                <td class="text-right"><?php echo number_format($payslip['net_pay'], 2); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- <div class="col-md-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h2 class="panel-title text-center">
                        YTD TOTALS
                    </h2>
                </div>
                <div>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="text-left"><strong>EARNINGS</strong></th>
                                <th class="text-center"><strong>DEDUCTIONS</strong></th>
                                <th class="text-right"><strong>NET PAY</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-left"><?php echo number_format($payslip['gross_ytd'], 2); ?></td>
                                <td class="text-center"><?php echo number_format($payslip['deductions_ytd'], 2); ?></td>
                                <td class="text-right"><?php echo number_format($payslip['net_pay_ytd'], 2); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div> -->
    </div>
</div>
