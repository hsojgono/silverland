<div class="modal-header"><h4 class="modal-title"><?php echo $modal_title; ?></h4></div>
<div class="modal-body">
	<div class="table-responsive">
		<table class="table table-bordered" id="datatables-tax-rates">
			<tr>
				<td>Minimum Range</td>
				<td><strong><?php echo $hdmf_rate['hr_minimum_range']; ?></strong></td>
			</tr>
			<tr>
				<td>Maximum Range</td>
				<td><strong><?php echo $hdmf_rate['hr_maximum_range']; ?></strong></td>
			</tr>
			<tr>
				<td>Employer Share</td>
				<td><strong><?php echo $hdmf_rate['hr_employer_share']; ?></strong></td>
			</tr>
			<tr>
				<td>Employee Share</td>
				<td><strong><?php echo $hdmf_rate['hr_employee_share']; ?></strong></td>
			</tr>
			<tr>
				<td>Status</td>
				<td><strong><?php echo $hdmf_rate['hr_status_label']; ?></strong></td>
			</tr>
		</table>
	</div>
</div>
<div class="modal-footer">
	<button class="btn btn-default" data-dismiss="modal">Close</button>
</div>