<div class="tab-pane fade" id="tab-positions">
	<div class="row">
		<div class="col-lg-12">
			<div class="pull-right">
				<a href="<?php echo site_url('employees/test_confirm/change_designation/' . $employee_id); ?>" class="btn btn-primary" data-toggle="modal" data-target="#confirmation-change-designation">Change Position</a>
				<div class="modal fade" id="confirmation-change-designation">
					<div class="modal-dialog">
						<div class="modal-content"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<br>
    <div class="row">
    	<div class="col-lg-4">
    		<div class="well">
    			<table class="table table-striped">
					<tr>
						<td>Name</td>
						<td></td>
					</tr>
					<tr>
						<td>Date Started</td>
						<td></td>
					</tr>
					<tr>
						<td>Date Ended</td>
						<td></td>
					</tr>
					<tr>
						<td>Status</td>
						<td></td>
					</tr>
				</table>
    		</div>
    	</div>
    	<div class="col-lg-8">
    		<div class="well">
    			<table class="table table-striped" id="datatables-employee-positions">
					<thead>
						<tr>
							<th>Position</th>
							<th>Date Started</th>
							<th>Date Ended</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody data-link="row" class="rowlink">
						<?php foreach ($employee_positions as $index => $position): ?>
						<tr>
							<td id="test"><?php echo $position['position']; ?></td>
							<td><?php echo $position['date_started']; ?></td>
							<td><?php echo $position['date_ended']; ?></td>
							<td><p class="label <?php echo ($position['active_status'] == 1) ? 'label-success' : 'label-danger'; ?>"><?php echo $position['status_label']; ?></p></td>
						</tr>
						<?php endforeach ?>
					</tbody>
				</table>
    		</div>
    	</div>
    </div>
</div>

<script>
	$(function() {
		var test = $('#test');

		test.on('click', function() {
			alert('running......');
		});
	});
</script>