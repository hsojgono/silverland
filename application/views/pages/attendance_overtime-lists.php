<div class="row">
    <div class="col-md-3">
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
                <li><a href="#"><i class="fa fa-clock-o"></i> Pending <span class="label pull-right pending_color"><?php echo $total_pending; ?></span></a></li>
                <li><a href="#"><i class="fa fa-thumbs-up"></i> Approved <span class="label pull-right approved_color"><?php echo $total_approved; ?></a></li>
                <li><a href="#"><i class="fa fa-thumbs-down" ></i> Rejected <span class="label pull-right rejected_color"><?php echo $total_rejected; ?></span></a></li>
                <li><a href="#"><i class="fa fa-times-circle"></i> Cancelled <span class="label pull-right cancelled_color"><?php echo $total_cancelled; ?></span></a>
                </li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
    </div>


    <div class="col-md-9">
        <div class="box box-primary">
             <div class="box-header with-border">
                <i class="fa fa-list"></i> <h3 class="box-title">List of Filed Overtimes</h3>

            <div class="pull-right">
                <a href="<?php echo site_url('overtimes/add'); ?>" class="btn btn-primary">
                    <i class="fa fa-plus"></i>
                    <span>File Overtime<span>
                </a>
            </div>                
            </div>
            <br>
            <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#my_overtime" data-toggle="tab">My Overtime</a>
                </li>
                <li class="">
                    <a href="#approval_overtimes" data-toggle="tab">Approvals</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade in active" id="my_overtime">
                    <table class="table table-bordered table-striped table-hover" id="datatables-my_overtimes">
                        <thead>
                            <tr>
                                <th style="width: 10px;">&nbsp;</th>
                                <th class="text-left">Date</th>
                                <th class="text-left">Time Start</th>
                                <th class="text-left">Time End</th>
                                <th class="text-left">Reason</th>
                                <th class="text-left">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ( ! empty($my_overtimes)): ?>
                                <?php foreach ($my_overtimes as $my_overtime): ?>

                                <tr>
                                    <td>
                                        <a class="<?php echo $btn_view; ?>" href="<?php echo site_url('overtimes/cancel_overtime/' . $my_overtime['id']); ?>" data-toggle="modal" data-target="#status-action-cancel-<?php echo md5($my_overtime['id']); ?>">
                                            <i class="fa fa-times" title="Cancel" data-toggle="tooltip"></i> 
                                        </a>
                                    </td> 

                                    <td class="text-right"><?php echo date('Y-m-d', strtotime($my_overtime['date'])); ?></td>
                                    <td class="text-right"><?php echo date('h:i A', strtotime($my_overtime['time_start'])); ?></td>
                                    <td class="text-right"><?php echo date('h:i A', strtotime($my_overtime['time_end'])); ?></td>
                                    <td class="text-left"><?php echo $my_overtime['reason']; ?></td>
                                    <td class="text-center"><?php echo $my_overtime['a_status']; ?></td>
                                </tr>
                                <div class="modal fade" id="status-action-cancel-<?php echo md5($my_overtime['id']); ?>" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content"></div>
                                    </div>
                                </div>
                                <?php endforeach ?>
                            <?php endif ?>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade in" id="approval_overtimes">
                    <table class="table table-bordered table-striped table-hover" id="datatables-approval_overtimes">
                        <thead>
                            <tr>
                                <th>&nbsp; Action</th>
                                <th class="text-left">Employee Code</th>
                                <th class="text-left">Employee Name</th>
                                <th class="text-left">Date</th>
                                <th class="text-left">Time Start</th>
                                <th class="text-left">Time End</th>
                                <th class="text-left">Reason</th>
                                <th class="text-left">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ( ! empty($approval_overtimes)): ?>
                                <?php foreach ($approval_overtimes as $approval_overtime): ?>

                                <tr>
                                    <td>
                                        <!-- <a class="<?php echo $btn_view; ?>" href="<?php echo site_url('overtimes/view_ot/' . $approval_overtime['id']); ?>" data-toggle="modal" data-target="#view-ob-<?php echo md5($approval_overtime['id']); ?>">
                                        <i class="fa fa-eye"></i> View
                                        </a> -->

                                        <?php foreach ($approval_overtime['action_menus'] as $action_menu): ?>
                                            <a class="<?php echo $action_menu['button_style']; ?>" href="<?php echo $action_menu['url']; ?>" <?php echo ($action_menu['modal_status']) ? $action_menu['modal_attributes'] : ''; ?>>
                                                <i class="<?php echo $action_menu['icon']; ?>" title="<?php echo $action_menu['label']; ?>" data-toggle="tooltip"></i>
                                            </a>
                                        <?php endforeach ?>
                                    </td>

                                    <td class="text-right"><?php echo $approval_overtime['employee_code']; ?></td>
                                    <td class="text-left"><?php echo $approval_overtime['full_name']; ?></td>
                                    <td class="text-right"><?php echo date('Y-m-d', strtotime($approval_overtime['date'])); ?></td>
                                    <td class="text-right"><?php echo date('h:i A', strtotime($approval_overtime['time_start'])); ?></td>
                                    <td class="text-right"><?php echo date('h:i A', strtotime($approval_overtime['time_end'])); ?></td>
                                    <td class="text-left"><?php echo $approval_overtime['reason']; ?></td>
                                    <td class="text-center"><?php echo $approval_overtime['a_status']; ?></td>
                                </tr>
                                    
                                    <?php foreach ($approval_overtime['action_menus'] as $action_menu): ?>
                                        <div class="modal fade" id="<?php echo $action_menu['modal_id']; ?>" role="dialog">
                                            <div class="modal-dialog">
                                                <div class="modal-content"></div>
                                            </div>  
                                        </div>
                                    <?php endforeach ?>
                                <?php endforeach ?>
                            <?php endif ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
