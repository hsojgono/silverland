<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-pencil-square-o"></i> <h3 class="box-title">Add Benefit</h3>
            </div>
            <div class="box-body">
                <form class="form-horizontal" action="<?php echo site_url('benefits/add'); ?>" method="post">
                    <label class="col-xs-3 text-left">Benefit Matrix</label>
                    <div class="form-group">
                        <div class="col-xs-6">
                            <select class="form-control select2 col-xs-3 col-md-3 col-sm-3 col-lg-3" name="benefit_matrix_id" id="benefit_matrix_id">
                                <option value="">-- Select Effectivity Date --</option>
                                <?php foreach ($benefit_matrices as $benefit_matrix): ?>
                                    <option value="<?php echo $benefit_matrix['id']; ?>"><?php echo $benefit_matrix['effectivity_date']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="validation_error"><?php echo form_error('benefit_matrix_id'); ?></div>
                        </div>
                    </div>
                    <label class="col-xs-3 text-left" for="name">Name</label>
                    <div class="form-group">
                        <div class="col-xs-6">
                            <input id="name" type="text" name="name" class="form-control" value="<?php echo set_value('name'); ?>">
                            <div class="validation_error"><?php echo form_error('name'); ?></div>
                        </div>
                    </div>
                    <label class="col-xs-3 text-left" for="name">Amount</label>
                    <div class="form-group">
                        <div class="col-xs-6">
                            <input id="amount" type="text" name="amount" class="form-control" value="<?php echo set_value('amount'); ?>">
                            <div class="validation_error"><?php echo form_error('amount'); ?></div>
                        </div>
                    </div>
                    <label class="col-xs-3 text-left" for="name">Description</label>
                    <div class="form-group">
                        <div class="col-xs-6">
                            <input id="description" type="text" name="description" class="form-control" value="<?php echo set_value('description'); ?>">
                            <div class="validation_error"><?php echo form_error('description'); ?></div>
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
