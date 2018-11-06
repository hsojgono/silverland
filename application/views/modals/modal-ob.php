
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">OB Details</h4>
	</div>
	<div class="modal-body">
		<label class="col-xs-3 text-left">Account:</label>
		<label class="col-xs-3 text-left"><?php echo $account_name['name']; ?></label>
	</div>
	<div class="modal-body">
		<label class="col-xs-3 text-left">Contact Person:</label>
		<label class="col-xs-3 text-left"><?php echo $contact_person['first_name'].' '.$contact_person['last_name']; ?></label>
	</div>
	<div class="modal-body">
		<label class="col-xs-3 text-left">Agenda:</label>
		<label class="col-xs-3 text-left"><?php echo $view_ob['agenda']; ?></label>
	</div>
	<div class="modal-body">
		<label class="col-xs-3 text-left">Location:</label>
		<label class="col-xs-3 text-left"><?php echo $view_ob['location']; ?></label>
	</div>
	<div class="modal-body">
		<label class="col-xs-3 text-left">OD Date:</label>
		<label class="col-xs-3 text-left"><?php echo $view_ob['date']; ?></label>
	</div>
	<div class="modal-body">
		<label class="col-xs-3 text-left">OB Time</label>
		<label class="col-xs-3 text-left"><?php echo $view_ob['time_start']; ?></label>
	</div>
	<div class="modal-body">
		
	</div>
	
	<div class="modal-footer">
		<input type="hidden" name="mode" value="<?php echo $view_ob['approval_status']; ?>">
		<button type="button" class="btn btn-default" data-dismiss="modal">Okay</button>
	</div>
