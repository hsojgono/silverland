<form class="form-horizontal" action="<?php echo site_url('official_businesses/add_client'); ?>" method="post">
	<div class="modal-header">
		<h4 class="modal-title"><?php echo $modal_title; ?></h4>
	</div>
	<div class="modal-body">
		<div class="form-group">
			<label for="" class="col-lg-3 control-label">Account</label>
			<div class="col-lg-8">
				<select name="account_id" id="account_id" class="form-control" required="true">
					<option value="">-- Select Account --</option>
					<?php foreach ($accounts as $index => $account): ?>
					<option value="<?php echo $account['id']; ?>"><?php echo $account['description']; ?></option>
					<?php endforeach ?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="col-lg-3 control-label">First Name</label>
			<div class="col-lg-8">
				<input type="text" class="form-control" name="first_name" id="first_name">
			</div>
		</div>
		<div class="form-group">
			<label for="" class="col-lg-3 control-label">Middle Name</label>
			<div class="col-lg-8">
				<input type="text" class="form-control" name="middle_name" id="middle_name">
			</div>
		</div>
		<div class="form-group">
			<label for="" class="col-lg-3 control-label">Last Name</label>
			<div class="col-lg-8">
				<input type="text" class="form-control" name="last_name" id="last_name">
			</div>
		</div>	
	</div>
	<div class="modal-footer">
		<button class="btn btn-default" type="button" data-dismiss="modal">Cancel</button>
		<button class="btn btn-primary" type="submit">Submit</button>
	</div>
</form>
