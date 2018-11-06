<div class="row">
    <div class="col-md-6">&nbsp;</div>
    <div class="col-md-6">
        <!-- <div class="pull-right">
            <a href="<?php echo site_url('employee_schedules/add'); ?>" class="btn btn-primary">
                <i class="fa fa-plus"></i>
                <span>Set Employee Schedule</span>
            </a>
        </div> -->
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-list"></i> <h3 class="box-title">List of Employees</h3>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped table-hover" id="datatables-employees_schedules">
                    <thead>
                        <tr>
                            <th>&nbsp;</th>
                            <th class="text-left">Employee Code</th>
                            <th class="text-left">Employee Name</th>
                            <th class="text-left">Company</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ( ! empty($employees)): ?>
                            <?php foreach ($employees as $employee): ?>
                            <tr>
                                <td>
                                    <a class="<?php echo $btn_view; ?>" href="<?php echo site_url('employee_schedules/details/' . $employee['id']); ?>">
                                        <i class="fa fa-eye" title="View" data-toggle="tooltip"></i>
                                    </a>
                                   <!--  <a class="<?php echo $btn_update; ?>" href="<?php echo site_url('employee_schedules/edit_confirmation/' . $employee['id']); ?>" data-toggle="modal" data-target="#update-employee_chedule-<?php echo md5($employee['id']); ?>">
                                        <i class="fa fa-pencil-square-o"></i> Edit
                                    </a> -->
                             <!--         <a class="<?php echo $btn_update; ?>" href="<?php echo site_url('employee_schedules/update_status/' . $employee['id']); ?>" data-toggle="modal" data-target="#update-employee_chedule-status-<?php echo md5($employee['id']); ?>">
                                        <i class="fa fa-cog"></i> <?php echo $employee['status_label']; ?>
                                    </a> -->
                                </td>

                                <td class="text-right"><?php echo $employee['employee_code']; ?></td>
                                <td class="text-left"><?php echo strtoupper($employee['full_name']); ?></td>
                                <td class="text-left"><?php echo $employee['company_name']; ?></td>
                                <!-- <td class="text-left"><?php echo $employee['shift_code']; ?></td> -->
                                <!-- <td class="text-left"><?php echo date('d F Y', strtotime($employee['date'])); ?></td> -->
                            </tr>
                            <div class="modal fade" id="view-ob-<?php echo md5($employee['id']); ?>" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content"></div>
                                </div>
                            </div>
                            <!-- <?php foreach ($employee['action_menus'] as $action_menu): ?>
                                <div class="modal fade" id="<?php echo $action_menu['modal_id']; ?>" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content"></div>
                                    </div>
                                </div>
                            <?php endforeach ?> -->
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
