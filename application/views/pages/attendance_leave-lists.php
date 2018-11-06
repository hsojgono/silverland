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
              <!-- <ul class="nav nav-pills nav-stacked">
                <li class=""><a href="<?php echo site_url('leaves/index/pending'); ?>"><i class="fa fa-clock-o"></i> Pending <span class="label pull-right pending_color" id="totalPending"><?php echo $total_pending['']?></span></a></li>
                <li class=""><a href="<?php echo site_url('leaves/index/approved'); ?>"><i class="fa fa-thumbs-up"></i> Approved <span class="label pull-right approved_color" id="totalApproved"><?php echo $total_pending['']?></a></li>
                <li class=""><a href="<?php echo site_url('leaves/index/denied'); ?>"><i class="fa fa-thumbs-down" ></i> Denied <span class="label pull-right rejected_color" id="totalDenied"><?php echo $total_pending['']?></span></a></li>
                <li class=""><a href="<?php echo site_url('leaves/index/cancelled'); ?>"><i class="fa fa-times-circle"></i> Cancelled <span class="label pull-right cancelled_color" id="totalCancelled"><?php echo $total_pending['']?></span></a>
                </li>
              </ul> -->
                <ul class="nav nav-pills nav-stacked">
                    <li>
                        <a href="#">
                            <i class="fa fa-clock-o"></i> Pending
                            <span class="label pull-right pending_color"><?php echo number_format($total_pending); ?></span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-thumbs-up"></i> Approved
                            <span class="label pull-right approved_color"><?php echo number_format($total_approved); ?></span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-thumbs-down" ></i> Rejected
                            <span class="label pull-right rejected_color"><?php echo number_format($total_rejected); ?></span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-times-circle"></i> Cancelled
                            <span class="label pull-right cancelled_color"><?php echo number_format($total_cancelled); ?></span>
                        </a>
                    </li>
                </ul>              
            </div>
            <!-- /.box-body -->
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
                        <i class="fa  fa-navicon"></i> <?php echo $leave_balance['leave_type']; ?> <span class="label pull-right ' . <?php echo $leave_balance['status_icon']; ?> "><?php echo $leave_balance['elc_balance']; ?></span>
						</a>
					</li>
					<?php endforeach ?>
				</ul>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
    </div>

    <div class="col-md-9">
        <div class="box box-primary">
             <div class="box-header with-border">
                <i class="fa fa-list"></i> <h3 class="box-title">List of Filed Leaves</h3>

            <div class="pull-right">
                <a href="<?php echo site_url('leaves/add'); ?>" class="btn btn-primary">
                    <i class="fa fa-plus"></i>
                    <span>File Leave<span>
                </a>
            </div>                
            </div>
            <div class="nav-tabs-custom">
                <div></div>
                <div><br></div>
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#myLeaves" data-toggle="tab">My Leaves</a>
                    </li>
                    <li class="">
                        <a href="#approvals" data-toggle="tab">Approvals</a>
                    </li>
                </ul>
            <div class="tab-content">
                <div class="tab-pane fade in active" id="myLeaves">
                    <table class="table table-bordered table-striped table-hover" id="datatables-my_leaves">
                        <thead>
                            <tr>
                                <!-- <th style="width: 10px;">&nbsp;</th> -->
                                <th class="text-left">Leave Type</th>
                                <th class="text-left">Date Start</th>
                                <th class="text-left">Date End</th>
                                <th class="text-left">Reason</th>
                                <th class="text-left">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                         <?php if (! empty($my_leaves)): ?>
                         	<?php foreach ($my_leaves as $my_leave): ?>
                         		<tr>
                         			<!-- <td>
                                        <a class="<?php echo $btn_view; ?>" href="<?php echo site_url('leaves/cancel_leave/' . $my_leave['id']); ?>" data-toggle="modal" data-target="#status-action-cancel-<?php echo md5($my_leave['id']); ?>">
                                        <i class="fa fa-times" title="Cancel" data-toggle="tooltip"></i> -->
                                    </td>
                                    <td class="text-left"><?php echo $my_leave['leave_type']; ?></td>
                                    <td class="text-right"><?php echo $my_leave['date_start']; ?></td>
                                    <td class="text-right"><?php echo $my_leave['date_end']; ?></td>
                                    <td class="text-left"><?php echo $my_leave['reason']; ?></td>
                                    <td class="text-center"><?php echo $my_leave['a_status']; ?></td>
                         		</tr>
								<div class="modal fade" id="status-action-cancel-<?php echo md5($my_leave['id']); ?>" role="dialog">
									<div class="modal-dialog">
										<div class="modal-content"></div>
									</div>
								</div>
                         	<?php endforeach ?>
                         <?php endif ?>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade in" id="approvals">
                    <table class="table table-bordered table-striped table-hover" id="datatables-approval_leaves">
						<thead>
                            <tr>
                                <th style="width: 80px;">&nbsp;</th>
                                <th class="text-left">Employee Code</th>
                                <th class="text-left">Employee Name</th>
                                <th class="text-left">Leave Type</th>
                                <th class="text-left">Date Start</th>
                                <th class="text-left">Date End</th>
                                <th class="text-left">Reason</th>
                                <th class="text-left">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if ( ! empty($leave_requests)): ?>
                            <?php foreach ($leave_requests as $leave_request): ?>
                            <tr>
                                <td>
                                    <!-- <a class="<?php echo $btn_view; ?>" href="<?php echo site_url('leaves/view_leave/' . $leave_request['id']); ?>" data-toggle="modal" data-target="#view-leave-<?php echo md5($leave_request['id']); ?>">
                                    <i class="fa fa-search"></i> View
                                    </a> -->

                                    <?php foreach ($leave_request['action_menus'] as $action_menu): ?>
                                        <a class="<?php echo $action_menu['button_style']; ?>" href="<?php echo $action_menu['url']; ?>" <?php echo ($action_menu['modal_status']) ? $action_menu['modal_attributes'] : ''; ?>>
                                            <i class="<?php echo $action_menu['icon']; ?>" title="<?php echo $action_menu['label']; ?>" data-toggle="tooltip"></i> 
                                        </a>
                                    <?php endforeach ?>
                                </td>

                                <td class="text-right"><?php echo $leave_request['employee_code']; ?></td>
                                <td class="text-left"><?php echo $leave_request['full_name']; ?></td>
                                <td class="text-left"><?php echo $leave_request['leave_type']; ?></td>
                                <td class="text-right"><?php echo $leave_request['date_start']; ?></td>
                                <td class="text-right"><?php echo $leave_request['date_end']; ?></td>
                                <td class="text-left"><?php echo $leave_request['reason']; ?></td>
                                <td class="text-center"><?php echo $leave_request['a_status']; ?></td>
                            </tr>
                            <div class="modal fade" id="view-ob-<?php echo md5($leave_request['id']); ?>" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content"></div>
                                </div>
                            </div>
                            <?php foreach ($leave_request['action_menus'] as $action_menu): ?>
                                <div class="modal fade" id="<?php echo $action_menu['modal_id']; ?>" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content"></div>
                                    </div>
                                </div>
                            <?php endforeach ?>
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

<script type="text/javascript">

    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        var target = $(e.target).attr("href") // activated tab


        if (target == '#myLeaves')
        {
            testFN('my_undertime');
        }
        else
        {
            testFN('approval');
        }


    });



    function testFN(val) {
        $.ajax({
            url: 'http://localhost/kawani_ci/leaves/' + 'ajax_' + val,
            dataType: 'json',
            success: function (result) {
                console.log(result.summary);

                $("#totalPending").html(result.summary.total_pending);
                $("#totalApproved").html(result.summary.total_approved);
                $("#totalDenied").html(result.summary.total_denied);
                $("#totalCancelled").html(result.summary.total_cancelled);
            }
        });
    }

</script>
