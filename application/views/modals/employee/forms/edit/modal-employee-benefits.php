<form class="form-horizontal" action="<?php echo site_url('employees/save/employee_benefits/'.$employee_id); ?>" method="post">
	<div class="modal-header">
		<h4 class="modal-title">Edit Employee Benefit</h4>
	</div>
	<div class="modal-body">
		<div class="form-group">
			<label for="" class="control-label col-sm-4">Amount</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="amount" value="" id="benefitAmount" readonly="readonly">
				<div class="validation_error"><?php echo form_error('amount'); ?></div>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button class="btn btn-primary" type="submit">Submit</button>
		<a class=" btn btn-default" href="<?php echo site_url('employees/cancel_add/'.$employee_id); ?>">Cancel</a>
	</div>
</form>