<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-pencil-square-o"></i> <h3 class="box-title">Edit Department Details</h3>
            </div>
            <div class="box-body">
                <form class="form-horizontal" action="<?php echo site_url('departments/edit/'.$department['id']); ?>" method="post">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Company</label>
                        <div class="col-md-6">
                            <select class="form-control select2" name="company_id" id="company_id">
                                <option value="<?php echo $department['company_id']; ?>"><?php echo $department['company_name']; ?></option>
                                <option value="">-- SELECT COMPANY --</option>
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
                            <select class="form-control select2" name="branch_id" id="branch_id">
                                <option value="<?php echo $department['branch_id']; ?>"><?php echo $department['branch_name']; ?></option>
                                <option value="">-- SELECT BRANCH --</option>
                                <?php foreach ($branches as $branch): ?>
                                    <option value="<?php echo $branch['id']; ?>"><?php echo $branch['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="validation_error"><?php echo form_error('branch_id'); ?></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Site</label>
                        <div class="col-md-6">
                            <select class="form-control select2" name="site_id" id="site_id">
                                <option value="<?php echo $department['site_id']; ?>"><?php echo $department['site_name']; ?></option>
                                <option value="">-- SELECT SITE --</option>
                                <?php foreach ($sites as $site): ?>
                                    <option value="<?php echo $site['id']; ?>"><?php echo $site['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="validation_error"><?php echo form_error('site_id'); ?></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Name</label>
                        <div class="col-md-6">
                            <input type="text" name="name" class="form-control" value="<?php echo $department['name']; ?>">
                            <div class="validation_error"><?php echo form_error('name'); ?></div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label">Description</label>
                        <div class="col-md-6">
                            <textarea name="description" class="form-control" rows="4" cols="40"><?php echo $department['description']; ?></textarea>
                            <div class="validation_error"><?php echo form_error('description'); ?></div>
                        </div>
                    </div>
                    <!-- <div class="form-group">
                        <label class="col-md-3 control-label">Block Number</label>
                        <div class="col-md-6">
                            <input type="text" name="block_number" class="form-control" value="<?php echo $department['block_number']; ?>">
                            <div class="validation_error"><?php echo form_error('block_number'); ?></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Lot Number</label>
                        <div class="col-md-6">
                            <input type="text" name="lot_number" class="form-control" value="<?php echo $department['lot_number']; ?>">
                            <div class="validation_error"><?php echo form_error('lot_number'); ?></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Floor Number</label>
                        <div class="col-md-6">
                            <input type="text" name="floor_number" class="form-control" value="<?php echo $department['floor_number']; ?>">
                            <div class="validation_error"><?php echo form_error('floor_number'); ?></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Building Number</label>
                        <div class="col-md-6">
                            <input type="text" name="building_number" class="form-control" value="<?php echo $department['building_number']; ?>">
                            <div class="validation_error"><?php echo form_error('building_number'); ?></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Building Name</label>
                        <div class="col-md-6">
                            <input type="text" name="building_name" class="form-control" value="<?php echo $department['building_name']; ?>">
                            <div class="validation_error"><?php echo form_error('building_name'); ?></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Street</label>
                        <div class="col-md-6">
                            <input type="text" name="street" class="form-control" value="<?php echo $department['street']; ?>">
                            <div class="validation_error"><?php echo form_error('street'); ?></div>
                        </div>
                    </div> -->

                    <div class="form-group">
                        <div class="col-md-offset-3 col-md-6">
                            <button type="submit" class="<?php echo $btn_submit; ?>">Submit</button>
                            <!-- <a class="btn-primary <?php echo $btn_submit; ?>" href="<?php echo site_url('departments/confirmation/update/' . $department['id']); ?>" class="btn btn-link" data-toggle="modal" data-target="#modal-confirmation-<?php echo $department['id']; ?>" >
                                    Submit
                            </a> -->
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modal-confirmation-<?php echo  $department['id']; ?>">
    <div class="modal-dialog">
        <div class="modal-content"></div>
    </div>
</div>
