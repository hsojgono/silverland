<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-pencil-square-o"></i> <h3 class="box-title">File Time Out</h3>
            </div>
            <div class="box-body">
                <form class="form-horizontal" action="<?php echo site_url('daily_time_records/out'); ?>" method="post">
                    <div class="form-group">
                        <label class="control-label col-md-3">Date</label>
                        <div class="col-md-6">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                <input id="date" type="text" name="date" class="form-control pull-right datepicker" value="<?php echo date('Y-m-d'); ?>">
                            </div>
                            <div class="validation_error"><?php echo form_error('date'); ?></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Time Out</label>
                        <div class="col-md-6">
                            <div class="bootstrap-timepicker">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-clock-o"></i></div>
                                    <input id="time_out" type="text" name="time_out" class="form-control pull-right timepicker">
                                </div>
                                <div class="validation_error"><?php echo form_error('time_out'); ?></div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <!-- <div>
                            <input type="hidden" name="log_type" value="<?php echo $log_type; ?>">
                        </div> -->
                    </div>
                    <div>
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

<style>
    .datepicker {
        z-index:1151 !important;
    }
</style>
