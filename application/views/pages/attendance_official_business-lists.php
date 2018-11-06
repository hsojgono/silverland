
<div class="row">
	<div class="col-md-3">
		<div class="box box-primary">
			<div class="box box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">Summary</h3>
					<div class="box-tools">
						<button type="button" class="btn btn-box-tool" data-widget="collapse">
							<i class="fa fa-minus"></i>
						</button>
					</div>
				</div>
				<div class="box-body no-padding">
					<ul class="nav nav-pills nav-stacked">
						<li>
							<a href="#">
								<i class="fa fa-clock-o"></i> Pending
								<span class="label pull-right pending_color"><?php echo number_format($total_pending); ?></span>
							</a>
						</li>
						<li>
							<a href="#">
								<i class="fa fa-thumbs-up"></i> Approved
								<span class="label pull-right approved_color"><?php echo number_format($total_approved); ?></span>
							</a>
						</li>
						<li>
							<a href="#">
								<i class="fa fa-thumbs-down" ></i> Rejected
								<span class="label pull-right rejected_color"><?php echo number_format($total_rejected); ?></span>
							</a>
						</li>
						<li>
							<a href="#">
								<i class="fa fa-times-circle"></i> Cancelled
								<span class="label pull-right cancelled_color"><?php echo number_format($total_cancelled); ?></span>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-9">
		<div class="box box-primary">
			<div class="box-header with-border">
				<i class="fa fa-list"></i> <h3 class="box-title">List of Filed Official Businesses</h3>

				<div class="pull-right">
					<a href="<?php echo site_url('official_businesses/add'); ?>" class="btn btn-primary">
						<i class="fa fa-plus"></i>
						<span>File Official Business</span>
					</a>
				</div>				
			</div>
			<br>
			<div class="nav-tabs-custom">
				<ul class="nav nav-tabs">
					<li class="active">
						<a href="#my_ob" data-toggle="tab">My Official Business</a>
					</li>
					<li class="">
						<a href="#ob_approvals" data-toggle="tab">Approvals</a>
					</li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane fade in active" id="my_ob">
						<div class="table-responsive">
							<table class="table table-bordered table-striped table-hover" id="datatables-my_official_business">
							<thead>
								<tr>
									<th style="width: 10px;">&nbsp;</th>
									<th class="text-left">Account</th>
									<th class="text-left">Contact Person</th>
									<th class="text-left">Agenda</th>
									<th class="text-left">Location</th>
									<th class="text-left">OB Date</th>
									<th class="text-left">OB Time</th>
									<th class="text-left">Status</th>
								</tr>
							</thead>
							<tbody>
								<?php if ( ! empty($my_official_businesses)): ?>
								<?php foreach ($my_official_businesses as $my_official_business): ?>
								<tr>
									<td>
										<a class="<?php echo $btn_view; ?>" href="<?php echo site_url('official_businesses/cancel_official_business/' . $my_official_business['id']); ?>" data-toggle="modal" data-target="#status-action-cancel-<?php echo md5($my_official_business['id']); ?>">
											<i class="fa fa-times" title="Cancel" data-toggle="tooltip"></i>
										</a>
									    <!-- <a class="<?php echo $btn_update; ?>" href="<?php echo site_url('official_businesses/edit/' . $my_official_business['id']); ?>">
										<i class="fa fa-pencil-square-o"></i> Edit
										</a>  -->
									</td>
									<!-- <td class="text-right"><?php echo $my_official_business['id']; ?></td> -->
									<td class="text-left"><?php echo $my_official_business['account_name']; ?></td>
									<td class="text-left"><?php echo $my_official_business['contact_person']; ?></td>
									<td class="text-left"><?php echo $my_official_business['agenda']; ?></td>
									<td class="text-left"><?php echo $my_official_business['location']; ?></td>
									<td class="text-right"><?php echo $my_official_business['date']; ?></td>
									<td class="text-right"><?php echo date('h:i A', strtotime($my_official_business['time_start'])); ?> - <?php echo date('h:i A', strtotime($my_official_business['time_end'])); ?></td>
									<td class="text-center"><?php echo $my_official_business['a_status']; ?></td>
								</tr>
								<div class="modal fade" id="status-action-cancel-<?php echo md5($my_official_business['id']); ?>" role="dialog">
									<div class="modal-dialog">
										<div class="modal-content"></div>
									</div>
								</div>
								<?php endforeach; ?>
							<?php endif; ?>
							</tbody>
						</table>
						</div>
					</div>
					<div class="tab-pane fade in" id="ob_approvals">
						<div class="table-responsive">
							<table class="table table-bordered table-striped table-hover" id="datatables-approval_official_business">
							<thead>
								<tr>
									<th style="width: 80px;">&nbsp;</th>
									<!-- <th class="text-left">No.</th> -->
									<th class="text-left">Employee Name</th>
									<th class="text-left">Account</th>
									<th class="text-left">Contact Person</th>
									<th class="text-left">Agenda</th>
									<th class="text-left">Location</th>
									<th class="text-left">OB Date</th>
									<th class="text-left">OB Time</th>
									<th class="text-left">Status</th>
								</tr>
							</thead>
							<tbody>
							<?php if ( ! empty($approval_official_businesses)): ?>
								<?php foreach ($approval_official_businesses as $approval_official_business): ?>
								<tr>
									<td>
										<!--<a class="<?php echo $btn_view; ?>" href="<?php echo site_url('official_businesses/view_ob/' . $approval_official_business['id']); ?>" data-toggle="modal" data-target="#view-ob-<?php echo md5($approval_official_business['id']); ?>">
										<i class="fa fa-search"></i> View
										</a> -->

                                        <?php foreach ($approval_official_business['action_menus'] as $action_menu): ?>
                                            <a class="<?php echo $action_menu['button_style']; ?>" href="<?php echo $action_menu['url']; ?>" <?php echo ($action_menu['modal_status']) ? $action_menu['modal_attributes'] : ''; ?>>
                                               <i class="<?php echo $action_menu['icon']; ?>" title="<?php echo $action_menu['label']; ?>" data-toggle="tooltip"></i> 
                                            </a>
                                        <?php endforeach ?>
									</td>

									<!-- <td class="text-right"><?php echo $approval_official_business['id']; ?></td> -->
									<td class="text-left"><?php echo $approval_official_business['full_name']; ?></td>
									<td class="text-left"><?php echo $approval_official_business['account_name']; ?></td>
									<td class="text-left"><?php echo $approval_official_business['contact_person']; ?></td>
									<td class="text-left"><?php echo $approval_official_business['agenda']; ?></td>
									<td class="text-left"><?php echo $approval_official_business['location']; ?></td>
									<td class="text-right"><?php echo $approval_official_business['date']; ?></td>
									<td class="text-right"><?php echo date('h:i A', strtotime($approval_official_business['time_start'])); ?> - <?php echo date('h:i A', strtotime($approval_official_business['time_end'])); ?></td>
									<td class="text-center"><?php echo $approval_official_business['a_status']; ?></td>
								</tr>
								<div class="modal fade" id="view-ob-<?php echo md5($approval_official_business['id']); ?>" role="dialog">
									<div class="modal-dialog">
										<div class="modal-content"></div>
									</div>
								</div>

                                <?php foreach ($approval_official_business['action_menus'] as $action_menu): ?>
                                    <div class="modal fade" id="<?php echo $action_menu['modal_id']; ?>" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content"></div>
                                        </div>
                                    </div>
                                <?php endforeach ?>
								<?php endforeach; ?>
							<?php endif; ?>
							</tbody>
						</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
