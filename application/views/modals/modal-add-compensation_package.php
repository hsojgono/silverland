<form class="form-horizontal" action="<?php echo site_url('compensation_packages/add'); ?>" method="post">
	<div class="modal-header">
		<h4 class="modal-title"><?php echo $modal_title; ?></h4>
	</div>
	<div class="modal-body">
		<div class="form-group">
			<label for="" class="col-lg-3 control-label">Position</label>
			<div class="col-lg-8">
				<select name="position_id" id="position_id" class="form-control" required="true">
					<option value="">-- Select Position --</option>
					<?php foreach ($positions as $index => $position): ?>
					<option value="<?php echo $position['id']; ?>"><?php echo $position['name']; ?></option>
					<?php endforeach ?>
				</select>
                <div class="validation_error"><?php echo form_error('position_id'); ?></div>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="col-lg-3 control-label">Salary</label>
			<div class="col-lg-8">
				<select name="salary_id" id="salary_id" class="form-control" required="true">
					<option value="">-- Select Salary --</option>
					<?php foreach ($salaries as $index => $salary): ?>
					<option value="<?php echo $salary['id']; ?>"><?php echo $salary['monthly_salary']; ?></option>
					<?php endforeach ?>
				</select>
                <div class="validation_error"><?php echo form_error('salary_id'); ?></div>
			</div>
		</div>	
	</div>
	<div class="modal-footer">
		<button class="btn btn-default" type="button" data-dismiss="modal">Cancel</button>
		<button class="btn btn-primary" type="submit">Submit</button>
	</div>
</form>
