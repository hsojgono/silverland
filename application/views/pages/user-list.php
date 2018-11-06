
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<i class="fa fa-list"></i> <h3 class="box-title"><?php echo lang('index_subheading');?></h3>
			</div>
			<div class="box-body">
				<table class="table table-bordered table-striped table-hover" id="datatables-users">
					<thead>
						<tr>
							<th><?php echo lang('index_action_th');?></th>
							<th><?php echo lang('index_fname_th');?></th>
							<th><?php echo lang('index_lname_th');?></th>
							<th><?php echo lang('index_email_th');?></th>
							<th><?php echo lang('index_default_role_th');?></th>
						</tr>
					</thead>
					<?php foreach ($users as $user): ?>
					<tbody>
						<tr>
							<td>
								<a class="<?php echo $btn_update ?>" href="<?php echo site_url('users/confirmation/'.$user->id); ?>" data-toggle="modal" data-target="#update-user-status-<?php echo md5($user->id); ?>">
									<i class="fa fa-cog"></i> <?php echo ($user->active) ? 'De-activate' : 'Activate'; ?>
								</a>
							</td>
				            <td><?php echo htmlspecialchars($user->first_name, ENT_QUOTES, 'UTF-8');?></td>
				            <td><?php echo htmlspecialchars($user->last_name, ENT_QUOTES, 'UTF-8');?></td>
				            <td><?php echo htmlspecialchars($user->email, ENT_QUOTES, 'UTF-8');?></td>
							<td>
								<form action="<?php echo site_url('users/update_default_role/'); ?>" method="post" name="userRoleForm">
									<div class="input-group">
										<select class="form-control" name="user_role_id" onchange="this.form.submit()" <?php echo $has_permission['update_role']; ?>>
											<?php foreach ($user->groups as $group): ?>
											<option value="<?php echo $group->id; ?>" <?php echo ($group->default_status == 1) ? 'selected class="text-red"':''; ?>>
												<strong><?php echo strtoupper(htmlspecialchars($group->name,ENT_QUOTES,'UTF-8')); ?></strong>
											</option>
											<?php endforeach?>
										</select>
										<?php if ($has_permission['assign_role']): ?>
											<span class="input-group-btn">
												<a href="<?php echo site_url('users/assign_roles/'.$user->id); ?>" class="btn btn-default" data-toggle="modal" data-target="#modal-assign-roles-<?php echo md5($user->id); ?>">
													<i class="fa fa-plus"></i>
												</a>
											</span>
										<?php endif ?>
									</div>
									<input type="hidden" name="user_id" value="<?php echo $user->id; ?>">
								</form>
							</td>
						</tr>
					</tbody>
					<div class="modal fade" id="update-user-status-<?php echo md5($user->id); ?>">
						<div class="modal-dialog modal-md">
							<div class="modal-content"></div>
						</div>
					</div>
					<div class="modal fade" id="modal-assign-roles-<?php echo md5($user->id); ?>">
						<div class="modal-dialog">
							<div class="modal-content"></div>
						</div>
					</div>
					<?php endforeach; ?>
				</table>
			</div>
		</div>
	</div>
</div>

