<div class="modal-header"><h4 class="modal-title"><?php echo $modal_title; ?></h4></div>
<div class="modal-body">
	<div class="table-responsive">
		<table class="table table-bordered" id="datatables-tax-rates">
			<tr>
				<td>Tax Excemption Status</td>
				<td><strong><?php echo $tax_rate['te_tax_status']; ?></strong></td>
			</tr>
			<tr>
				<td>Base Tax</td>
				<td><strong><?php echo $tax_rate['tr_base_tax']; ?></strong></td>
			</tr>
			<tr>
				<td>Percentage Over</td>
				<td><strong><?php echo $tax_rate['tr_percentage_over']; ?></strong></td>
			</tr>
			<tr>
				<td>Minimum Monthly Salary</td>
				<td><strong><?php echo $tax_rate['tr_minimum_monthly_salary']; ?></strong></td>
			</tr>
			<tr>
				<td>Maximum Monthly Salary</td>
				<td><strong><?php echo $tax_rate['tr_maximum_monthly_salary']; ?></strong></td>
			</tr>
		</table>
	</div>
</div>
<div class="modal-footer">
	<button class="btn btn-default" data-dismiss="modal">Close</button>
</div>