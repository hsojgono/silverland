<form class="form-horizontal" action="<?php echo site_url('employees/add_employee_award/'.$employee_id); ?>" method="post">
	<div class="modal-header">
		<h3 class="modal-title"><?php echo $modal_title; ?></h3>
	</div>
	<div class="modal-body">
		<div class="form-group">
			<label for="" class="control-label col-sm-4">Title of Award</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="award" value="">
				<div class="validation_error"><?php echo form_error('award'); ?></div>
			</div>
		</div>
	    <div class="form-group ">
        <label class="col-sm-4 control-label">Date Received</label>
        <div class="col-sm-6">
            <input type="date" name="date" class="form-control" value="<?php echo set_value('award_date'); ?>">
            <span class="fa fa-calendar form-control-feedback"></span><br>
            <div class="validation_error"><?php echo form_error('date'); ?></div>
        </div>
		<div class="form-group">
			<label for="" class="control-label col-sm-4">Comment</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="comment" value="">
				<div class="validation_error"><?php echo form_error('comment'); ?></div>
			</div>
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