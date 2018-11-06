<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-pencil-square-o"></i> <h3 class="box-title">Add Employee Loan</h3>
            </div>
            <div class="box-body">
                <form class="form-horizontal" action="<?php echo site_url('employee_loans/add'); ?>" method="post">
                    <label class="col-xs-3 text-left">Employee</label>
                    <div class="form-group">
                        <div class="col-xs-6">
                            <select class="form-control select2 col-xs-3 col-md-3 col-sm-3 col-lg-3" name="employee_id" id="employee_id">
                                <option value="">-- Select Employee --</option>
                                <?php foreach ($employees as $employee): ?>
                                    <option value="<?php echo $employee['id']; ?>"><?php echo $employee['full_name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="validation_error"><?php echo form_error('employee_id'); ?></div>
                        </div>
                    </div>
                    <label class="col-xs-3 text-left">Loan Type</label>
                    <div class="form-group">
                        <div class="col-xs-6">
                            <select class="form-control select2 col-xs-3 col-md-3 col-sm-3 col-lg-3" name="loan_type_id" id="loan_type_id">
                                <option value="">-- Select Loan Type --</option>
                                <?php foreach ($loan_types as $loan_type): ?>
                                    <option value="<?php echo $loan_type['id']; ?>"><?php echo $loan_type['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="validation_error"><?php echo form_error('loan_type_id'); ?></div>
                        </div>
                    </div>
                    <label class="col-xs-3 text-left" for="name">Interest per Month</label>
                    <div class="form-group">
                        <div class="col-xs-6">
                            <input id="interest_per_month" type="text" name="interest_per_month" class="form-control" value="<?php echo set_value('interest_per_month'); ?>" readonly="readonly">
                            <div class="validation_error"><?php echo form_error('interest_per_month'); ?></div>
                        </div>
                    </div>
                    <label class="col-xs-3 text-left" for="name">Amount</label>
                    <div class="form-group">
                        <div class="col-xs-6">
                            <input id="loan_amount" type="text" name="loan_amount" class="form-control" value="<?php echo set_value('loan_amount'); ?>" onkeypress="validate(event)">
                            <div class="validation_error"><?php echo form_error('loan_amount'); ?></div>
                        </div>
                    </div>
                    <label class="col-xs-3 text-left" for="name">Terms</label>
                    <div class="form-group">
                        <div class="col-xs-6">
                            <input id="months_to_pay" type="text" name="months_to_pay" class="form-control" value="<?php echo set_value('months_to_pay'); ?>">
                            <div class="validation_error"><?php echo form_error('months_to_pay'); ?></div>
                        </div>
                    </div>
                    <label class="col-xs-3 text-left" for="name">Total Interest</label>
                    <div class="form-group">
                        <div class="col-xs-6">
                            <input id="amount_interest" type="text" name="amount_interest" class="form-control" value="<?php echo set_value('amount_interest'); ?>" readonly="readonly">
                            <div class="validation_error"><?php echo form_error('amount_interest'); ?></div>
                        </div>
                    </div>
                    <label class="col-xs-3 text-left" for="name">Total Amount</label>
                    <div class="form-group">
                        <div class="col-xs-6">
                            <input id="total_amount" type="text" name="total_amount" class="form-control" value="<?php echo set_value('total_amount'); ?>" readonly="readonly">
                            <div class="validation_error"><?php echo form_error('total_amount'); ?></div>
                        </div>
                    </div>
                    <label class="col-xs-3 text-left" for="name">Monthly Amortization</label>
                    <div class="form-group">
                        <div class="col-xs-6">
                            <input id="monthly_amortization" type="text" name="monthly_amortization" class="form-control" value="<?php echo set_value('monthly_amortization'); ?>" readonly="readonly">
                            <div class="validation_error"><?php echo form_error('monthly_amortization'); ?></div>
                        </div>
                    </div>
                    <label class="col-xs-3 text-left">Reason</label>
                    <div class="form-group">
                        <div class="col-xs-6">
                            <textarea name="reason" class="form-control" rows="4" cols="40"><?php echo set_value('reason'); ?></textarea>
                            <div class="validation_error"><?php echo form_error('reason'); ?></div>
                        </div>
                    </div>
                    <label class="col-xs-3 text-left">Start Date</label>
                    <div class="form-group">
                        <div class="col-md-6">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                <input type="text" id="date_start" name="date_start" class="form-control pull-right datepicker date_start" value="<?php echo date('Y-m-d'); ?>">
                            </div>
                            <div class="validation_error"><?php echo form_error('date_start'); ?></div>
                        </div>
                    </div>
                    <label class="col-xs-3 text-left">Maturity Date</label>
                    <div class="form-group">
                        <div class="col-md-6">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                <input type="text" id="maturity_date" name="maturity_date" class="form-control pull-right datepicker maturity_date" value="<?php echo date('Y-m-d'); ?>">
                            </div>
                            <div class="validation_error"><?php echo form_error('maturity_date'); ?></div>
                        </div>
                    </div>
                    <input type="hidden" name="interest" id="interest">
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

<script>

    var terms = $('#months_to_pay');
    var interest = $('#interest');
    var loanType = $('#loan_type_id');
    var loanAmount = $('#loan_amount');
    var totalAmount = $('#total_amount');
    var totalInterest = $('#amount_interest');
    var interestPerMonth = $('#interest_per_month');
    var monthlyAmortization = $('#monthly_amortization');
    var maturityDate = $('#maturity_date');
    var dateStart = $('#date_start');

    $(terms).keyup(function() {

        var result = '';
        var interest_per_month = interest.val() / 100;

        if (interest.val() != 0 || interest.val() != 'NULL')
        {
            result = (loanAmount.val() * interest_per_month) * $(this).val();
            totalInterest.val(result.toFixed(2));
        }
      
        var amount = Number(loanAmount.val()) + Number(totalInterest.val());
        totalAmount.val(amount.toFixed(2));

        var amortization = totalAmount.val() / $(this).val();
        monthlyAmortization.val(amortization.toFixed(2));

        if (monthlyAmortization.val() == 'Infinity')
        {
            monthlyAmortization.val('0.00');
        }
        
    });

    loanAmount.keyup(function() {

        var result = $(this).val() / terms.val();
        monthlyAmortization.val(result.toFixed(2));

        if (monthlyAmortization.val() == 'Infinity')
        {
            monthlyAmortization.val('0.00');
        }

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

    $(document).ready(function() {
        $(loanType).on('change', function() {
            
            var loan_type_id = $(this).val();
            if (loan_type_id == '') 
            {

            }
            else
            {
                $.ajax({
                    url: BASE_URL + 'employee_loans/get_loan_interest',
                    type: 'POST',
                    data: {'loan_type_id' : loan_type_id},
                    dataType: 'json',
                    success: function(response) {
                        
                        var loan_interest = response.loan_interest_per_month;

                            var result = (loan_interest.interest_per_month) * 100;
                            interestPerMonth.val(result + '%') ;
                            $('#interest').val(result);

                    },
                    error: function () {
                        alert('Error')
                    }
                });
            }
        });
    }); 

   

</script>
