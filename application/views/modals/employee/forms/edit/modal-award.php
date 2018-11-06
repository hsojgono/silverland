<form class="form-horizontal" action="<?php echo site_url('employees/edit_employee_awards/'.$award_id); ?>" method="post">
    <div class="modal-header">
        <h4 class="modal-title">Edit Award</h4>
    </div>
	<div class="modal-body">
		<div class="form-group">
			<label for="" class="control-label col-sm-4">Award Title</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="award" value="<?php echo $award['award_title']; ?>">
				<div class="validation_error"><?php echo form_error('award'); ?></div>
			</div>
		</div>
	    <div class="form-group ">
            <label class="col-sm-4 control-label">Date Received</label>
            <div class="col-sm-6">
                <input type="date" name="date" class="form-control" value="<?php echo date('Y-m-d', strtotime($award['award_date'])); ?>">
                <span class="fa fa-calendar form-control-feedback"></span><br>
                <div class="validation_error"><?php echo form_error('date'); ?></div>
            </div>
        </div>
		<div class="form-group">
			<label for="" class="control-label col-sm-4">Comment</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="comment" value="<?php echo $award['award_comment']; ?>">
				<div class="validation_error"><?php echo form_error('comment'); ?></div>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="control-label col-sm-4">Company</label>
			<div class="col-sm-6">
				<select name="company_id" class="form-control">
					<option value="<?php echo $award['company_id']; ?>"><?php echo $award['company_name']; ?></option>
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
