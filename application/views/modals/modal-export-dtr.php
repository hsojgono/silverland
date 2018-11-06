<form class="form-horizontal" action="<?php echo site_url('daily_time_records/export'); ?>" method="post">
<div class="modal-header">
    <h4 class="modal-title"><?php echo $modal_title; ?></h4>
</div>
<div class="modal-body">
    
    <!-- <div class="form-group">
        <label for="date_start" class="control-label col-sm-3">FROM</label>
        <div class="col-sm-7">
            <div class='input-group date' id="date_start" >
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
                <input type="text" class="form-control pull-right datepicker" name="date_from" required="true">
            </div>
        </div>
    </div>	 

    <div class="form-group">
        <label for="date_end" class="control-label col-sm-3">END</label>
        <div class="col-sm-7">
            <div class='input-group date' id="date_end" >
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
                <input type="text" class="form-control" name="date_to" required="true">
            </div>
        </div>
    </div>  -->
   
    
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