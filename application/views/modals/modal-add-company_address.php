<form class="form-horizontal" action="<?php echo site_url('company_addresses/add'); ?>" method="post">
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
			<label for="" class="col-lg-3 control-label">Location</label>
			<div class="col-lg-8">
				<select name="location_id" id="location_id" class="form-control" required="true">
					<option value="">-- Select Location --</option>
					<?php foreach ($locations as $index => $location): ?>
					<option value="<?php echo $location['id']; ?>"><?php echo $location['location']; ?></option>
					<?php endforeach ?>
				</select>
                <div class="validation_error"><?php echo form_error('location_id'); ?></div>
			</div>
		</div>	
        <div class="form-group">
            <label for="" class="col-lg-3 control-label">Unit Number</label>
            <div class="col-lg-8">
                <input type="text" class="form-control" name="unit_number" id="unit_number">
            </div>
            <div class="validation_error"><?php echo form_error('unit_number'); ?></div>
        </div>	
        <div class="form-group">
            <label for="" class="col-lg-3 control-label">Floor Number</label>
            <div class="col-lg-8">
                <input type="text" class="form-control" name="floor_number" id="floor_number">
            </div>
            <div class="validation_error"><?php echo form_error('floor_number'); ?></div>
        </div>	
        <div class="form-group">
            <label for="" class="col-lg-3 control-label">Unit Number</label>
            <div class="col-lg-8">
                <input type="text" class="form-control" name="unit_number" id="unit_number">
            </div>
            <div class="validation_error"><?php echo form_error('unit_number'); ?></div>
        </div>	
        <div class="form-group">
            <label for="" class="col-lg-3 control-label">Building Number</label>
            <div class="col-lg-8">
                <input type="text" class="form-control" name="building_number" id="building_number">
            </div>
            <div class="validation_error"><?php echo form_error('building_number'); ?></div>
        </div>
        <div class="form-group">
            <label for="" class="col-lg-3 control-label">Building Name</label>
            <div class="col-lg-8">
                <input type="text" class="form-control" name="building_name" id="building_name">
            </div>
            <div class="validation_error"><?php echo form_error('building_name'); ?></div>
        </div>
        <div class="form-group">
            <label for="" class="col-lg-3 control-label">Block Number</label>
            <div class="col-lg-8">
                <input type="text" class="form-control" name="block_number" id="block_number">
            </div>
            <div class="validation_error"><?php echo form_error('block_number'); ?></div>
        </div>
        <div class="form-group">
            <label for="" class="col-lg-3 control-label">Lot Number</label>
            <div class="col-lg-8">
                <input type="text" class="form-control" name="lot_number" id="lot_number">
            </div>
            <div class="validation_error"><?php echo form_error('lot_number'); ?></div>
        </div>
        <div class="form-group">
            <label for="" class="col-lg-3 control-label">Street</label>
            <div class="col-lg-8">
                <input type="text" class="form-control" name="street" id="street">
            </div>
            <div class="validation_error"><?php echo form_error('street'); ?></div>
        </div>
	</div>
	<div class="modal-footer">
		<button class="btn btn-default" type="button" data-dismiss="modal">Cancel</button>
		<button class="btn btn-primary" type="submit">Submit</button>
	</div>
</form>
