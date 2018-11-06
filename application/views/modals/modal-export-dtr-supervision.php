<form class="form-horizontal" action="<?php echo site_url('daily_time_records/export'); ?>" method="post">
<div class="modal-header">
    <h4 class="modal-title"><?php echo $modal_title; ?></h4>
</div>
<div class="modal-body">
   <div class="form-group">
        <label class="control-label col-md-3">EMPLOYEE</label>
        <div class="col-md-7">
            <select class="form-control select2 col-xs-3 col-md-3 col-sm-3 col-lg-3" name="employee" id="employee">
                <option value="">-- Select Employee -- </option>
                <option value="0">All</option>
                <?php foreach ($employees as $employee) : ?>
                    <option value="<?php echo $employee['id']; ?>"><?php echo $employee['full_name']; ?></option>
                <?php endforeach; ?>
            </select>
            <div class="validation_error"><?php echo form_error('employee'); ?></div>
        </div>
    </div>
    
    <div class="form-group">
        <label class="control-label col-md-3">FROM</label>
        <div class="col-md-7">
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                <input type="text" name="date_from" class="form-control pull-right datepicker" id="dateFrom" value="<?php echo date('Y-m-d'); ?>">
            </div>
            <div class="validation_error"><?php echo form_error('date_from'); ?></div>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">TO</label>
        <div class="col-md-7">
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                <input type="text" name="date_to" class="form-control pull-right datepicker" id="dateTo" value="<?php echo date('Y-m-d'); ?>">
            </div>
            <div class="validation_error"><?php echo form_error('date_to'); ?></div>
        </div>
    </div>        
</div>
<div class="modal-footer">
    <button class="btn btn-default" type="button" data-dismiss="modal">Cancel</button>
    <button class="btn btn-primary" type="submit" data-loading-text="Loading...">Execute</button>
</div>
</form>

<script>

    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd'
    });  

</script>

<style type="text/css">
    .datepicker {
        z-index:99999 !important;
    }
</style>