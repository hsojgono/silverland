<form class="form-horizontal" action="<?php echo site_url('company_contact_information/add'); ?>" method="post">
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
            <label for="" class="col-lg-3 control-label">Tel. Number</label>
            <div class="col-lg-8">
                <input type="text" class="form-control" name="telephone_number" id="telephone_number">
            </div>
            <div class="validation_error"><?php echo form_error('telephone_number'); ?></div>
        </div>	
        <div class="form-group">
            <label for="" class="col-lg-3 control-label">Mobile Number</label>
            <div class="col-lg-8">
                <input type="text" class="form-control" name="mobile_number" id="mobile_number">
            </div>
            <div class="validation_error"><?php echo form_error('mobile_number'); ?></div>
        </div>	
        <div class="form-group">
            <label for="" class="col-lg-3 control-label">Fax Number</label>
            <div class="col-lg-8">
                <input type="text" class="form-control" name="fax_number" id="fax_number">
            </div>
            <div class="validation_error"><?php echo form_error('fax_number'); ?></div>
        </div>	
        <div class="form-group">
            <label for="" class="col-lg-3 control-label">Email Address</label>
            <div class="col-lg-8">
                <input type="text" class="form-control" name="email" id="email">
            </div>
            <div class="validation_error"><?php echo form_error('email'); ?></div>
        </div>
        <div class="form-group">
            <label for="" class="col-lg-3 control-label">Website</label>
            <div class="col-lg-8">
                <input type="text" class="form-control" name="website" id="website">
            </div>
            <div class="validation_error"><?php echo form_error('website'); ?></div>
        </div>
	</div>
	<div class="modal-footer">
		<button class="btn btn-default" type="button" data-dismiss="modal">Cancel</button>
		<button class="btn btn-primary" type="submit">Submit</button>
	</div>
</form>
