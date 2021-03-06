<form class="form-horizontal" action="<?php echo site_url('sanctions/save'); ?>" method="post">
    <div class="form-group">
        <label for="name" class="col-sm-3 control-label">Sanction Type:</label>
        <div class="col-sm-6">
            <select class="form-control select2" name="sanction_type_id" id="sanction_type_id">
                <option value="">SELECT SANCTION TYPE</option>
                <?php foreach($sanction_types as $index => $sanction_type): ?>
                <option value="<?php echo $sanction_type['id']; ?>"><?php echo $sanction_type['name']; ?></option>
                <?php endforeach; ?>              
            </select>
			<div class="validation_error"><?php echo form_error('sanction_type_id'); ?></div>
        </div>
    </div> 
    <div class="form-group">
        <label for="name" class="col-sm-3 control-label">Company:</label>
        <div class="col-sm-6">
            <select class="form-control select2" name="company_id" id="company_id">
                <option value="">SELECT COMPANY</option>
                <?php foreach($companies as $index => $company): ?>
                <option value="<?php echo $company['id']; ?>"><?php echo $company['name']; ?></option>
                <?php endforeach; ?>              
            </select>
			<div class="validation_error"><?php echo form_error('company_id'); ?></div>
        </div>
    </div> 
    <div class="form-group">
        <label class="control-label col-sm-3">Sanction:</label>
        <div class="col-sm-6">
            <input class='form-control' type="text" name="name" value="<?php echo set_value('name'); ?>" placeholder="name">
            <div class="validation_error"><?php echo form_error('name'); ?></div>
        </div>
    </div>
    <div class="form-group">   
        <label class="control-label col-sm-3">Description:</label>
        <div class="col-sm-6">
            <input class='form-control' type="text" name="description" value="<?php echo set_value('description'); ?>" placeholder="description">
            <div class="validation_error"><?php echo form_error('description'); ?></div>
        </div>
    </div> 
    <div class="form-group">
        <label class="control-label col-sm-3">&nbsp;</label>
        <div class="col-sm-6">
            <button type="submit" class="btn btn-primary btn-block">SUBMIT</button>
        </div>
    </div>

   <input type="hidden" name="mode" value="add">
   
</form>

<!-- <form class="form-horizontal" action="<?php echo site_url('sanctions/save'); ?>" method="post">
    <div class="form-group">
        <label for="name" class="col-sm-3 control-label">Sanction Type:</label>
        <div class="col-sm-6">
            <select class="form-control select2" name="sanction_type_id" id="sanction_type_id">
                <option value="">SELECT SANCTION TYPE</option>
                <?php foreach($sanction_types as $index => $sanction_type): ?>
                <option value="<?php echo $sanction_type['id']; ?>"><?php echo $sanction_type['name']; ?></option>
                <?php endforeach; ?>              
            </select>
			<div class="validation_error"><?php echo form_error('sanction_type_id'); ?></div>
        </div>
    </div> 
    <div class="form-group">
        <label for="name" class="col-sm-3 control-label">Company:</label>
        <div class="col-sm-6">
            <select class="form-control select2" name="company_id" id="company_id">
                <option value="">SELECT COMPANY</option>
                <?php foreach($companies as $index => $company): ?>
                <option value="<?php echo $company['id']; ?>"><?php echo $company['name']; ?></option>
                <?php endforeach; ?>              
            </select>
			<div class="validation_error"><?php echo form_error('company_id'); ?></div>
        </div>
    </div>
    
    <div class="form-group">
        <div class="form-group">
        <label class="control-label col-sm-2">Sanction:</label>
        <div class="col-sm-6">
            <input class='form-control' type="text" name="name" value="<?php echo set_value('name'); ?>" placeholder="name">
            <div class="validation_error"><?php echo form_error('name'); ?></div>
        </div>
    </div>
    </div>
    <div class="form-group">
        <div class="form-group">
        <label class="control-label col-sm-3">Description:</label>
        <div class="col-sm-6">
            <input class='form-control' type="text" name="description" value="<?php echo set_value('description'); ?>" placeholder="description">
            <div class="validation_error"><?php echo form_error('description'); ?></div>
        </div>
    </div>
    </div> 
     <div class="form-group">
        <label class="control-label col-sm-3">&nbsp;</label>
        <div class="col-sm-6">
            <button type="submit" class="btn btn-primary btn-block">SUBMIT</button>
        </div>
    </div>

   <input type="hidden" name="mode" value="add">
   
</form> -->

