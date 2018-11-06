<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-pencil-square-o"></i> <h3 class="box-title">Add New Site</h3>
            </div>
            <div class="box-body">
                <form class="form-horizontal" action="<?php echo site_url('sites/add'); ?>" method="post">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Name</label>
                        <div class="col-md-6">
                            <input type="text" name="name" class="form-control" value="<?php echo set_value('name'); ?>">
                            <div class="validation_error"><?php echo form_error('name'); ?></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Company</label>
                        <div class="col-md-6">
                            <select class="form-control select2" name="company_id" id="company">
                                <option value="">-- Select Company --</option>
                                <?php foreach ($companies as $company): ?>
                                    <option value="<?php echo $company['id']; ?>"><?php echo $company['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="validation_error"><?php echo form_error('company_id'); ?></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Branch</label>
                        <div class="col-md-6">
                            <select class="form-control select2" name="branch_id" id="branch">
                                <option value="">-- Select Branch --</option>
                                <?php foreach ($branches as $branch): ?>
                                    <option value="<?php echo $branch['id']; ?>"><?php echo $branch['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="validation_error"><?php echo form_error('branch_id'); ?></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Description</label>
                        <div class="col-md-6">
                            <textarea name="description" class="form-control" rows="4" cols="40"><?php echo set_value('description'); ?></textarea>
                            <div class="validation_error"><?php echo form_error('description'); ?></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Block Number</label>
                        <div class="col-md-6">
                            <input type="text" name="block_number" class="form-control" value="<?php echo set_value('block_number'); ?>">
                            <div class="validation_error"><?php echo form_error('block_number'); ?></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Lot Number</label>
                        <div class="col-md-6">
                            <input type="text" name="lot_number" class="form-control" value="<?php echo set_value('lot_number'); ?>">
                            <div class="validation_error"><?php echo form_error('lot_number'); ?></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Floor Number</label>
                        <div class="col-md-6">
                            <input type="text" name="floor_number" class="form-control" value="<?php echo set_value('floor_number'); ?>">
                            <div class="validation_error"><?php echo form_error('floor_number'); ?></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Building Number</label>
                        <div class="col-md-6">
                            <input type="text" name="building_number" class="form-control" value="<?php echo set_value('building_number'); ?>">
                            <div class="validation_error"><?php echo form_error('building_number'); ?></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Building Name</label>
                        <div class="col-md-6">
                            <input type="text" name="building_name" class="form-control" value="<?php echo set_value('building_name'); ?>">
                            <div class="validation_error"><?php echo form_error('building_name'); ?></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Street</label>
                        <div class="col-md-6">
                            <input type="text" name="street" class="form-control" value="<?php echo set_value('street'); ?>">
                            <div class="validation_error"><?php echo form_error('street'); ?></div>
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
