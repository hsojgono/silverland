<div class="tab-pane fade" id="tab-employment-information">
	<table class="table table-striped">
		<tr>
			<th>&nbsp;</th>
			<th>Date Hired</th>
			<th>Position</th>
			<th>Regularization</th>
			<th>Date Regularized</th>
		</tr>
		<?php foreach ($employment_information as $index => $information): ?>
		<tr>
			<!-- <td>
				<a href="<?php echo site_url('employees/confirmation/edit/'.$information['employee_id']); ?>">
					<i class="fa fa-pencil"></i> Edit
				</a>
			</td> -->
			<td>
				<a href="<?php echo site_url('employees/view_employment_information/'.$information['employee_information_id']); ?>" data-toggle="modal" data-target="#view-more-<?php echo $index; ?>">View More</a>
			</td>
			<td><?php echo date('M d, Y', strtotime($information['date_hired'])); ?></td>
			<td><?php echo $information['position']; ?></td>
			<td><?php echo $information['regularization_label']; ?></td>
			<td><?php echo $information['regularized_date']; ?></td>
		</tr>
		<div class="modal fade" id="view-more-<?php echo $index; ?>">
			<div class="modal-dialog">
				<div class="modal-content"></div>
			</div>
		</div>
		<?php endforeach ?>
	</table>
</div>
