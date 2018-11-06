<form class="form-horizontal" action="<?php echo site_url('employees/save/employee_benefits/'.$employee_id); ?>" method="post">
	<div class="modal-header">
		<h4 class="modal-title">Add Employee Benefit</h4>
	</div>
	<div class="modal-body">
		<div class="form-group">
			<label for="" class="control-label col-sm-4">Benefit</label>
			<div class="col-sm-6">
				<select id="benefits" name="benefit_id" class="form-control">
					<option value="">-- SELECT BENEFIT --</option>
				</select>
				<div class="validation_error"><?php echo form_error('benefit_id'); ?></div>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="control-label col-sm-4">Amount</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="amount" value="" id="benefitAmount" readonly="readonly">
				<div class="validation_error"><?php echo form_error('amount'); ?></div>
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