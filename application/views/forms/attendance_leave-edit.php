<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-pencil-square-o"></i> <h3 class="box-title">Edit Leave Details</h3>
            </div>
            <div class="box-body">
                <form class="form-horizontal" action="<?php echo site_url('attendance_leaves/edit/'.$attendance_leave['id']); ?>" method="post">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Leave Type</label>
                        <div class="col-md-6">
                            <select class="form-control select2" name="attendance_leave_type_id" id="leave_type">
                                <option value="<?php echo $attendance_leave['attendance_leave_type_id']; ?>"><?php echo $attendance_leave['leave_type_name']; ?></option>
                                <option value="">-- Select Leave Type --</option>
                                <?php foreach ($leave_types as $leave_type): ?>
                                    <option value="<?php echo $leave_type['id']; ?>"><?php echo $leave_type['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="validation_error"><?php echo form_error('attendance_leave_type_id'); ?></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Date Start</label>
                        <div class="col-md-6">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                <input type="text" name="date_start" class="form-control pull-right datepicker" 
                                value="<?php echo $attendance_leave['date_start']; ?>">
                            </div>
                            <div class="validation_error"><?php echo form_error('date_start'); ?></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Date End</label>
                        <div class="col-md-6">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                <input type="text" name="date_end" class="form-control pull-right datepicker" value="<?php echo $attendance_leave['date_end']; ?>">
                            </div>
                            <div class="validation_error"><?php echo form_error('date_end'); ?></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Reason</label>
                        <div class="col-md-6">
                            <textarea name="reason" class="form-control" rows="4" cols="40">
                            <?php echo set_value('reason'); ?></textarea>
                            <div class="validation_error"><?php echo form_error('reason'); ?></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-offset-3 col-md-6">
                            <button type="submit" class="<?php echo $btn_submit; ?>">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
