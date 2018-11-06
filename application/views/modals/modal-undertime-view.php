
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">Undertime Details</h4>
	</div>
	<div class="modal-body">
		<label class="col-xs-4 text-left">Employee Code:</label>
		<label class="col-xs-3 text-left"><?php echo $employee_data['employee_code']; ?></label>
	</div>
	<div class="modal-body">
		<label class="col-xs-4 text-left">Employee Name:</label>
		<label class="col-xs-3 text-left"><?php echo $employee_data['first_name']. ' ' .$employee_data['last_name']; ?></label>
	</div>
	<div class="modal-body">
		<label class="col-xs-4 text-left">Date:</label>
		<label class="col-xs-3 text-left"><?php echo date('F d, Y', strtotime($view_ut['date'])); ?></label>
	</div>
	<div class="modal-body">
		<label class="col-xs-4 text-left">Time Start:</label>
		<label class="col-xs-3 text-left"><?php echo date('h:i A', strtotime($view_ut['time_start'])); ?></label>
	</div>
	<div class="modal-body">
		<label class="col-xs-4 text-left">Time End:</label>
		<label class="col-xs-3 text-left"><?php echo date('h:i A', strtotime($view_ut['time_end'])); ?></label>
	</div>
	<div class="modal-body">
		<label class="col-xs-4 text-left">Reason:</label>
		<label class="col-xs-3 text-left"><?php echo $view_ut['reason']; ?></label>
	</div>
	<div class="modal-body">
		<p></p>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-success" data-dismiss="modal">Okay</button>
	</div>

