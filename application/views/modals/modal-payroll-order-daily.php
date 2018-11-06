<form action="<?php echo site_url('payroll_order_daily/generate_payroll_daily_workers'); ?>" class="form-horizontal" method="post"> 

    <div class="modal-header">
        <h4 class="modal-title">Daily Payroll Order</h4>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label for="date_start" class="control-label col-sm-4">Date Start:</label>
            <div class="col-sm-7">
                <input type="date" class="form-control" name="date_start" required="true" value="<?php echo date('Y-m-d'); ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="date_end" class="control-label col-sm-4">Date End:</label>
            <div class="col-sm-7">
                <input type="date" class="form-control" name="date_end" required="true" value="<?php echo date('Y-m-d'); ?>">
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Generate</button>
    </div>

</form>