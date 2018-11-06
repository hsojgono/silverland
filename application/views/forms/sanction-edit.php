<form class="form-horizontal" action="<?php echo site_url('sanctions/edit/' .$sanction['id']); ?>" method="post"> 
<div class="form-group">
        <label for="name" class="col-sm-3 control-label">Sanction Type:</label>
        <div class="col-sm-6">
            <select class="form-control" name="sanction_type_id" id="sanction_type_id">
                <option value="<?php echo $sanction['sanction_type_id']; ?>"><?php echo $sanction['sanction_type_name']; ?></option>
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
            <select class="form-control" name="company_id" id="company_id">
                <option value="<?php echo $sanction['company_id']; ?>"><?php echo $sanction['company_name']; ?></option>
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
        <div class="col-sm-7">
            <input class="form-control" type="text" name="name" value="<?php echo $sanction['name']; ?>" placeholder="name">
            <div class="validation_error"><?php echo form_error('name'); ?></div>
        </div>
</div>
<div class="form-group">
    <label class="control-label col-sm-3">Description:</label>
        <div class="col-sm-7">
            <input class="form-control" type="text" name="description" value="<?php echo $sanction['description']; ?>" placeholder="description">
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
   <input type="hidden" name="id" value="<?php echo $sanction['id']; ?>">
   
</form>