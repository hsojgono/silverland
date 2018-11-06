
<form class="form-horizontal" action="<?php echo site_url('employees/add_employee_skill/'.$employee_id); ?>" method="post">
	<div class="modal-header">
		<h3 class="modal-title"><?php echo $modal_title; ?></h3>
	</div>
		<div class="form-group">
			<label for="" class="control-label col-sm-4">Skill</label>
			<div class="col-sm-6">
				<select name="skill_id" class="form-control">
					<option value="">-- SELECT SKILL --</option>
					<?php foreach ($skills as $skill): ?>
					<option value="<?php echo $skill['id']; ?>"><?php echo $skill['name']; ?></option>
					<?php endforeach; ?>
				</select>
				<div class="validation_error"><?php echo form_error('skill_id'); ?></div>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="control-label col-sm-4">Proficiency Level</label>
			<div class="col-sm-6">
				<select name="proficiency_level_id" class="form-control">
					<option value="">-- SELECT PROFICIENCY LEVEL --</option>
					<?php foreach ($proficiency_levels as $proficiency_level): ?>
					<option value="<?php echo $proficiency_level['id']; ?>"><?php echo $proficiency_level['proficiency']; ?></option>
					<?php endforeach; ?>
				</select>
				<div class="validation_error"><?php echo form_error('proficiency_level_id'); ?></div>
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
