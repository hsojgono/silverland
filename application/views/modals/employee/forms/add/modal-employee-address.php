<form class="form-horizontal" action="<?php echo site_url('employees/save/employee_address/'.$employee_id); ?>" method="post">
	<div class="modal-header">
		<h4 class="modal-title"><?php echo $modal_title; ?></h4>
	</div>
	<div class="modal-body">
		<div class="form-group">
			<label for="" class="control-label col-sm-4">Type</label>
			<div class="col-sm-6">
				<label class="radio-inline">
					<input type="radio" name="type" value="0" checked="true">Current
				</label>
				<label class="radio-inline">
					<input type="radio" name="type" value="1">Permanent
				</label>
				<label class="radio-inline">
					<input type="radio" name="type" value="2">Foreign
				</label>
				<div class="validation_error"><?php echo form_error('type'); ?></div>
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
			<label for="" class="control-label col-sm-4">Location_id</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="location_id">
				<div class="validation_error"><?php echo form_error('location_id'); ?></div>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="control-label col-sm-4">Country</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="country_id">
				<div class="validation_error"><?php echo form_error('country_id'); ?></div>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<input type="hidden" name="employee_id" value="<?php echo $employee_id; ?>">
		<input type="hidden" name="mode" value="add">
		<button class="btn btn-primary" type="submit">Submit</button>
		<a class=" btn btn-default" href="<?php echo site_url('employees/cancel_add/'.$employee_id); ?>">Cancel</a>
	</div>
</form>
<script type="text/javascript" src="<?php echo site_url('assets/libs/lodash/lodash.min.js'); ?>"></script>
<script type="text/javascript">

	var benefits = [];
	var benefitOption = $('#benefits');
	$.ajax({
		url: BASE_URL + 'employees/ajax/get-benefits',
		dataType: 'json',
		success: function(response) {
			var data = response.data;
			
			for (var i = 0; i < data.length; i++) {
				benefits.push({id: data[i].id, name: data[i].name, amount: data[i].amount});
				benefitOption.append('<option value="' + data[i].id + '">' + data[i].name + '</option>');
			}
		}
	});
	
	benefitOption.on('change', function() {
		var benefitID = $(this).val();
		var benefitAmount = $('#benefitAmount');
		var testIndex = _.findIndex(benefits, function(o) { return o.id == benefitID; });
		
		try {
			benefitAmount.val(benefits[testIndex].amount);
		}
		catch(err) {
			benefitAmount.val('0.00');
		}
	});
</script>