<!-- <div class="row">
    <div class="col-md-6">&nbsp;</div>
    <div class="col-md-6">
        <div class="pull-right">
            <a href="<?php echo site_url('employee_schedules/add'); ?>" class="btn btn-primary">
                <i class="fa fa-plus"></i>
                <span>Set Schedule<span>
            </a>
        </div>
    </div>
</div> -->
<br>

<div class="row">
    <div class="col-md-3">
        <div class="box box-primary">
            <div class="box-body">
                <h3 class="text-center"><?php echo $employee_details['full_name']; ?></h3>
                <p class="text-muted text-center">
                    <a href="<?php echo site_url('employee_schedules/details/' . $employee_details['id']); ?>">
                        <?php echo $employee_details['employee_code']; ?>
                    </a>
                </p>
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>Company</b><br>
                        <?php echo $employee_details['company_name']; ?>
                    </li>
                </ul>
                <!-- <a href="<?php echo site_url('employee_schedules/edit/' . $employee_details['id']); ?>" class="<?php echo $btn_edit; ?> btn-block">Edit Details</a> -->
            </div>
        </div>
    </div>

    <div class="col-md-9">
        <div class="box box-primary" >
            <div class="box-body">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <!-- <li class="">
                            <a href="#tab1" data-toggle="tab">Calendar View</a>
                        </li> -->
                        <li class="active">
                            <a href="#tab2" data-toggle="tab">List of Schedules</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <!-- <div class="tab-pane active fade in" id="tab1">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div id="employeeScheduleCalendar"></div>
                                </div>
                            </div>
                        </div> -->
                        <div class="tab-pane active fade in" id="tab2">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="pull-right">
                                        <a href="<?php echo site_url('employee_schedules/add/' . $employee_details['id']); ?>" class="btn btn-primary">
                                            <i class="fa fa-plus"></i>
                                            <span>Set Schedule<span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-12">
                                    <table class="table table-bordered table-striped table-hover" id="">
                                    <thead>
                                        <tr>
                                            <!-- <th>&nbsp;</th> -->
                                            <th class="text-left">Date</th>
                                            <th class="text-left">Shift Code</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                    <?php if ( ! empty($employee_schedules)): ?>
                                        <?php foreach ($employee_schedules as $employee_schedule): ?>
                                        <tr>
                                            <!-- <td>
                                                <a class="<?php echo $btn_update; ?>" href="<?php echo site_url('employee_schedules/edit_confirmation/' . $employee_schedule['id']); ?>" data-toggle="modal" data-target="#update-employee_schedule-<?php echo md5($employee_schedule['id']); ?>">
                                                    <i class="fa fa-pencil-square-o"></i> Edit
                                                </a>
                                            </td> -->

                                            <td class="text-right"><?php echo date('d F Y', strtotime($employee_schedule['date'])); ?></td>
                                            <td class="text-left"><?php echo $employee_schedule['shift_code']; ?></td>
                                            <!-- <td class="text-left"><?php echo $employee_schedule['shift_code']; ?></td> -->
                                            <!-- <td class="text-left"><?php echo date('d F Y', strtotime($employee_schedule['date'])); ?></td> -->
                                        </tr>
                                        <div class="modal fade" id="update-employee_schedule-<?php echo md5($employee_schedule['id']); ?>" role="dialog">
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
        </div>
    </div>
</div>
<div class="modal fade" id="modalAddSchedule">
	<div class="modal-dialog">
		<div class="modal-content">
			<form class="form-horizontal" action="<?php echo site_url('employee_schedules/add_schedule'); ?>" method="post">
                <div class="modal-header">New Schedule</div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">Selected Date</label>
                        <div class="col-sm-8">
                            <input type="text" name="date" id="clickedDate" class="form-control" readonly="readonly"> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">Shift Code</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="shift_id" id="shift_id">
                                <option value="">-- SELECT SHIFT CODE --</option>
                                <?php foreach ($shift_schedules as $shift_schedule): ?>
                                    <option value="<?php echo $shift_schedule['id']; ?>"><?php echo $shift_schedule['code']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="employee_id" value="<?php echo $employee_id; ?>">
                    <button class="btn btn-default" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>         
            </form>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {

		var dateLastClicked = null;

		$('#employeeScheduleCalendar').fullCalendar({
			eventSources: [
				{
                    // color: '#83C379',
                    color: '#008000',
                    textColor: '#000000',
                    events: function(start, end, timezone, callback) {
                        $.ajax({
                            url: '<?php echo base_url('employee_schedules/events/'.$employee_id) ?>',
                            dataType: 'json',
                            success: function(response) {
                                var schedules = response.schedules;
                                // console.log(schedules);
                                callback(schedules);
                            }
                        });
                    }
                }
			],
            dayClick: function(date, jsEvent, view) {
                $('#modalAddSchedule').modal();
                $('#clickedDate').val(date.format())
            }
		});
	});
    
</script>