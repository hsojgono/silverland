<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-pencil-square-o"></i> <h3 class="box-title">Add Training</h3>
            </div>
            <div class="box-body">
                <form class="form-horizontal" action="<?php echo site_url('trainings/add'); ?>" method="post">
                    <div class="form-group">
                    <label class="col-md-3 text-left">Company</label>
                        <div class="col-md-6">
                            <select class="form-control select2" name="company_id" id="company">
                                <option value="">-- SELECT COMPANY --</option>
                                <?php foreach ($companies as $company): ?>
                                    <option value="<?php echo $company['id']; ?>"><?php echo $company['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="validation_error"><?php echo form_error('company_id'); ?></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 text-left">Title</label>
                        <div class="col-md-6">
                            <input type="text" name="title" class="form-control" value="<?php echo set_value('title'); ?>">
                            <div class="validation_error"><?php echo form_error('title'); ?></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 text-left">Facilitator</label>
                        <div class="col-md-6">
                            <input type="text" name="facilitator" class="form-control" value="<?php echo set_value('facilitator'); ?>">
                            <div class="validation_error"><?php echo form_error('facilitator'); ?></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 text-left">Institution</label>
                        <div class="col-md-6">
                            <input type="text" name="institution" class="form-control" value="<?php echo set_value('institution'); ?>">
                            <div class="validation_error"><?php echo form_error('institution'); ?></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 text-left">Location</label>
                        <div class="col-md-6">
                            <input type="text" name="location" class="form-control" value="<?php echo set_value('location'); ?>">
                            <div class="validation_error"><?php echo form_error('location'); ?></div>
                        </div>
                    </div>
                    <div class="form-group">
                    <label class="col-md-3 text-left">Date Started</label>
                        <div class="col-md-6">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                <input type="text" name="date_started" class="form-control pull-right datepicker" value="<?php echo date('Y-m-d'); ?>">
                            </div>
                            <div class="validation_error"><?php echo form_error('date_started'); ?></div>
                        </div>
                    </div>
                    <div class="form-group">
                    <label class="col-md-3 text-left">Date Ended</label>
                        <div class="col-md-6">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                <input type="text" name="date_ended" class="form-control pull-right datepicker" value="<?php echo date('Y-m-d'); ?>">
                            </div>
                            <div class="validation_error"><?php echo form_error('date_ended'); ?></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 text-left">Hours</label>
                        <div class="col-md-6">
                            <input type="text" name="hours" class="form-control" value="<?php echo set_value('hours'); ?>">
                            <div class="validation_error"><?php echo form_error('hours'); ?></div>
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
