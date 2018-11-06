<div class="row">
    <div class="col-md-6">&nbsp;</div>
    <div class="col-md-6">
        <div class="pull-right">
            <a href="<?php echo site_url('employee_schedules/add'); ?>" class="btn btn-primary">
                <i class="fa fa-plus"></i>
                <span>Set Employee Schedule<span>
            </a>
        </div>
    </div>
</div>
<br>

<div class="row">
    <!-- <div class="col-md-3">
        <div class="box box-primary">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Summary</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li class=""><a href="<?php echo site_url('attendance_leaves/index/pending'); ?>"><i class="fa fa-clock-o"></i> Pending <span class="label pull-right pending_color" id="totalPending">1</span></a></li>
                <li class=""><a href="<?php echo site_url('attendance_leaves/index/approved'); ?>"><i class="fa fa-thumbs-up"></i> Approved <span class="label pull-right approved_color" id="totalApproved">2</a></li>
                <li class=""><a href="<?php echo site_url('attendance_leaves/index/denied'); ?>"><i class="fa fa-thumbs-down" ></i> Denied <span class="label pull-right rejected_color" id="totalDenied">3</span></a></li>
                <li class=""><a href="<?php echo site_url('attendance_leaves/index/cancelled'); ?>"><i class="fa fa-times-circle"></i> Cancelled <span class="label pull-right cancelled_color" id="totalCancelled">4</span></a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="box box-primary">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Leave Balances</h3>
              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
				<ul class="nav nav-pills nav-stacked">
					<?php foreach ($leave_balances as $leave_balance): ?>
					<li class="">
						<a href="javascript:void(0);">
							<i class="fa  fa-tasks"></i> <?php echo $leave_balance['leave_type']; ?> <span class="label pull-right approved_color"><?php echo $leave_balance['elc_balance']; ?></span>
						</a>
					</li>
					<?php endforeach ?>
				</ul>
            </div>
          </div>
        </div>
    </div> -->

    <div class="col-md-12">
        <div class="box box-primary">
             <div class="box-header with-border">
                <i class="fa fa-list"></i> <h3 class="box-title">List of Employee Schedules</h3>
            </div>
            <div class="nav-tabs-custom">
            <div></div>
            <div><br></div>
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#myLeaves" data-toggle="tab">Calendar View</a>
                </li>
                <li class="">
                    <a href="#approvals" data-toggle="tab">List View</a>
                </li>
            </ul>
            <div class="tab-content">
                <!-- <div class="tab-pane fade in active" id="myLeaves">
                    <table class="table table-bordered table-striped table-hover" id="datatables-employee_schedules">
                        <thead>
                            <tr>
                                <th>&nbsp;</th>
                                <th class="text-left">Leave Type</th>
                                <th class="text-left">Date Start</th>
                                <th class="text-left">Date End</th>
                                <th class="text-left">Reason</th>
                            </tr>
                        </thead>
                        <tbody>
                         <?php if (! empty($my_leaves)): ?>
                         	<?php foreach ($my_leaves as $my_leave): ?>
                         		<tr>
                         			<td>
                                        <a class="<?php echo $btn_view; ?>" href="<?php echo site_url('employee_schedules/view_ob/' . $my_leave['id']); ?>" data-toggle="modal" data-target="#view-ob-<?php echo md5($my_leave['id']); ?>">
                                        <i class="fa fa-search"></i> View </a>

                                    <td class="text-left"><?php echo $my_leave['leave_type']; ?></td>
                                    <td class="text-right"><?php echo $my_leave['date_start']; ?></td>
                                    <td class="text-right"><?php echo $my_leave['date_end']; ?></td>
                                    <td class="text-left"><?php echo $my_leave['reason']; ?></td>
                         		</tr>
                         	<?php endforeach ?>
                         <?php endif ?>
                        </tbody>
                    </table>
                </div> -->
                <div class="tab-pane fade in" id="approvals">
                    <table class="table table-bordered table-striped table-hover" id="datatables-employee_schedules">
						<thead>
                            <tr>
                                <th>&nbsp;</th>
                                <th class="text-left">Employee Code</th>
                                <th class="text-left">Employee Name</th>
                                <th class="text-left">Company</th>
                                <th class="text-left">Shift Code</th>
                                <th class="text-left">Shift</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if ( ! empty($employee_schedules)): ?>
                            <?php foreach ($employee_schedules as $employee_schedule): ?>
                            <tr>
                                <td>
                                    <a class="<?php echo $btn_view; ?>" href="<?php echo site_url('employee_schedules/details/' . $employee_schedule['id']); ?>">
                                        <i class="fa fa-search"></i> View
                                    </a>
                                    <a class="<?php echo $btn_update; ?>" href="<?php echo site_url('employee_schedules/edit_confirmation/' . $employee_schedule['id']); ?>" data-toggle="modal" data-target="#update-employee_chedule-<?php echo md5($employee_schedule['id']); ?>">
                                        <i class="fa fa-pencil-square-o"></i> Edit
                                    </a>
                                     <a class="<?php echo $btn_update; ?>" href="<?php echo site_url('employee_schedules/update_status/' . $employee_schedule['id']); ?>" data-toggle="modal" data-target="#update-employee_chedule-status-<?php echo md5($employee_schedule['id']); ?>">
                                        <i class="fa fa-cog"></i> <?php echo $employee_schedule['status_label']; ?>
                                    </a>
                                </td>

                                <td class="text-right"><?php echo $employee_schedule['employee_code']; ?></td>
                                <td class="text-left"><?php echo $employee_schedule['full_name']; ?></td>
                                <td class="text-left"><?php echo $employee_schedule['company_name']; ?></td>
                                <td class="text-left"><?php echo $employee_schedule['shift_code']; ?></td>
                                <td class="text-left"><?php echo $employee_schedule['date']; ?></td>
                            </tr>
                            <div class="modal fade" id="view-ob-<?php echo md5($employee_schedule['id']); ?>" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content"></div>
                                </div>
                            </div>
                            <!-- <?php foreach ($employee_schedule['action_menus'] as $action_menu): ?>
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
    </div>
</div>
