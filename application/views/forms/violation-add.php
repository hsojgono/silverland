
<form class="form-horizontal" action="<?php echo site_url('violations/save'); ?>" method="post">
    <div class="form-group">
        <label for="name" class="col-sm-3 control-label">Violation Level:</label>
        <div class="col-sm-6">
            <select class="form-control select2" name="violation_level_id" id="violation_level_id">
                <option value="">SELECT VIOLATION LEVEL</option>
                <?php foreach($violation_levels as $index => $violation_level): ?>
                <option value="<?php echo $violation_level['id']; ?>"><?php echo $violation_level['name']; ?></option>
                <?php endforeach; ?>              
            </select>
			<div class="validation_error"><?php echo form_error('violation_level_id'); ?></div>
        </div>
    </div> 
    <div class="form-group">
        <label for="name" class="col-sm-3 control-label">Violation Type:</label>
        <div class="col-sm-6">
            <select class="form-control select2" name="violation_type_id" id="violation_type_id">
                <option value="">SELECT VIOLATION TYPE</option>
                <?php foreach($violation_types as $index => $violation_type): ?>
                <option value="<?php echo $violation_type['id']; ?>"><?php echo $violation_type['name']; ?></option>
                <?php endforeach; ?>              
            </select>
			<div class="validation_error"><?php echo form_error('violation_type_id'); ?></div>
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
        <label class="control-label col-sm-3">&nbsp;</label>
        <div class="col-sm-6">
            <button type="submit" class="btn btn-primary btn-block">SUBMIT</button>
        </div>
    </div>

   <input type="hidden" name="mode" value="add">
   
</form>

