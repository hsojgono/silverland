<div class="tab-pane fade" id="tab-employee-awards">
	<div class="row">
		<div class="col-lg-12">	
				<h3 class="box-title">List of Awards </h3>
				
			<div class="pull-right">
				<a class="btn btn-primary" data-toggle="modal" data-target="#confirmation-add-employee-awards" href="<?php echo site_url('employees/confirmation/add/employee_awards/'.$employee_id); ?>"><i class="fa fa-plus"></i> Add Award</a>
				<div class="modal fade" id="confirmation-add-employee-awards">
					<div class="modal-dialog">
						<div class="modal-content"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-lg-12">
			<table class="table table-bordered table-striped" id="datatables-employees">
				<thead>

					<tr>
						<th style="width: 50px;">&nbsp;</th>
						<th>Award Title</th>
						<th>Date Received</th>
                        <th>Comment</th>                        
                        <th>Company</th>

					</tr>
				</thead>
				<tbody>
					<?php foreach ($employee_awards as $index => $employee_award): ?>
					<tr>
						<td class="text-center">
							
							<a href="<?php echo site_url('employees/edit_employee_awards/'.$employee_award['employee_award_id']); ?>" data-toggle="modal" data-target="#confirmation-edit-employee-award-<?php echo $index; ?>">
								<i class="fa fa-pencil-square-o" title="Edit" data-toggle="tooltip"></i> 
							</a>	

						</td>
                        <td class="text-left"><?php echo $employee_award['award_title']; ?></td>
                        <td class="text-right"><?php echo date('Y-m-d', strtotime($employee_award['award_date'])); ?></td>
						<td class="text-left"><?php echo $employee_award['award_comment']; ?></td>                        
						<td class="text-left"><?php echo $employee_award['company_name']; ?></td>
					</tr>

                         <div class="modal fade" id="confirmation-edit-employee-award-<?php echo $index; ?>">
                            <div class="modal-dialog">
                                <div class="modal-content"></div>
                            </div> 
                        </div>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

