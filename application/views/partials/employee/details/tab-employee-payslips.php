<div class="tab-pane fade" id="tab-employee-payslips">
	<table class="table table-striped">
		<tr>
            <th style="width: 10px;">&nbsp;</th>
			<th>CUT OFF DATE</th>
		</tr>
		<?php foreach ($employee_payslips as $index => $payslip): ?>
		<tr>
        <td>
        <a class="<?php echo $btn_view; ?>" href="<?php echo site_url('payslips/view/' . $payslip['employee_id']); ?>">
        <i class="fa fa-eye" title="View" data-toggle="tooltip"></i>
        </a>
        </td>
            <td>
            <?php echo date('d F Y', strtotime($payslip['start_date'])); ?> -
			<?php echo date('d F Y', strtotime($payslip['end_date'])); ?>
        </td>
        </tr>
		<div class="modal fade" id="view-more-<?php echo $index; ?>">
			<div class="modal-dialog">
				<div class="modal-content"></div>
			</div>
		</div>
		<?php endforeach ?>
	</table>
</div>
