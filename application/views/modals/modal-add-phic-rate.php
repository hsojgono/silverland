<form class="form-horizontal" action="<?php echo site_url('phic_contribution_rates/add'); ?>" method="post">
	<div class="modal-header">
		<h4 class="modal-title"><?php echo $modal_title; ?></h4>
	</div>
	<div class="modal-body">
		<div class="form-group">
			<label for="" class="col-lg-3 control-label">Minimum Range</label>
			<div class="col-lg-8">
				<input type="text" class="form-control" name="minimum_range" id="minimum_range">
			</div>
		</div>
		<div class="form-group">
			<label for="" class="col-lg-3 control-label">Maximum Range</label>
			<div class="col-lg-8">
				<input type="text" class="form-control" name="maximum_range" id="maximum_range">
			</div>
		</div>
		<div class="form-group">
			<label for="" class="col-lg-3 control-label">Monthly Salary Base</label>
			<div class="col-lg-8">
				<input type="text" class="form-control" name="monthly_salary_base" id="monthly_salary_base">
			</div>
		</div>
		<div class="form-group">
			<label for="" class="col-lg-3 control-label">Employee Share</label>
			<div class="col-lg-8">
				<input type="text" class="form-control" name="employee_share" id="employee_share">
			</div>
		</div>
		<div class="form-group">
			<label for="" class="col-lg-3 control-label">Employer Share</label>
			<div class="col-lg-8">
				<input type="text" class="form-control" name="employer_share" id="employer_share">
			</div>
		</div>
		<div class="form-group">
			<label for="" class="col-lg-3 control-label">Total Monthly Premium</label>
			<div class="col-lg-8">
				<input type="text" class="form-control" name="total_monthly_premium" id="total_monthly_premium">
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<input type="hidden" name="phic_matrix_id" value="<?php echo $phic_matrix_id; ?>">
		<button class="btn btn-default" type="button" data-dismiss="modal">Cancel</button>
		<button class="btn btn-primary" type="submit">Submit</button>
	</div>
</form>