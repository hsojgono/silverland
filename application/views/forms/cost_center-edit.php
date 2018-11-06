<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-pencil-square-o"></i> <h3 class="box-title">Update Cost Center Details</h3>
            </div>
            <div class="box-body">
                <form class="form-horizontal" action="<?php echo site_url('cost_centers/edit/'.$cost_center['id']); ?>" method="post">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Name</label>
                        <div class="col-md-6">
                            <input type="text" name="name" class="form-control" value="<?php echo $cost_center['name']; ?>">
                            <div class="validation_error"><?php echo form_error('name'); ?></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Description</label>
                        <div class="col-md-6">
                            <textarea name="description" class="form-control" rows="4" cols="40"><?php echo $cost_center['description']; ?></textarea>
                            <div class="validation_error"><?php echo form_error('description'); ?></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Company</label>
                        <div class="col-md-6">
                            <select class="form-control select2" name="company_id" id="company_id">
                                <option value="<?php echo $cost_center['company_id']; ?>"><?php echo $cost_center['company_name']; ?></option>
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
                                <option value="<?php echo $cost_center['branch_id']; ?>"><?php echo $cost_center['branch_name']; ?></option>
                                <option value="">-- Select Branch --</option>
                                <?php foreach ($branches as $branch): ?>
                                    <option value="<?php echo $branch['id']; ?>"><?php echo $branch['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="validation_error"><?php echo form_error('branch_id'); ?></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Department</label>
                        <div class="col-md-6">
                            <select class="form-control select2" name="department_id" id="department_id">
                                <option value="<?php echo $cost_center['department_id']; ?>"><?php echo $cost_center['department_name']; ?></option>
                                <option value="">-- Select Department --</option>
                                <?php foreach ($department as $department): ?>
                                    <option value="<?php echo $department['id']; ?>"><?php echo $department['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="validation_error"><?php echo form_error('department_id'); ?></div>
                        </div>
                    </div>                   
                    <div class="form-group">
                        <label class="col-md-3 control-label">Team</label>
                        <div class="col-md-6">
                            <select class="form-control select2" name="team_id" id="team_id">
                                <option value="<?php echo $cost_center['team_id']; ?>"><?php echo $cost_center['team_name']; ?></option>
                                <option value="">-- Select Team --</option>
                                <?php foreach ($teams as $team): ?>
                                    <option value="<?php echo $team['id']; ?>"><?php echo $team['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="validation_error"><?php echo form_error('team_id'); ?></div>
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
