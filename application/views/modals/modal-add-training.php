<form class="form-horizontal" action="<?php echo site_url('trainings/add'); ?>" method="post">
<div class="modal-header">
    <h4 class="modal-title"><?php echo $modal_title; ?></h4>
</div>
<div class="modal-body">
    <div class="form-group">
        <label for="" class="col-lg-3 control-label">Company</label>
        <div class="col-lg-8">
            <select class="form-control select2" name="company_id" id="company_id" class="form-control" required="true">
                <option value="">-- SELECT COMPANY --</option>
                <?php foreach ($companies as $index => $company): ?>
                    <option value="<?php echo $company['id']; ?>"><?php echo $company['name']; ?></option>
                <?php endforeach ?>
            </select>
            <div class="validation_error"><?php echo form_error('company_id'); ?></div>
        </div>
    </div>
    <div class="form-group">
        <label for="" class="col-lg-3 control-label">Title</label>
        <div class="col-lg-8">
            <input type="text" class="form-control" name="title" id="title"value="<?php echo set_value('title'); ?>">
            <div class="validation_error"><?php echo form_error('title'); ?></div>
        </div>
    </div>
    <div class="form-group">
        <label for="" class="col-lg-3 control-label">Facilitator</label>
        <div class="col-lg-8">
            <input type="text" class="form-control" name="facilitator" id="facilitator"value="<?php echo    set_value('facilitator'); ?>">
            <div class="validation_error"><?php echo form_error('facilitator'); ?></div>
        </div>
    </div>
    <div class="form-group">
        <label for="" class="col-lg-3 control-label">Facilitator</label>
        <div class="col-lg-8">
            <input type="text" class="form-control" name="facilitator" id="facilitator"value="<?php echo    set_value('facilitator'); ?>">
            <div class="validation_error"><?php echo form_error('facilitator'); ?></div>
        </div>
    </div>
    <div class="form-group">
        <label for="" class="col-lg-3 control-label">Institution</label>
        <div class="col-lg-8">
            <input type="text" class="form-control" name="institution" id="institution"value="<?php echo    set_value('institution'); ?>">
            <div class="validation_error"><?php echo form_error('institution'); ?></div>
        </div>
    </div>
    <div class="form-group">
        <label for="" class="col-lg-3 control-label">Location</label>
        <div class="col-lg-8">
            <input type="text" class="form-control" name="location" id="location"value="<?php echo    set_value('location'); ?>">
            <div class="validation_error"><?php echo form_error('location'); ?></div>
        </div>
    </div>
    <div class="form-group">
        <label for="" class="col-lg-3 control-label">Date Started</label>
        <div class="col-lg-8">
        <div class="input-group">
            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
            <input type="text" name="date_started" class="form-control pull-right datepicker" value="<?php echo date('Y-m-d'); ?>">
        </div>
        <div class="validation_error"><?php echo form_error('date_started'); ?></div>
        </div>
    </div>
    <div class="form-group">
        <label for="" class="col-lg-3 control-label">Hours</label>
        <div class="col-lg-8">
            <input type="text" class="form-control" name="hours" id="hours"value="<?php echo    set_value('hours'); ?>">
            <div class="validation_error"><?php echo form_error('hours'); ?></div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button class="btn btn-default" type="button" data-dismiss="modal">Cancel</button>
    <button class="btn btn-primary" type="submit">Submit</button>
</div>
</form>