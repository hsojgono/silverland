<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-pencil-square-o"></i> <h3 class="box-title">Update Team Details</h3>
            </div>
            <div class="box-body">
                <form class="form-horizontal" action="<?php echo site_url('teams/edit/'.$team['id']); ?>" method="post">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Name</label>
                        <div class="col-md-6">
                            <input type="text" name="name" class="form-control" value="<?php echo $team['name']; ?>">
                            <div class="validation_error"><?php echo form_error('name'); ?></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Description</label>
                        <div class="col-md-6">
                            <textarea name="description" class="form-control" rows="4" cols="40"><?php echo $team['description']; ?></textarea>
                            <div class="validation_error"><?php echo form_error('description'); ?></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Company</label>
                        <div class="col-md-6">
                            <select class="form-control select2" name="company_id" id="company_id">
                                <option value="<?php echo $team['company_id']; ?>"><?php echo $team['company_name']; ?></option>
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
                            <select class="form-control select2" name="branch_id" id="branch_id">
                                <option value="<?php echo $team['branch_id']; ?>"><?php echo $team['branch_name']; ?></option>
                                <option value="">-- Select Branch --</option>
                                <?php foreach ($branches as $branch): ?>
                                    <option value="<?php echo $branch['id']; ?>"><?php echo $branch['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="validation_error"><?php echo form_error('branch_id'); ?></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Cost Center</label>
                        <div class="col-md-6">
                            <select class="form-control select2" name="cost_center_id" id="cost_center_id">
                                <option value="<?php echo $team['cost_center_id']; ?>"><?php echo $team['cost_center_name']; ?></option>
                                <option value="">-- Select Cost Center --</option>
                                <?php foreach ($cost_centers as $cost_center): ?>
                                    <option value="<?php echo $cost_center['id']; ?>"><?php echo $cost_center['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="validation_error"><?php echo form_error('cost_center_id'); ?></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Department</label>
                        <div class="col-md-6">
                            <select class="form-control select2" name="department_id" id="department_id">
                                <option value="<?php echo $team['department_id']; ?>"><?php echo $team['department_name']; ?></option>
                                <option value="">-- Select Department --</option>
                                <?php foreach ($department as $department): ?>
                                    <option value="<?php echo $department['id']; ?>"><?php echo $department['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="validation_error"><?php echo form_error('department_id'); ?></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Site</label>
                        <div class="col-md-6">
                            <select class="form-control select2" name="site_id" id="site_id">
                                <option value="<?php echo $team['site_id']; ?>"><?php echo $team['site_name']; ?></option>
                                <option value="">-- Select Site --</option>
                                <?php foreach ($sites as $site): ?>
                                    <option value="<?php echo $site['id']; ?>"><?php echo $site['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="validation_error"><?php echo form_error('site_id'); ?></div>
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
