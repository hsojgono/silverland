<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-list"></i> <h3 class="box-title">Daily Time Records</h3>
                <div class="box-tools pull-right">
                    <!-- <a href="<?php echo site_url('daily_time_records/load_form'); ?>" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#md-export-dtr"><i class="fa fa-navicon"></i> Export DTR</a> -->
                    <a href="<?php echo site_url('daily_time_records/in'); ?>" class="btn btn-info btn-sm">
                        <i class="fa fa-clock-o"></i>
                        <span>Time In</span>
                    </a>
                    <a href="<?php echo site_url('daily_time_records/out'); ?>" class="btn btn-danger btn-sm">
                        <i class="fa fa-clock-o"></i>
                        <span>Time Out</span>
                    </a>
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-navicon"></i> Export DTR
                    <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo site_url('daily_time_records/load_form'); ?>" data-toggle="modal" data-target="#md-export-dtr">My DTR</a></li>
                        <li><a href="<?php echo site_url('daily_time_records/under_my_supervision'); ?>" data-toggle="modal" data-target="#md-export-dtr-supervision">Under my Supervision</a></li>
                        <!-- <li><a href="#">Select Personnel</a></li> -->
                    </ul>
                </div>
            </div>
            <br>
            <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#my_dtr" data-toggle="tab">My Daily Time Records</a>
                </li>
                <li class="">
                    <a href="#dtr_approvals" data-toggle="tab">Approvals &nbsp; <span data-toggle="tooltip" title="" class="badge bg-yellow" data-original-title=" <?php echo $total_pending; ?> Approvals" ><?php echo $total_pending; ?></span></a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade in active" id="my_dtr">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover" id="datatables-daily-time-records">
                            <thead>
                                <tr>
                                    <!-- <th style="width: 150px;">&nbsp;</th> -->
                                    <th class="text-left">Date</th>
                                    <th class="text-left">Time In</th>
                                    <th class="text-left">Time Out</th>
                                    <th class="text-left">Hours Rendered</th>
                                    <th class="text-left">Tardiness(min)</th>
                                    <th class="text-left">Remarks</th>
                                    <th class="text-left">Shift Code</th>
                                    <!-- <th class="text-left">Status</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ( ! empty($daily_time_records)): ?>
                                    <?php foreach ($daily_time_records as $daily_time_record): ?>
                                        <tr>
                                            <td class="text-right"><?php echo date('Y-m-d', strtotime($daily_time_record['time_in'])); ?></td>
                                            <td class="text-right"><?php echo $daily_time_record['timein']; ?></td>
                                            <td class="text-right"><?php echo $daily_time_record['timeout']; ?></td>
                                            <td class="text-right"><?php echo $daily_time_record['number_of_hours']; ?></td>
                                            <td class="text-right"><?php echo $daily_time_record['minutes_tardy']; ?></td>
                                            <td class="text-left"><?php echo $daily_time_record['remarks']; ?></td>
                                            <td class="text-left"><?php echo $daily_time_record['shift']; ?></td>
                                            <!-- <td class="text-center"><?php echo $daily_time_record['status_action']; ?></td> -->
                                        </tr>
                                        <div class="modal fade" id="update-daily_time_record-status-<?php echo md5($daily_time_record['id']); ?>" role="dialog">
                                            <div class="modal-dialog">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <!-- http://localhost/kawani_ci/roles/update_status/1 -->

                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="update-daily_time_record-<?php echo md5($daily_time_record['id']); ?>" role="dialog">
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
                <div class="tab-pane fade in" id="dtr_approvals">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover" id="datatables-dtr-approvals">
                        <thead>
                            <tr>
                                <th style="width: 100px;">&nbsp;</th>
                                <!-- <th class="text-left">Shift Code</th> -->
                                <th class="text-left">Employee Code</th>
                                <th class="text-left">Employee</th>
                                <th class="text-left">Date</th>
                                <th class="text-left">Time Log</th>
                                <th class="text-left">Log Type</th>
                                <th class="text-left">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                         <?php if ( ! empty($dtr_approvals)): ?>
                            <?php foreach ($dtr_approvals as $index => $dtr_approval): ?>
                            <tr>
                                <td>
                                    <a class="<?php echo $btn_view; ?>" href="<?php echo site_url('daily_time_records/confirmation/approve/' . $dtr_approval['id']); ?>" class="btn btn-link" data-toggle="modal" data-target="#modal-confirmation-<?php echo $index; ?>">
                                    <i class="fa fa-check text-green" title="Approve" data-toggle="tooltip"></i>
                                    </a>
                                    <a class="<?php echo $btn_view; ?>" href="<?php echo site_url('daily_time_records/confirmation/reject/' . $dtr_approval['id']); ?>" class="btn btn-link" data-toggle="modal" data-target="#modal-confirmation-<?php echo $index; ?>">
                                    <i class="fa fa-times text-red" title="Reject" data-toggle="tooltip"></i>
                                    </a>                                                                          
                                </td>
                                <!-- <td class="text-left"><?php echo $dtr_approval['shift']; ?></td>                                -->
                                <td class="text-right"><?php echo $dtr_approval['employee_code']; ?></td>
                                <td class="text-left"><?php echo $dtr_approval['full_name']; ?></td>
                                <td class="text-right"><?php echo date('Y-m-d', strtotime($dtr_approval['date_time'])); ?></td>
                                <td class="text-right"><?php echo $dtr_approval['time_log']; ?></td>
                                <td class="text-left"><?php echo $dtr_approval['log_type']; ?></td>
                                <td class="text-center"><?php echo $dtr_approval['status_action']; ?></td>
                            </tr>
                            <div class="modal fade" id="view-ob-<?php echo md5($dtr_approval['id']); ?>" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content"></div>
                                </div>
                            </div>

                            <div class="modal fade" id="modal-confirmation-<?php echo $index; ?>">
                                <div class="modal-dialog">
                                    <div class="modal-content"></div>
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
    </div>

 <!-- MODALS -->

        <div class="modal fade" id="md-export-dtr">
            <div class="modal-dialog">
                <div class="modal-content"></div>
            </div>
        </div>

        <div class="modal fade" id="md-export-dtr-supervision">
            <div class="modal-dialog">
                <div class="modal-content"></div>
            </div>
        </div>

        <!-- <div class="modal fade" id="modal-confirmation-<?php echo $index; ?>">
            <div class="modal-dialog">
                <div class="modal-content"></div>
            </div>
        </div>        -->
        
        <!-- <?php if ($show_modal): ?>
            <div class="modal fade" id="modal-edit-salary">
                <div class="modal-dialog">
                    <div class="modal-content"><?php $this->load->view($modal_file_path); ?></div>
                </div>
            </div>
            <script type="text/javascript">
                $(function() {
                    $('#modal-edit-salary').modal({
                        backdrop: false,
                        keyboard: false
                    });
                });
            </script>
        <?php endif ?> -->
    </div>
</div>
