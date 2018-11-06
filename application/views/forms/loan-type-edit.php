<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-pencil-square-o"></i> <h3 class="box-title">Edit Loan Type Details</h3>
            </div>
            <div class="box-body">
                <form class="form-horizontal" action="<?php echo site_url('loan_types/edit/'. $loan_type['id']); ?>" method="post">
                    <label class="col-xs-3 text-left" for="name">Name</label>
                    <div class="form-group">
                        <div class="col-xs-6">
                            <input id="name" type="text" name="name" class="form-control" value="<?php echo $loan_type['name']; ?>">
                            <div class="validation_error"><?php echo form_error('name'); ?></div>
                        </div>
                    </div>
                    <!-- <label class="col-xs-3 text-left" for="name">Loan Limit</label>
                    <div class="form-group">
                        <div class="col-xs-6">
                            <input id="loan_limit" type="text" name="loan_limit" class="form-control" value="<?php echo $loan_type['loan_limit']; ?>">
                            <div class="validation_error"><?php echo form_error('loan_limit'); ?></div>
                        </div>
                    </div> -->
                    <label class="col-xs-3 text-left" for="name">Interest Per Month</label>
                    <div class="form-group">
                        <div class="col-xs-6">
                            <input id="interest_per_month" type="text" name="interest_per_month" class="form-control" value="<?php echo $loan_type['interest_per_month']; ?>">
                            <div class="validation_error"><?php echo form_error('interest_per_month'); ?></div>
                        </div>
                    </div>
                    <label class="col-xs-3 text-left" for="name">Frequency</label>
                    <div class="form-group">
                        <div class="col-xs-6">
                            <input id="frequency" type="text" name="frequency" class="form-control" value="<?php echo $loan_type['frequency']; ?>">
                            <div class="validation_error"><?php echo form_error('frequency'); ?></div>
                        </div>
                    </div>
                    <label class="col-xs-3 text-left">Description</label>
                    <div class="form-group">
                        <div class="col-xs-6">
                            <textarea name="description" class="form-control" rows="4" cols="40"><?php echo $loan_type['description']; ?></textarea>
                            <div class="validation_error"><?php echo form_error('description'); ?></div>
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
