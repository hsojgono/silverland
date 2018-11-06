<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-pencil-square-o"></i> <h3 class="box-title">Add Branch</h3>
            </div>
            <div class="box-body">
                <form class="form-horizontal" action="<?php echo site_url('branches/add'); ?>" method="post">
                    <label class="col-xs-3 text-left" for="name">Name</label>
                    <div class="form-group">
                        <div class="col-xs-6">
                            <input id="name" type="text" name="name" class="form-control" value="<?php echo set_value('name'); ?>">
                            <div class="validation_error"><?php echo form_error('name'); ?></div>
                        </div>
                    </div>
                    <label class="col-xs-3 text-left">Company</label>
                    <div class="form-group">
                        <div class="col-xs-6">
                            <select class="form-control select2 col-xs-3 col-md-3 col-sm-3 col-lg-3" name="company_id" id="company">
                                <option value="">-- Select a Company --</option>
                                <?php foreach ($companies as $company): ?>
                                    <option value="<?php echo $company['id']; ?>"><?php echo $company['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="validation_error"><?php echo form_error('company_id'); ?></div>
                        </div>
                    </div>
                    <label class="col-xs-3 text-left">Description</label>
                    <div class="form-group">
                        <div class="col-xs-6">
                            <textarea name="description" class="form-control" rows="4" cols="40"><?php echo set_value('description'); ?></textarea>
                            <div class="validation_error"><?php echo form_error('description'); ?></div>
                        </div>
                    </div>
                    <label class="col-xs-3 text-left">Block Number</label>
                    <div class="form-group">
                        
                        <div class="col-xs-6">
                            <input type="text" name="block_number" class="form-control" value="<?php echo set_value('block_number'); ?>">
                            <div class="validation_error"><?php echo form_error('block_number'); ?></div>
                        </div>
                    </div>
                    <label class="col-xs-3 text-left">Lot Number</label>
                    <div class="form-group">
                        <div class="col-xs-6">
                            <input type="text" name="lot_number" class="form-control" value="<?php echo set_value('lot_number'); ?>">
                            <div class="validation_error"><?php echo form_error('lot_number'); ?></div>
                        </div>
                    </div>
                    <label class="col-xs-3 text-left">Floor Number</label>
                    <div class="form-group">
                        <div class="col-xs-6">
                            <input type="text" name="floor_number" class="form-control" value="<?php echo set_value('floor_number'); ?>">
                            <div class="validation_error"><?php echo form_error('floor_number'); ?></div>
                        </div>
                    </div>
                    <label class="col-xs-3 text-left">Building Number</label>
                    <div class="form-group">
                        <div class="col-xs-6">
                            <input type="text" name="building_number" class="form-control" value="<?php echo set_value('building_number'); ?>">
                            <div class="validation_error"><?php echo form_error('building_number'); ?></div>
                        </div>
                    </div>
                    <label class="col-xs-3 text-left">Building Name</label>
                    <div class="form-group">
                        <div class="col-xs-6">
                            <input type="text" name="building_name" class="form-control" value="<?php echo set_value('building_name'); ?>">
                            <div class="validation_error"><?php echo form_error('building_name'); ?></div>
                        </div>
                    </div>
                    <label class="col-xs-3 text-left">Street</label>
                    <div class="form-group">
                        <div class="col-xs-6">
                            <input type="text" name="street" class="form-control" value="<?php echo set_value('street'); ?>">
                            <div class="validation_error"><?php echo form_error('street'); ?></div>
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
