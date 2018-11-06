<!-- <div class="row">
    <div class="col-md-6">&nbsp;</div>
    <div class="col-md-6">
        <div class="pull-right">
            <a href="<?php echo site_url('undertimes/add'); ?>" class="btn btn-primary">
                <i class="fa fa-plus"></i>
                <span>File Udertime<span>
            </a>
        </div>
    </div>
</div> -->
<br>

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
                <li class="<?php echo ($selected == 'pending') ? 'active':''; ?>"><a href="<?php echo site_url('undertimes/index/pending'); ?>"><i class="fa fa-clock-o"></i> Pending <span class="label pull-right pending_color" id="totalPending"><?php echo number_format($total_pending); ?></span></a></li>
                <li class="<?php echo ($selected == 'approved') ? 'active':''; ?>"><a href="<?php echo site_url('undertimes/index/approved'); ?>"><i class="fa fa-thumbs-up"></i> Approved <span class="label pull-right approved_color" id="totalApproved"><?php echo number_format($total_approved); ?></a></li>
                <li class="<?php echo ($selected == 'denied') ? 'active':''; ?>"><a href="<?php echo site_url('undertimes/index/denied'); ?>"><i class="fa fa-thumbs-down" ></i> Denied <span class="label pull-right rejected_color" id="totalDenied"><?php echo number_format($total_rejected); ?></span></a></li>
                <li class="<?php echo ($selected == 'cancelled') ? 'active':''; ?>"><a href="<?php echo site_url('undertimes/index/cancelled'); ?>"><i class="fa fa-times-circle"></i> Cancelled <span class="label pull-right cancelled_color" id="totalCancelled"><?php echo number_format($total_cancelled); ?></span></a>
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
                <i class="fa fa-list"></i> <h3 class="box-title">List of Filed Undertimes</h3>

                <div class="pull-right">
                    <a href="<?php echo site_url('undertimes/add'); ?>" class="btn btn-primary">
                        <i class="fa fa-plus"></i>
                        <span>File Udertime<span>
                    </a>
                </div>                
            </div>
            <div class="nav-tabs-custom">
            <div></div>
            <div><br></div>
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#myUndertime" data-toggle="tab">My Undertime</a>
                </li>
                <li class="">
                    <a href="#approvals" data-toggle="tab">Approvals</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade in active" id="myUndertime">
                    <table class="table table-bordered table-striped table-hover" id="datatables-my_undertimes">
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
                            <?php if ( ! empty($my_undertimes)): ?>
                                <?php foreach ($my_undertimes as $my_undertime): ?>
                                    <tr>
                                        <td>
                                            <a class="<?php echo $btn_view; ?>" href="<?php echo site_url('undertimes/cancel_undertime/' . $my_undertime['id']); ?>" data-toggle="modal" data-target="#status-action-cancel-<?php echo md5($my_undertime['id']); ?>">
                                                <i class="fa fa-times" titile="Cancel" data-toggle="tooltip"></i>
                                            </a>
                                        </td>

                                        <td class="text-right"><?php echo date('Y-m-d', strtotime($my_undertime['date'])); ?></td>
                                        <td class="text-right"><?php echo date('h:i A', strtotime($my_undertime['time_start'])); ?></td>
                                        <td class="text-right"><?php echo date('h:i A', strtotime($my_undertime['time_end'])); ?></td>
                                        <td class="text-right"><?php echo $my_undertime['reason']; ?></td>
                                        <td class="text-center"><?php echo $my_undertime['a_status']; ?></td>
                                    </tr>
                                    <div class="modal fade" id="status-action-cancel-<?php echo md5($my_undertime['id']); ?>" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content"></div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade in" id="approvals">
                    <table class="table table-bordered table-striped table-hover" id="datatables-approval_undertimes">
                        <thead>
                            <tr>
                                <th style="width: 100px;">&nbsp;</th>
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
                                <?php if ( ! empty($undertimes)): ?>
                                    <?php foreach ($undertimes as $undertime): ?>
                                        <tr>
                                            <td>
                                                <!-- <a class="<?php echo $btn_view; ?>" href="<?php echo site_url('undertimes/view_undertime/' . $undertime['id']); ?>" data-toggle="modal" data-target="#view-undertime-<?php echo md5($undertime['id']); ?>">
                                                    <i class="fa fa-search"></i> View
                                                </a> -->
                                                <?php foreach ($undertime['action_menus'] as $action_menu): ?>
                                                    <a class="<?php echo $action_menu['button_style']; ?>" href="<?php echo $action_menu['url']; ?>" <?php echo ($action_menu['modal_status']) ? $action_menu['modal_attributes'] : ''; ?>>
                                                        <i class="<?php echo $action_menu['icon']; ?>" title="<?php echo $action_menu['label']; ?>" data-toggle="tooltip"></i> 
                                                    </a>
                                                <?php endforeach ?>
                                            </td>
                                            
                                            <td class="text-left"><?php echo $undertime['employee_code']; ?></td>
                                            <td class="text-left"><?php echo $undertime['full_name']; ?></td>
                                            <td class="text-right"><?php echo date('Y-m-d', strtotime($undertime['date'])); ?></td>
                                            <td class="text-right"><?php echo date('h:i A', strtotime($undertime['time_start'])); ?></td>
                                            <td class="text-right"><?php echo date('h:i A', strtotime($undertime['time_end'])); ?></td>
                                            <td class="text-right"><?php echo $undertime['reason']; ?></td>
                                            <td class="text-center"><?php echo $undertime['a_status']; ?></td>
                                        </tr>
                                        <div class="modal fade" id="view-undertime-<?php echo md5($undertime['id']); ?>" role="dialog">
                                            <div class="modal-dialog">
                                                <div class="modal-content"></div>
                                            </div>
                                        </div>
                                        <?php foreach ($undertime['action_menus'] as $action_menu): ?>
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


        if (target == '#myUndertime')
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
            url: 'http://localhost/kawani_ci/undertimes/' + 'ajax_' + val,
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