<form class="form-horizontal" action="<?php echo site_url('employees/add_employee_certification/'.$employee_id); ?>" method="post">
	<div class="modal-header">
		<h3 class="modal-title"><?php echo $modal_title; ?></h3>
	</div>
	<div class="modal-body">
		<div class="form-group">
			<label for="" class="control-label col-sm-4">Name of Certificate</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="name" value="">
				<div class="validation_error"><?php echo form_error('name'); ?></div>
			</div>
		</div>

		<div class="form-group">
			<label for="" class="control-label col-sm-4">Certificate Number</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="number" value="">
				<div class="validation_error"><?php echo form_error('number'); ?></div>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="control-label col-sm-4">Issuing Authority</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="issuing_authority" value="">
				<div class="validation_error"><?php echo form_error('issuing_authority'); ?></div>
			</div>
		</div>
		<div class="form-group ">
        <label class="col-sm-4 control-label">Date Received</label>
        <div class="col-sm-6">
            <input type="date" name="date_received" class="form-control" value="<?php echo set_value('date_received'); ?>">
            <span class="fa fa-calendar form-control-feedback"></span><br>
            <div class="validation_error"><?php echo form_error('date_received'); ?></div>
        </div>
	    <div class="form-group ">
        <label class="col-sm-4 control-label">Validity</label>
        <div class="col-sm-6">
            <input type="date" name="validity" class="form-control" value="<?php echo set_value('validity'); ?>">
            <span class="fa fa-calendar form-control-feedback"></span><br>
            <div class="validation_error"><?php echo form_error('validity'); ?></div>
        </div>
		<div class="form-group">
			<label for="" class="control-label col-sm-4">Company</label>
			<div class="col-sm-6">
				<select name="company_id" class="form-control">
					<option value="">-- SELECT COMPANY --</option>
					<?php foreach ($companies as $company): ?>
					<option value="<?php echo $company['id']; ?>"><?php echo $company['name']; ?></option>
					<?php endforeach; ?>
				</select>
				<div class="validation_error"><?php echo form_error('company_id'); ?></div>
			</div>
		</div>

	<div class="modal-footer">
		<input type="hidden" name="mode" value="add">
		<a href="<?php echo site_url('employees/cancel_add/'.$employee_id); ?>" class="btn btn-default">Cancel</a>
		<button type="submit" class="btn btn-primary">Submit</button>
	</div>
</form>
