
<form class="form-horizontal" action="<?php echo site_url('violation_levels/edit/' .$violation_level['id']); ?>" method="post"> 
    <div class="form-group">
        <label for="name" class="col-sm-3 control-label">Company:</label>
        <div class="col-sm-6">
            <select class="form-control" name="company_id" id="company_id">
                <option value="<?php echo $violation_level['company_id']; ?>"><?php echo $violation_level['company_name']; ?></option>
                <option value="">SELECT COMPANY</option>
                <?php foreach($companies as $index => $company): ?>
                <option value="<?php echo $company['id']; ?>"><?php echo $company['name']; ?></option>
                <?php endforeach; ?>              
            </select>
            <div class="validation_error"><?php echo form_error('company_id'); ?></div>
        </div>
    </div> 

   <div class="form-group">
        <label class="control-label col-sm-3">Violation Level Name:</label>
        <div class="col-sm-7">
            <input class="form-control" type="text" name="name" value="<?php echo $violation_level['name']; ?>" placeholder="name">
            <div class="validation_error"><?php echo form_error('name'); ?></div>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-3">Description:</label>
        <div class="col-sm-7">
            <input class="form-control" type="text" name="description" value="<?php echo $violation_level['description']; ?>" placeholder="description">
            <div class="validation_error"><?php echo form_error('description'); ?></div>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-3">&nbsp;</label>
        <div class="col-sm-7">
            <button type="submit" class="btn btn-primary btn-block">SUBMIT</button>
        </div>
    </div>

   <input type="hidden" name="mode" value="edit">
   <input type="hidden" name="id" value="<?php echo $violation_level['id']; ?>">
   
</form>