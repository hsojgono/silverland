<div class="tab-pane fade" id="tab-daily-time-records">

	<table class="table table-bordered table-striped table-hover">
	<thead>
		<tr >
			<!-- <th>&nbsp;</th> -->
			<th class="text-center">Date</th>
			<th class="text-center">Time In</th>
			<th class="text-center">Time Out</th>
			<th class="text-center">Hours Rendered</th>
			<th class="text-center">Tardiness(min)</th>

		</tr>
		</thead>
		<?php foreach ($daily_time_records as $index => $dtr): ?>
		<tr>
			 <!-- <td>
				<a href="<?php echo site_url('employees/view_daily_time_record/'.$dtr['id']); ?>" data-toggle="modal" data-target="#view-more-<?php echo $index; ?>">View More</a>
			</td>  -->
			<td class="text-center"><?php echo date('M d, Y', strtotime($dtr['date'])); ?></td>
			<td class="text-center" ><?php echo date('h:i A', strtotime($dtr['time_in'])); ?></td>
			<td class="text-center"><?php echo date('h:i A', strtotime($dtr['time_out'])); ?></td>
			<td class="text-right"><?php echo  $dtr['number_of_hours']; ?></td>
			<td class="text-right"><?php echo  $dtr['minutes_tardy']; ?></td>

		</tr>
		<div class="modal fade" id="view-more-<?php echo $index; ?>">
			<div class="modal-dialog">
				<div class="modal-content"></div>
			</div>
		</div>
		<?php endforeach ?>
	</table>
</div>
