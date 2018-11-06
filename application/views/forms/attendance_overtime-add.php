<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-pencil-square-o"></i> <h3 class="box-title">File Overtime</h3>
            </div>
            <div class="box-body">
                <form class="form-horizontal" action="<?php echo site_url('overtimes/add'); ?>" method="post">
                    <div class="form-group">
                        <label class="control-label col-md-3">Overtime Date</label>
                        <div class="col-md-6">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                <input type="text" name="date" class="form-control pull-right datepicker" value="<?php echo date('m/d/Y'); ?>">
                            </div>
                            <div class="validation_error"><?php echo form_error('date'); ?></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Time Start</label>
                        <div class="col-md-6">
                            <div class="bootstrap-timepicker">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-clock-o"></i></div>
                                    <input type="text" name="time_start" class="form-control pull-right timepicker">
                                </div>
                                <div class="validation_error"><?php echo form_error('time_start'); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Time End</label>
                        <div class="col-md-6">
                            <div class="bootstrap-timepicker">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-clock-o"></i></div>
                                    <input type="text" name="time_end" class="form-control pull-right timepicker">
                                </div>
                                <div class="validation_error"><?php echo form_error('time_end'); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Reason</label>
                        <div class="col-md-6">
                            <textarea name="reason" class="form-control" rows="4" cols="40"><?php echo set_value('reason'); ?></textarea>
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
