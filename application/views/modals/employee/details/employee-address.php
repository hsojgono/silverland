<div class="modal-header">
	<h4 class="modal-title"><strong><?php echo $employee_address['employee_full_name']; ?></strong> Details</h4>
</div>
<div class="modal-body">

	<table class="table table-striped">
		<tr>
			<td>Barangay: </td>
			<td><?php echo $employee_address['location_barangay']; ?></td>
		</tr>
		<tr>
			<td>City</td>
			<td><?php echo $employee_address['location_city']; ?></td>
		</tr>
		<tr>
			<td>Province</td>
			<td><?php echo $employee_address['location_province']; ?></td>
		</tr>
		<tr>
			<td>Region</td>
			<td><?php echo $employee_address['location_region']; ?></td>
		</tr>
		<tr>
			<td>ZIP Code</td>
			<td><?php echo $employee_address['location_zipcode']; ?></td>
		</tr>
		<tr>
			<td>Country</td>
			<td><?php echo $employee_address['country_name']; ?></td>
		</tr>
		<tr>
			<td>ISO</td>
			<td><?php echo $employee_address['country_iso']; ?></td>
		</tr>
		<tr>
			<td>ISO3</td>
			<td><?php echo $employee_address['country_iso3']; ?></td>
		</tr>
		<tr>
			<td>Number Code</td>
			<td><?php echo $employee_address['country_number_code']; ?></td>
		</tr>
		<tr>
			<td>Phone Code</td>
			<td><?php echo $employee_address['country_phone_code']; ?></td>
		</tr>
	</table>
</div>
<div class="modal-footer">
	<button class="btn btn-primary" data-dismiss="modal">Close</button>
</div>

