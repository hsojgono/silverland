<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-list"></i> <h3 class="box-title">List of Leave Balances</h3>
            </div>
            <div class="box-body">
                <div class="pull-right">
                    <a href="<?php echo site_url('employee_leave_credits/add_form'); ?>" class="btn btn-primary">
                        <i class="fa fa-plus"></i>
                        <span>Add Employee Leave</span>
                    </a>
                </div>
            </div>
            <div class="box-body">

                <table class="table table-bordered table-striped table-hover" id="datatables-employee_leave_credits">
                    <thead>
                        <tr>
                            <th style="width: 25px;">&nbsp;</th>
                            <th class="text-left" style="width: 50px;">Code</th>
                            <th class="text-left" style="width: 350px;">Name</th>
                            <th class="text-left">Company</th>
                            <th class="text-left">Type</th>
                            <th class="text-left">Balance</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ( ! empty($employees)): ?>
                            <?php foreach ($employees as $index => $employee): ?>
                                <tr>
                                    <td>
                                        <a class="<?php echo $btn_update; ?>" href="<?php echo site_url('employee_leave_credits/edit_form/' . $employee['elc_id']); ?>" data-toggle="modal" data-target="#modal-edit-leave_credit" data-backdrop="static" data-keyboard="false">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </td>
                                    <td class="text-right"><?php echo $employee['employee_code']; ?></td>
                                    <td class="text-left"><?php echo $employee['full_name']; ?></td>
                                    <td class="text-left"><?php echo $employee['company_short_name']; ?></td>
                                    <td class="text-left"><?php echo strtoupper($employee['leave_type']); ?></td>
                                    <td class="text-left"><?php echo $employee['elc_balance']; ?></td>
                                </tr>

                                <div class="modal fade" id="modal-edit-leave_credit" role="dialog">
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
