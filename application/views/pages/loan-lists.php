
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-list"></i> <h3 class="box-title">List of Employee Loans</h3>
            <div class="pull-right">
                <!-- <a href="<?php echo site_url('loans/add'); ?>" class="btn btn-primary"> -->
                    <i class="fa fa-plus"></i>
                    <span>Add loan</span>
                </a>
            </div>                
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped table-hover" id="datatables-loans">
                    <thead>
                        <tr>
                            <th style="width: 120px;">&nbsp;</th>
                            <th class="text-left">Employee Name</th>
                            <th class="text-left">Type</th>
                            <th class="text-left">Start Date</th>
                            <th class="text-left">Terms</th>
                            <th class="text-left">Remaining Terms</th>                            
                            <th class="text-left">Loan Amount</th>
                            <th class="text-left">Interest/Month</th>
                            <th class="text-left">Amortization</th>
                            <th class="text-left">Amount Paid</th>
                            <th class="text-left">Balance</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ( ! empty($loans)): ?>
                            <?php foreach ($loans as $loan): ?>
                                <tr>
                                    <td>
                                        <a class="<?php echo $btn_view; ?>" href="<?php echo site_url('employees/informations/' . $loan['employee_id']); ?>">
                                            <i class="fa fa-eye" title="View" data-toggle="tooltip"></i>
                                        </a>
                                        <!-- <a class="<?php echo $btn_update; ?>" href="<?php echo site_url('loans/edit/' . $loan['id']); ?>">
                                            <i class="fa fa-pencil-square-o" title="Edit" data-toggle="tooltip"></i>
                                        </a>
                                       <a class="<?php echo $btn_update; ?>" href="<?php echo site_url('loans/update_status/' . $loan['id']); ?>" data-toggle="modal" data-target="#update-loan-status-<?php echo md5($loan['id']); ?>">
                                            <i class="fa <?php echo $loan['status_icon']; ?>" title="<?php echo $loan['status_action']; ?>" data-toggle="tooltip"></i> 
                                        </a>                                          
                                    </td> -->
                                    <td class="text-left"><?php echo $loan['full_name'];?></td>
                                    <td class="text-left"><?php echo $loan['loan_type_name']; ?></td>
                                    <td class="text-left"><?php echo date('d F Y', strtotime($loan['date_start'])); ?></td>
                                    <td class="text-left"><?php echo $loan['months_to_pay']; ?></td>
                                    <td class="text-left"><?php echo $loan['remaining_term']; ?></td>
                                    <td class="text-left"><?php echo number_format($loan['loan_amount'],2); ?></td>
                                    <td class="text-left"><?php echo number_format($loan['interest_per_month'],2);?></td>
                                    <td class="text-left"><?php echo number_format($loan['monthly_amortization'],2); ?></td>
                                    <td class="text-left"><?php echo number_format($loan['monthly_amortization'] * $loan['count'],2); ?></td>
                                    <td class="text-left"><?php echo number_format($loan['balance'],2); ?></td>
                                    
                                </tr>
                                <div class="modal fade" id="update-loan-status-<?php echo md5($loan['id']); ?>" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <!-- http://localhost/kawani_ci/roles/update_status/1 -->
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="update-loan-<?php echo md5($loan['id']); ?>" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <!-- http://localhost/kawani_ci/roles/update_status/1 -->
                                            
                                        </div>
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
