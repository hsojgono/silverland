<form class="form-horizontal" action="<?php echo site_url('employees/edit_employee_certifications/'.$employee_certification_id); ?>" method="post">
    <div class="modal-header">
        <h4 class="modal-title">Edit Work Experience</h4>
    </div>
	<div class="modal-body">
		<div class="form-group">
			<label for="" class="control-label col-sm-4">Name of Certificate</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="name" value="<?php echo $certification['name']; ?>">
				<div class="validation_error"><?php echo form_error('name'); ?></div>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="control-label col-sm-4">Certificate Number</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="number" value="<?php echo $certification['number']; ?>">
				<div class="validation_error"><?php echo form_error('number'); ?></div>
			</div>
		</div>

		<div class="form-group">
			<label for="" class="control-label col-sm-4">Issuing Authority</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="issuing_authority" value="<?php echo $certification['issuing_authority']; ?>">
				<div class="validation_error"><?php echo form_error('issuing_authority'); ?></div>
			</div>
		</div> 
        <div class="form-group ">
            <label class="col-sm-4 control-label">Date Received</label>
            <div class="col-sm-6">
                <input type="date" name="date_received" class="form-control" value="<?php echo date('Y-m-d', strtotime($certification['date_received'])); ?>">
                <span class="fa fa-calendar form-control-feedback"></span><br>
                <div class="validation_error"><?php echo form_error('date_received'); ?></div>
            </div>
        </div>
        <div class="form-group ">
            <label class="col-sm-4 control-label">Validity</label>
            <div class="col-sm-6">
                <input type="date" name="validity" class="form-control" value="<?php echo date('Y-m-d', strtotime($certification['validity'])); ?>">
                <span class="fa fa-calendar form-control-feedback"></span><br>
                <div class="validation_error"><?php echo form_error('validity'); ?></div>
            </div>
        </div>
		<div class="form-group">
			<label for="" class="control-label col-sm-4">Company</label>
			<div class="col-sm-6">
				<select name="company_id" class="form-control">
					<option value="<?php echo $certification['company_id']; ?>"><?php echo $certification['company_name']; ?></option>
					<option value="">-- SELECT COMPANY --</option>
					<?php foreach ($companies as $company): ?>
					<option value="<?php echo $company['id']; ?>"><?php echo $company['name']; ?></option>
					<?php endforeach; ?>
				</select>
				<div class="validation_error"><?php echo form_error('company_id'); ?></div>
			</div>
		</div>
    </div>  

    <div class="modal-footer">
        <input type="hidden" name="save">
        <a href="<?php site_url('employees/cancel_edit'); ?>" class="btn btn-default">Cancel</a>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
