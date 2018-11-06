<form id="balanceForm" action="<?php echo site_url('employee_leave_credits/edit/' . $employee_leave_credit['elc_id']); ?>" class="form-horizontal" method="post"> 

    <div class="modal-header">
        <h3 class="modal-title"><?php echo $modal_header; ?></h3>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label for="full_name" class="col-sm-3 control-label">Employee Name:</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="full_name" name="full_name" value="<?php echo $employee_leave_credit['full_name']; ?>" disabled>
            </div>
        </div>
        <div class="form-group">
            <label for="type" class="col-sm-3 control-label">Type:</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="leave_type" name="leave_type" value="<?php echo strtoupper($employee_leave_credit['leave_type']); ?>" disabled>
            </div>
        </div>
        <div class="form-group">
            <label for="type" class="col-sm-3 control-label">Balance:</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="balance" name="balance" value="<?php echo strtoupper($employee_leave_credit['elc_balance']); ?>" onkeypress="validate(event)">
            </div>

        </div>
    </div>
    <div class="modal-footer">
        <div class="form-group">
            <div class="col-sm-8 col-sm-offset-3">
                <a href="<?php site_url('employee_leave_credits'); ?>" class="btn btn-default">
                    Cancel
                </a>
                <button type="submit" class="btn btn-primary" id="btn-submit" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Please wait...">
                    Submit
                </button>
            </div>
        </div>
    </div>    
</form>

<script>

    $(function() {
        $("#balanceForm").validate
        ({
            rules: 
            {
                balance: 
                {
                    required: true
                },
                action: "required"
            },
            messages: 
            {
            balance: 
            {
                required: "Please enter some data"
            },
            action: "Please provide some data"
            }
        });
    });

    //numerical only
    function validate(evt) {
        var theEvent = evt || window.event;
        var key = theEvent.keyCode || theEvent.which;
        key = String.fromCharCode( key );
        var regex = /[0-9]|\./;
        if( !regex.test(key) ) {
            theEvent.returnValue = false;
            if(theEvent.preventDefault) theEvent.preventDefault();
        }
    }

</script>
