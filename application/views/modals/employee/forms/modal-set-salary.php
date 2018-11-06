<form action="<?php echo site_url('employees/save_salary_changes/' . $employee_id); ?>" method="post" class="form-horizontal">
	<div class="modal-header"><h3 class="modal-title"><?php echo $modal_title; ?></h3></div>
	<div class="modal-body">
		<div class="form-group">
			<?php if ( ! $current_salary): ?>
			<label for="" class="col-lg-3 control-label">Monthly Salary</label>
			<div class="col-lg-8">
				<div class="input-group">
					<input type="text" class="form-control" name="monthly_salary" id="monthlySalary" value="<?php echo $compensation_package['monthly_salary']; ?>" readonly="readonly">
					<span class="input-group-btn">
						<button class="btn btn-primary" type="button" id="btnSetSalary">Set</button>
					</span>
				</div>
			</div>
			<?php else: ?>
			<?php dump('here here'); ?>
			<label for="" class="col-lg-3 control-label">Monthly Salary</label>
			<div class="col-lg-8">
				<div class="input-group">
					<input type="text" class="form-control" name="monthly_salary" id="monthlySalary" value="<?php echo $current_salary['employee_monthly_salary']; ?>" readonly="readonly">
					<span class="input-group-btn">
						<button class="btn btn-primary" type="button" id="btnSetSalary">Edit</button>
					</span>
				</div>
			</div>
			<?php endif ?>
			
		</div>
	</div>
	<div class="modal-footer">
		<input type="hidden" name="employee_id" value="<?php echo $employee_id; ?>">
		<input type="hidden" name="company_id" value="<?php echo $compensation_package['cp_company_id']; ?>">
		<input type="hidden" name="position_id" value="<?php echo $compensation_package['cp_position_id']; ?>">
		<input type="hidden" name="mode" value="<?php echo ( ! $current_salary) ? 'set':'edit'; ?>">
		<?php if ($current_salary): ?>
		<input type="hidden" name="employee_salary_id" value="<?php echo $current_salary['employee_salaries_id']; ?>">
		<?php endif ?>
		<button class="btn btn-default" type="button" data-dismiss="modal">Cancel</button>
		<button class="btn btn-primary" type="submit">Submit</button>
	</div>
</form>

<script>
	$(function () {

		// cache DOM
		var btnSetSalary = $('#btnSetSalary');
		var monthlySalary = $('#monthlySalary');

		// bind events
		btnSetSalary.on('click', function () {
			monthlySalary.removeAttr('readonly');
		});

	});
</script>