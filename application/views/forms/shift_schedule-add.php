<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-pencil-square-o"></i> <h3 class="box-title">Add Shift Schedule</h3>
            </div>
            <div class="box-body">
                <form class="form-horizontal" action="<?php echo site_url('shift_schedules/add'); ?>" method="post">
                <div class="form-group">
                    <label class="control-label col-md-3">Company</label>
                    <div class="col-md-6">
                        <select class="form-control select2 col-xs-3 col-md-3 col-sm-3 col-lg-3" name="company_id" id="company">

                            <?php if (count($companies) > 1): ?>
                                <option value="">-- Select Company --</option>
                                <?php foreach ($companies as $company): ?>
                                <option value="<?php echo $company['id']; ?>"><?php echo $company['name']; ?></option>
                                <?php endforeach; ?>
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
                        <input id="code" type="text" name="code" class="form-control" value="<?php echo set_value('code'); ?>">
                        <div class="validation_error"><?php echo form_error('code'); ?></div>
                    </div>
                </div>
                    <div class="form-group">
                        <label  class="control-label col-md-3">Description</label>
                        <div class="form-group">
                            <div class="col-md-6">
                                <textarea name="description" class="form-control" rows="4" cols="30"><?php echo set_value('description'); ?></textarea>
                                <div class="validation_error"><?php echo form_error('description'); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Type</label>
                        <div class="col-md-6">
                            <select class="form-control select2 col-xs-3 col-md-3 col-sm-3 col-lg-3" name="type" id="type">
                                <option value="0">Fixed</option>
                                <option value="1">Flexi</option>
                                <option value="2">Variable</option>
                            </select>
                            <div class="validation_error"><?php echo form_error('type'); ?></div>
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
                        <label class="control-label col-md-3">Grace Period</label>
                        <div class="col-md-6">
                            <input id="grace_period" type="text" name="grace_period" class="form-control" value="<?php echo set_value('grace_period'); ?>">
                            <div class="validation_error"><?php echo form_error('grace_period'); ?></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Number of Hours</label>
                        <div class="col-md-6">
                            <input id="number_of_hours" type="text" name="number_of_hours" class="form-control" value="8">
                            <div class="validation_error"><?php echo form_error('number_of_hours'); ?></div>
                        </div>
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
