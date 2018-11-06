<form class="form-horizontal" action="<?php echo site_url('employees/save/employee_dependent/'.$employee_id); ?>" method="post">
	<div class="modal-header">
		<h3 class="modal-title"><?php echo $modal_title; ?></h3>
	</div>
	<div class="modal-body">
		<div class="form-group">
			<label for="" class="control-label col-sm-4">First Name</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="first_name" value="">
				<div class="validation_error"><?php echo form_error('first_name'); ?></div>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="control-label col-sm-4">Middle Name</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="middle_name" value="">
				<div class="validation_error"><?php echo form_error('middle_name'); ?></div>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="control-label col-sm-4">Last Name</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="last_name" value="">
				<div class="validation_error"><?php echo form_error('last_name'); ?></div>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="control-label col-sm-4">Relationship</label>
			<div class="col-sm-6">
				<select name="relationship_id" class="form-control">
					<option value="">-- SELECT RELATION --</option>
					<?php foreach ($relationships as $relation): ?>
					<option value="<?php echo $relation['id']; ?>"><?php echo $relation['name']; ?></option>
					<?php endforeach; ?>
				</select>
				<div class="validation_error"><?php echo form_error('relationship_id'); ?></div>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="control-label col-sm-4">Birthdate</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="birthdate">
				<div class="validation_error"><?php echo form_error('birthdate'); ?></div>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="control-label col-sm-4">Block Number</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="block_number">
				<div class="validation_error"><?php echo form_error('block_number'); ?></div>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="control-label col-sm-4">Lot Number</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="lot_number">
				<div class="validation_error"><?php echo form_error('lot_number'); ?></div>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="control-label col-sm-4">Floor Number</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="floor_number">
				<div class="validation_error"><?php echo form_error('floor_number'); ?></div>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="control-label col-sm-4">Building Number</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="building_number">
				<div class="validation_error"><?php echo form_error('building_number'); ?></div>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="control-label col-sm-4">Building Name</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="building_name">
				<div class="validation_error"><?php echo form_error('building_name'); ?></div>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="control-label col-sm-4">Street</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="street">
				<div class="validation_error"><?php echo form_error('street'); ?></div>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="control-label col-sm-4">Remarks</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="remarks">
				<div class="validation_error"><?php echo form_error('remarks'); ?></div>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<input type="hidden" name="mode" value="add">
		<a href="<?php echo site_url('employees/cancel_add/'.$employee_id); ?>" class="btn btn-default">Cancel</a>
		<button type="submit" class="btn btn-primary">Submit</button>
	</div>
</form>