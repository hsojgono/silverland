
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-list"></i> <h3 class="box-title">List of Holidays</h3>
                <div class="box-tools">
					<a href="<?php echo site_url('holidays/add'); ?>" class="btn btn-box-tool text-blue">
						<i class="fa fa-plus"></i>
						<span>Add Holiday</span>
					</a>
				</div>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped table-hover" id="datatables-holidays">
                    <thead>
                        <tr>
                            <th style="width: 120px;">&nbsp;</th>
                            <th class="text-left">Date</th>
                            <th class="text-left">Holiday</th>
                            <th class="text-left">Holiday Type</th>
                            <!-- <th class="text-left">Description</th> -->
                            <th class="text-left">Company</th>
                            <th class="text-left">Branch</th>
                            <th class="text-left">Site</th>
                            <th class="text-left">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ( ! empty($holidays)): ?>
                            <?php foreach ($holidays as $holiday): ?>
                                <tr>
                                    <td>
                                        <!-- <a class="<?php echo $btn_view; ?>" href="<?php echo site_url('holidays/details/' . $holiday['id']); ?>">
                                            <i class="fa fa-search"></i> View
                                        </a> -->
                                        <a class="<?php echo $btn_update; ?>" href="<?php echo site_url('holidays/edit_confirmation/' . $holiday['id']); ?>" data-toggle="modal" data-target="#update-holiday-<?php echo md5($holiday['id']); ?>">
                                            <i class="fa fa-pencil-square-o" title="Edit" data-toggle="tooltip"></i>
                                        </a>
                                         <a class="<?php echo $btn_update; ?>" href="<?php echo site_url('holidays/update_status/' . $holiday['id']); ?>" data-toggle="modal" data-target="#update-holiday-status-<?php echo md5($holiday['id']); ?>">
                                            <i class="fa <?php echo $holiday['status_icon']; ?>" title="<?php echo $holiday['status_action']; ?> " data-toggle="tooltip"></i> 
                                        </a>
                                    </td>
                                    <td class="text-right"><?php echo $holiday['holiday_date']; ?></td>
                                    <td class="text-left"><?php echo $holiday['name']; ?></td>
                                    <td class="text-left"><?php echo $holiday['holiday_type']; ?></td>
                                    <!-- <td class="text-left"><?php echo $holiday['description']; ?></td> -->
                                    <td class="text-left"><?php echo $holiday['short_name']; ?></td>
                                    <td class="text-left"><?php echo $holiday['branch_name']; ?></td>
                                    <td class="text-left"><?php echo $holiday['site_name']; ?></td>
                                    <td class="text-center"><?php echo $holiday['status_label']; ?></td>
                                </tr>
                                <div class="modal fade" id="update-holiday-status-<?php echo md5($holiday['id']); ?>" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <!-- http://localhost/kawani_ci/roles/update_status/1 -->

                                        </div>
                                    </div>
                                </div>
                                 <div class="modal fade" id="update-holiday-<?php echo md5($holiday['id']); ?>" role="dialog">
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

<!-- <div id="calendar"></div>
<script type="text/javascript">
    $(document).ready(function() {
        var date_last_clicked = null;
        $('#calendar').fullCalendar({
            eventSources: [
               {
                    color: '#18b9e6',
                    textColor: '#000000',
                    events: function(start, end, timezone, callback) {
                        $.ajax({
                            url: '<?php echo site_url('holidays/ajax_calendar_event'); ?>',
                            dataType: 'json',
                            success: function(response) {
                                var events = response.events;
                                callback(events);
                            }
                        });
                    }
               }
           ],
           dayClick:  function(date, jsEvent, view) {
                date_last_clicked = $(this);
                alert('ASDASD');
            },
        });
    });
</script> -->
