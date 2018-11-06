<div class="row">
<div class="col-md-3">
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
							<i class="fa  fa-navicon "></i> <?php echo $leave_balance['leave_type']; ?> <span class="label pull-right ' . <?php echo $leave_balance['status_icon']; ?> "><?php echo $leave_balance['elc_balance']; ?></span>
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
                <i class="fa fa-pencil-square-o"></i> <h3 class="box-title">File Leave</h3>
            </div>
            <div class="box-body">
                <form class="form-horizontal" action="<?php echo site_url('leaves/add'); ?>" method="post">
                    <div class="form-group">
                        <div class="col-md-offset-3 col-md-6">
                            <label>
                                <input type="radio" name="payment_status" value="1" class="flat-red" <?php echo  set_radio('payment_status', '1', $isset_radio); ?> <?php echo ($without_pay) ? 'disabled':''; ?>> With Pay
                            </label>
                            <label>
                                <input type="radio" name="payment_status" value="0" class="flat-green" <?php echo  set_radio('payment_status', '0', $isset_radio); ?> <?php echo ($without_pay) ? 'checked':''; ?>> Without Pay
                            </label>

                            <div class="validation_error"><?php echo form_error('payment_status'); ?></div>
                        </div>
                    </div>
                <div class="form-group">
                        <label class="col-md-3 control-label">Leave Type</label>
                        <div class="col-md-6">
                            <select class="form-control select2" name="attendance_leave_type_id" id="leave">
                                <option value="">-- Select Leave Type --</option>
                                <?php foreach ($leave_balances as $leave_type): ?>
                                    <option value="<?php echo $leave_type['leave_type_id']; ?>"><?php echo $leave_type['leave_type']; ?></option>
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
                                <input type="text" name="date_start" class="form-control pull-right datepicker" id="dateStart" value="<?php echo date('m/d/Y'); ?>">
                            </div>
                            <div class="validation_error"><?php echo form_error('date_start'); ?></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Date End</label>
                        <div class="col-md-6">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                <input type="text" name="date_end" class="form-control pull-right datepicker" id="dateEnd" value="<?php echo date('m/d/Y'); ?>">
                            </div>
                            <div class="validation_error"><?php echo form_error('date_end'); ?></div>
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

<script type="text/javascript" src="<?php echo site_url('assets/js/leave_balance_checker.js'); ?>"></script>
