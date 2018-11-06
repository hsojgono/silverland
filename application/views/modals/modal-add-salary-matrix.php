<form class="form-horizontal" action="<?php echo site_url('salary_matrices/add'); ?>" method="post">
	<div class="modal-header">
		<h4 class="modal-title"><?php echo $modal_title; ?></h4>
	</div>
	<div class="modal-body">
		<div class="form-group">
			<label for="" class="col-lg-3 control-label">Company</label>
			<div class="col-lg-8">
				<select name="company_id" id="company_id" class="form-control" required="true">
					<option value="">-- Select Company --</option>
					<?php foreach ($companies as $index => $company): ?>
					<option value="<?php echo $company['id']; ?>"><?php echo $company['name']; ?></option>
					<?php endforeach ?>
				</select>
                <div class="validation_error"><?php echo form_error('company_id'); ?></div>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="col-lg-3 control-label">Description</label>
			<div class="col-lg-8">
				<input type="text" class="form-control" name="description" id="description">
                <div class="validation_error"><?php echo form_error('description'); ?></div>
			</div>
		</div>	
		<div class="form-group">
			<label for="" class="col-lg-3 control-label">Date Effective</label>
			<div class="col-lg-8">
				<div class="input-group">
					<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
					<input type="text" name="effectivity_date" class="form-control datepicker" value="<?php echo date('Y-m-d'); ?>">
				</div>
			<div class="validation_error"><?php echo form_error('effectivity_date'); ?></div>
		</div>	        
	</div>
	<div class="modal-footer">
		<button class="btn btn-default" type="button" data-dismiss="modal">Cancel</button>
		<button class="btn btn-primary" type="submit">Submit</button>
	</div>
</form>

<script>

	$('.datepicker').datepicker({
        format: 'yyyy-mm-dd'
    });  

</script>

<style>

    .datepicker {z-index: 1151 !important;}

</style>