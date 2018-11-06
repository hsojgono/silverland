<div class="row">
    <div class="col-md-6">&nbsp;</div>
    <div class="col-md-6">
        <div class="pull-right">
            <a href="<?php echo site_url('shift_schedules/add'); ?>" class="btn btn-primary">
                <i class="fa fa-plus"></i>
                <span>Add Shift Schedule</span>
            </a>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-list"></i> <h3 class="box-title">List of Shift Schedules</h3>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped table-hover" id="datatables-shift_schedules">
                    <thead>
                        <tr>
                            <th style="width: 80px;">&nbsp;</th>
                            <th class="text-left">Time Start</th>
                            <th class="text-left">Time End</th>
                            <th class="text-left">Company</th>
                            <th class="text-left">Shift Code</th>
                            <th class="text-left">Description</th>
                            <th class="text-left">Type</th>
                            <th class="text-left">Grace Period</th>
                            <th class="text-left">Number of Hours</th>
                            <th class="text-left">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ( ! empty($shift_schedules)): ?>
                            <?php foreach ($shift_schedules as $shift_schedule): ?>
                                <tr>
                                    <td>
                                        <!-- <a class="<?php echo $btn_view; ?>" href="<?php echo site_url('shift_schedules/details/' . $shift_schedule['id']); ?>">
                                            <i class="fa fa-search"></i> View
                                        </a> -->
                                        <a class="<?php echo $btn_update; ?>" href="<?php echo site_url('shift_schedules/edit/' . $shift_schedule['id']); ?>">
                                            <i class="fa fa-pencil-square-o" title="Edit" data-toggle="tooltip"></i>
                                        </a>
                                         <a class="<?php echo $btn_update; ?>" href="<?php echo site_url('shift_schedules/update_status/' . $shift_schedule['id']); ?>" data-toggle="modal" data-target="#update-shift_schedule-status-<?php echo md5($shift_schedule['id']); ?>">
                                            <!-- <i class="fa fa-cog"></i> <?php echo $shift_schedule['status_label']; ?> -->
                                            <i class="fa <?php echo $shift_schedule['status_icon']; ?>" title="<?php echo $shift_schedule['status_action']; ?>" data-toggle="tooltip"></i> 

                                        </a>
                                    </td>
                                    <!-- <td class="text-right"><?php echo $shift_schedule['id']; ?></td> -->
                                    <td class="text-right"><?php echo date('h:i A', strtotime($shift_schedule['time_start'])); ?></td>
                                    <td class="text-right"><?php echo date('h:i A', strtotime($shift_schedule['time_end'])); ?></td>
                                    <td class="text-left"><?php echo $shift_schedule['company_name']; ?></td>
                                    <td class="text-left"><?php echo $shift_schedule['code']; ?></td>
                                    <td class="text-left"><?php echo isset($shift_schedule['description']); ?></td>
                                    <td class="text-left"><?php echo $shift_schedule['type_label']; ?></td>
                                    <td class="text-right"><?php echo $shift_schedule['grace_period']; ?></td>
                                    <td class="text-right"><?php echo $shift_schedule['number_of_hours']; ?></td>
                                    <td class="text-center"><?php echo $shift_schedule['status_label']; ?></td>
                                </tr>
                                <div class="modal fade" id="update-shift_schedule-status-<?php echo md5($shift_schedule['id']); ?>" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <!-- http://localhost/kawani_ci/roles/update_status/1 -->

                                        </div>
                                    </div>
                                </div>
                                 <div class="modal fade" id="update-shift_schedule-<?php echo md5($shift_schedule['id']); ?>" role="dialog">
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
