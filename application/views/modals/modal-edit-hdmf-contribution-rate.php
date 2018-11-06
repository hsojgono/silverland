<form class="form-horizontal" action="<?php echo site_url('hdmf_contribution_rates/edit/' . $hdmf_rate['hdmf_rate_id']); ?>" method="post">
	<div class="modal-header">
		<h4 class="modal-title"><?php echo $modal_title; ?></h4>
	</div>
	<div class="modal-body">
		<div class="form-group">
			<label for="" class="col-lg-3 control-label">Minimum Range</label>
			<div class="col-lg-8">
				<input type="text" class="form-control" name="minimum_range" id="minimum_range" value="<?php echo $hdmf_rate['hr_minimum_range']; ?>">
			</div>
		</div>
		<div class="form-group">
			<label for="" class="col-lg-3 control-label">Maximum Range</label>
			<div class="col-lg-8">
				<input type="text" class="form-control" name="maximum_range" id="maximum_range" value="<?php echo $hdmf_rate['hr_maximum_range']; ?>">
			</div>
		</div>
		<div class="form-group">
			<label for="" class="col-lg-3 control-label">Employer Share</label>
			<div class="col-lg-8">
				<input type="text" class="form-control" name="employer_share" id="employer_share" value="<?php echo $hdmf_rate['hr_employer_share']; ?>">
			</div>
		</div>
		<div class="form-group">
			<label for="" class="col-lg-3 control-label">Employee Share</label>
			<div class="col-lg-8">
				<input type="text" class="form-control" name="employee_share" id="employee_share" value="<?php echo $hdmf_rate['hr_employee_share']; ?>">
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<input type="hidden" name="hdmf_matrix_id" value="<?php echo $hdmf_rate['hr_hdmf_matrix_id']; ?>">
		<input type="hidden" name="save" value="true">
		<button class="btn btn-default" type="button" data-dismiss="modal">Cancel</button>
		<button class="btn btn-primary" type="submit">Submit</button>
	</div>
</form>