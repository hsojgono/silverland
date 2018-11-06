<div class="modal-header">
	<h4 class="modal-title"><strong><?php echo $employee_work_experience['employee_full_name']; ?></strong> Details</h4>
</div>
<div class="modal-body">

	<table class="table table-striped">
		<tr>
			<td>DUTIES:</td>
			<td><?php echo $employee_work_experience['duties']; ?></td>
		</tr>
		<tr>
			<td>REASON FOR LEAVING:</td>
			<td><?php echo $employee_work_experience['reason_for_leaving']; ?></td>
		</tr>
		<tr>
			<td>MOBILE NUMBER:</td>
			<td><?php echo $employee_work_experience['mobile_number']; ?></td>
		</tr>
		<tr>
			<td>TELEPHONE NUMBER:</td>
			<td><?php echo $employee_work_experience['telephone_number']; ?></td>
		</tr>
		<tr>
			<td>ADDRESS:</td>
			<td><?php echo $employee_work_experience['full_address']; ?></td>
		</tr>
</div>
<div class="modal-footer">
	<button class="btn btn-primary" data-dismiss="modal">Close</button>
</div>