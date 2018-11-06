<div class="modal-header"><h4 class="modal-title"><?php echo $modal_title; ?></h4></div>
<div class="modal-body">
	<div class="table-responsive">
		<table class="table table-bordered" id="datatables-tax-rates">
			<tr>
				<td>Minimum Range</td>
				<td><strong><?php echo $sss_rate['sr_minimum_range']; ?></strong></td>
			</tr>
			<tr>
				<td>Maximum Range</td>
				<td><strong><?php echo $sss_rate['sr_maximum_range']; ?></strong></td>
			</tr>
			<tr>
				<td>Monthly Salary Base</td>
				<td><strong><?php echo $sss_rate['sr_monthly_salary_base']; ?></strong></td>
			</tr>
			<tr>
				<td>Employer Share</td>
				<td><strong><?php echo $sss_rate['sr_employer_share']; ?></strong></td>
			</tr>
			<tr>
				<td>Employee Share</td>
				<td><strong><?php echo $sss_rate['sr_employee_share']; ?></strong></td>
			</tr>
			<tr>
				<td>Total</td>
				<td><strong><?php echo $sss_rate['sr_total']; ?></strong></td>
			</tr>
			<tr>
				<td>Status</td>
				<td><strong><?php echo $sss_rate['sr_status_label']; ?></strong></td>
			</tr>
		</table>
	</div>
</div>
<div class="modal-footer">
	<button class="btn btn-default" data-dismiss="modal">Close</button>
</div>