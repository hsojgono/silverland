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
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-pencil-square-o"></i> <h3 class="box-title">Set Employee Schedule</h3>
            </div>
            <div class="box-body">
                <form class="form-horizontal" action="<?php echo site_url('employee_schedules/add/'.$employee_id); ?>" method="post">
                <div class="form-group">
                    <label class="control-label col-md-3">Company</label>
                    <div class="col-md-6">
                        <select class="form-control select2 col-xs-3 col-md-3 col-sm-3 col-lg-3" name="company_id" id="company">
                            <?php if (count($companies) > 1): ?>
                                <option value="<?php echo $employee_details['company_id']; ?>"><?php echo $employee_details['company_name']; ?></option>

                                <!-- <?php foreach ($companies as $company): ?>
                                <option value="<?php echo $company['id']; ?>"><?php echo $company['name']; ?></option>
                                <?php endforeach; ?> -->
                            <?php else: ?>
                                <option value="<?php echo $companies[0]['id']; ?>"><?php echo $companies[0]['name']; ?></option>
                            <?php endif; ?>
                        </select>
                        <div class="validation_error"><?php echo form_error('company_id'); ?></div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Shift Code</label>
                    <div class="col-md-6">
                        <select class="form-control select2 col-xs-3 col-md-3 col-sm-3 col-lg-3" name="shift_id" id="shift">
                            <?php if (count($shift_schedules) > 1): ?>
                                <option value="<?php echo $employee_details['shift_id']; ?>"><?php echo $employee_details['shift_code']; ?></option>
                                <option value="">-- Select Shift --</option>
                                <?php foreach ($shift_schedules as $shift_schedule): ?>
                                <option value="<?php echo $shift_schedule['id']; ?>"><?php echo $shift_schedule['code']; ?></option>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <option value="<?php echo $shift_schedules[0]['id']; ?>"><?php echo $shift_schedules[0]['code']; ?></option>
                            <?php endif; ?>
                        </select>
                        <div class="validation_error"><?php echo form_error('shift_id'); ?></div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Date</label>
                    <div class="col-md-6">
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                            <input type="text" name="date" class="form-control pull-right datepicker" id="date" value="<?php echo $employee_details['date']; ?>">
                        </div>
                        <div class="validation_error"><?php echo form_error('date'); ?></div>
                    </div>
                </div>
                <div class="form-group">
                    <input type="hidden" name="employee_id" value="<?php echo $employee_details['id'] ?>">
                </div>
                <div class="form-group">
                    <div class="col-xs-offset-3 col-xs-6">
                        <button type="submit" class="<?php echo $btn_submit; ?>">Submit</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
