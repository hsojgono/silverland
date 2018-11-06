<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-pencil-square-o"></i> <h3 class="box-title">Add Bank</h3>
            </div>
            <div class="box-body">
                <form class="form-horizontal" action="<?php echo site_url('banks/add'); ?>" method="post">
                    <label class="col-xs-3 text-left" for="name">Name</label>
                    <div class="form-group">
                        <div class="col-xs-6">
                            <input id="name" type="text" name="name" class="form-control" value="<?php echo set_value('name'); ?>">
                            <div class="validation_error"><?php echo form_error('name'); ?></div>
                        </div>
                    </div>
                    <label class="col-xs-3 text-left" for="name">Contact Person</label>
                    <div class="form-group">
                        <div class="col-xs-6">
                            <input id="contact_person" type="text" name="contact_person" class="form-control" value="<?php echo set_value('contact_person'); ?>">
                            <div class="validation_error"><?php echo form_error('contact_person'); ?></div>
                        </div>
                    </div>
                    <label class="col-xs-3 text-left" for="name">Contact Number</label>
                    <div class="form-group">
                        <div class="col-xs-6">
                            <input id="contact_number" type="text" name="contact_number" class="form-control" value="<?php echo set_value('contact_number'); ?>">
                            <div class="validation_error"><?php echo form_error('contact_number'); ?></div>
                        </div>
                    </div>
                    <label class="col-xs-3 text-left" for="name">Address</label>
                    <div class="form-group">
                        <div class="col-xs-6">
                            <input id="address" type="text" name="address" class="form-control" value="<?php echo set_value('address'); ?>">
                            <div class="validation_error"><?php echo form_error('address'); ?></div>
                        </div>
                    </div>
                    <label class="col-xs-3 text-left">Description</label>
                    <div class="form-group">
                        <div class="col-xs-6">
                            <textarea name="description" class="form-control" rows="4" cols="40"><?php echo set_value('description'); ?></textarea>
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
