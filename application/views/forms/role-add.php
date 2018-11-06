<div class="row">
	<form class="form-horizontal" action="<?php echo site_url('roles/add'); ?>" method="post">
		<div class="col-md-4">
		    <div class="box box-primary">
		        <div class="box-header with-border">
		            <i class="fa fa-pencil-square-o"></i> <h3 class="box-title">Add New Role</h3>
		        </div>
		        <div class="box-body">
		            <div class="form-horizontal">
		            	<div class="form-group">
		                    <label class="col-md-3 control-label">Name</label>
		                    <div class="col-md-8">
		                        <input type="text" name="group_name" class="form-control" value="<?php echo set_value('group_name'); ?>">
		                        <div class="validation_error"><?php echo form_error('group_name'); ?></div>
		                    </div>
		                </div>
		                <div class="form-group">
		                    <label class="col-md-3 control-label">Description</label>
		                    <div class="col-md-8">
		                        <textarea name="description" class="form-control" rows="4" cols="40"><?php echo set_value('description'); ?></textarea>
		                        <div class="validation_error"><?php echo form_error('description'); ?></div>
		                    </div>
		                </div>
		                <div class="form-group">
		                    <div class="col-md-offset-3 col-md-8">
		                        <button type="submit" class="<?php echo $btn_submit; ?>">Submit</button>
		                    </div>
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
		<div class="col-md-8">
			<div class="box box-primary">
		        <div class="box-header with-border">
		            <i class="fa fa-list"></i> <h3 class="box-title">List of Permissions</h3>
		        </div>
		        <div class="box-body">
					<button type="button" checked class="btn btn-default btn-sm checkbox-toggle">
						<i class="fa fa-square-o"></i>
					</button>
					<label for="">Check all [PROTOTYPE]</label>
		            <div class="nav-tabs-custom">
						<ul class="nav nav-tabs">
							<?php foreach ($role_permissions_data as $module): ?>
							<li class="<?php echo ($module['module_id'] == 1) ? 'active':''; ?>">
								<a href="#<?php echo strtoupper($module['module_name']); ?>" data-toggle="tab">
									<?php echo strtoupper($module['module_name']); ?>
								</a>
							</li>
							<?php endforeach ?>
						</ul>
						<div class="tab-content">
							<?php foreach ($role_permissions_data as $mkey => $module): ?>
								<div class="tab-pane fade in <?php echo ($module['module_id'] == 1) ? 'active':''; ?>" id="<?php echo strtoupper($module['module_name']); ?>" >
									<div class="box-body">
										<div class="box-group" id="accordion">
										<?php foreach ($module['module_functions'] as $mkey => $function): ?>
											<div class="panel box box-primary">
												<div class="box-header with-border">
													<h4 class="box-title">
														<a data-toggle="collapse" data-parent="#accordion" href="#<?php echo md5($function['function_id']); ?>">
															<?php echo $function['function_name']; ?>
														</a>
													</h4>
												</div>
												<div id="<?php echo md5($function['function_id']); ?>" class="panel-collapse collapse">
													<div class="box-body no-padding">
														<div class="table-responsive mailbox-messages">
															<table class="table table-hover table-striped">
																<tbody>
																	<?php if ( ! empty($function['permissions'])): ?>
																	<?php foreach ($function['permissions'] as $pkey => $permission): ?>
																		<tr>
																			<td><input type="checkbox" name="role_permission[<?php echo $permission->id; ?>]" id="role_permission_<?php echo $permission->id; ?>" value="<?php echo $permission->id; ?>"></td>
																			<td class="mailbox-star"><?php echo $permission->name; ?></td>
																		</tr>
																	<?php endforeach ?>
																	<?php else: ?>
																		<p class="text-center">No permission has been set on this function</p>
																	<?php endif ?>
																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										<?php endforeach ?>
										</div>
									</div>
								</div>
							<?php endforeach ?>
						</div>
			        </div>
		        </div>
		    </div>
		</div>
	</form>
</div>

