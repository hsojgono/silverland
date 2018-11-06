<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-pencil-square-o"></i> <h3 class="box-title"><?php echo $method_name?></h3>
            </div>
            <div class="box-body">
            <form id="leave_credit_form" class="form-horizontal" action="<?php echo site_url('employee_leave_credits/add'); ?>" method="post">
                <label class="col-xs-3 text-left">Company</label>
                <div class="form-group">
                    <div class="col-xs-6">
                        <select class="form-control select2 col-xs-3 col-md-3 col-sm-3 col-lg-3" name="company" id="company_id">
                            <option value="">-- Select Company --</option>
                            <?php foreach ($companies as $company): ?>
                                <option value="<?php echo $company['id']; ?>"><?php echo $company['short_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="validation_error"><?php echo form_error('company_id'); ?></div>
                    </div>
                </div>
                <label class="col-xs-3 text-left">Employee</label>
                <div class="form-group">
                    <div class="col-xs-6">
                        <select class="form-control select2 col-xs-3 col-md-3 col-sm-3 col-lg-3" name="employee" id="employee_id">
                            <!-- INSERT DATA -->
                        </select>
                        <div class="validation_error"><?php echo form_error('employee_id'); ?></div>
                    </div>
                </div>
                <label class="col-xs-3 text-left">Leave Type</label>
                    <div class="form-group">
                        <div class="col-xs-6">
                            <select class="form-control select2 col-xs-3 col-md-3 col-sm-3 col-lg-3" name="leave_type" id="leave_type_id">
                                <!-- INSERT DATA -->
                            </select>
                            <div class="validation_error"><?php echo form_error('leave_type_id'); ?></div>
                        </div>
                    </div>
                    <label class="col-xs-3 text-left" for="balance">Balance</label>
                    <div class="form-group">
                        <div class="col-xs-6">
                            <input id="balance_id" type="text" name="balance" class="form-control" value="<?php echo set_value('balance'); ?>" onkeypress="validate(event)">
                            <div class="validation_error"><?php echo form_error('balance'); ?></div>
                        </div>
                    </div>
                    <label class="col-xs-3 text-left"></label>
                    <div class="form-group">
                        <div class="col-xs-6">
                            <button type="submit" class="<?php echo $btn_submit; ?>">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    var company = $('#company_id'); 
    var employee = $('#employee_id');
    var leave_type = $('#leave_type_id');

    $(document).ready(function() {
        $(company).on('change', function() 
        {
            var company_id = $(this).val();

            $.ajax({
                url: BASE_URL + 'employee_leave_credits/post_employees',
                type: 'POST',
                data: {'company_id' : company_id},
                dataType: 'json',
                success: function(data) {$(employee).html(data);},
                error: function () {alert('Error: company');}
            });
        });
    }); 

    $(document).ready(function() {
        $(employee).on('change', function() 
        {
            var employee_id = $(this).val();
            var company_id = company.val();
            
            $.ajax({
                url: BASE_URL + 'employee_leave_credits/post_leave_types',
                type: 'POST',
                data: {
                    'employee_id' : employee_id,
                    'company_id' : company_id
                },
                dataType: 'json',
                success: function(data) { $(leave_type).html(data);},
                error: function () {alert(employee_id + ' Error: leave_type');}
            });
        });
    });

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

    $(function() {
        $("#leave_credit_form").validate
        ({
            rules: {
                company: 
                {
                    required: true
                },
                employee: 
                {
                    required: true
                },
                leave_type: 
                {
                    required: true
                },
                action: "required" 
            },
        });
    });
</script>
