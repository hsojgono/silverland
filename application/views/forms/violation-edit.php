<form class="form-horizontal" action="<?php echo site_url('violations/edit/' .$violation['id']); ?>" method="post"> 

	    <div class="form-group">
        <label for="name" class="col-sm-3 control-label">Violation Level:</label>
        <div class="col-sm-6">
            <select class="form-control" name="violation_level_id" id="violation_level_id">
                <option value="<?php echo $violation['violation_level_id']; ?>"><?php echo $violation['violation_level_name']; ?></option>
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
            <select class="form-control" name="violation_type_id" id="violation_type_id">
                <option value="<?php echo $violation['violation_type_id']; ?>"><?php echo $violation['violation_type_name']; ?></option>
                <option value="">SELECT VIOLATION TYPE</option>
                <?php foreach($violation_types as $index => $violation_type): ?>
                <option value="<?php echo $violation_type['id']; ?>"><?php echo $violation_type['name']; ?></option>
                <?php endforeach; ?>              
            </select>
            <div class="validation_error"><?php echo form_error('violation_type_id'); ?></div>
        </div>
    </div> 


    <div class="form-group">
        <label class="control-label col-sm-3">&nbsp;</label>
        <div class="col-sm-7">
            <button type="submit" class="btn btn-primary btn-block">SUBMIT</button>
        </div>
    </div>

   <input type="hidden" name="mode" value="edit">
   <input type="hidden" name="id" value="<?php echo $violation['id']; ?>">
   
</form>