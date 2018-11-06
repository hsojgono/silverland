<div class="row">
    <!-- <div class="col-md-4">
		<div class="box box-primary">
			<div class="box box-solid">
				<div class="box-header with-border">
					<h3 class="box-title"><?php echo ucwords($role_data['name']); ?></h3>
					<div class="box-tools">
						<button type="button" class="btn btn-box-tool" data-widget="collapse">
							<i class="fa fa-minus"></i>
						</button>
					</div>
				</div>
				<div class="box-body no-padding">
					<ul class="nav nav-pills nav-stacked">
						<li class="">
							<a href="javascript:void(0);">
								<i class="fa fa-clock-o"></i> Employees <span class="label pull-right pending_color" id="totalPending">1</span>
							</a>
						</li>
						<li class="">
							<a href="javascript:void(0);">
								<i class="fa fa-thumbs-up"></i> Modules <span class="label pull-right approved_color" id="totalApproved">2</span>
							</a>
						</li>
						<li class="">
							<a href="javascript:void(0);">
								<i class="fa fa-thumbs-down" ></i> Functions <span class="label pull-right rejected_color" id="totalDenied">3</span>
							</a>
						</li>
						<li class="">
							<a href="javascript:void(0);">
								<i class="fa fa-times-circle"></i> Permissions <span class="label pull-right cancelled_color" id="totalCancelled">4</span>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
    </div> -->

    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
				<li class="dropdown active">
					<a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0);">
						Role Permissions <span class="caret"></span>
					</a>
					<ul class="dropdown-menu multi-level" role="menu" arialabelledby="dropdownMenu">
						<?php foreach ($modules as $module): ?>
						<li class="dropdown-submenu" id="function-menu">
							<a tabindex="-1" href="javascript:void(0);">
								<?php echo $module->name; ?>
							</a>
							<ul class="dropdown-menu" id="tabtest">
								<?php foreach ($functions as $function): ?>
								<?php if ($module->id == $function->system_module_id): ?>
								<li class="">
									<a data-toggle="tab" href="#role-permission-<?php echo md5($function->name); ?>">
										<?php echo $function->name; ?>
									</a>
								</li>
								<?php endif ?>
								<?php endforeach ?>
							</ul>
						</li>
						<?php endforeach ?>
					</ul>
				</li>
                <!-- <li class="">
                    <a href="#employees" data-toggle="tab">Employees</a>
                </li> -->
            </ul>
            <div class="tab-content">
				<?php foreach ($functions as $function): ?>
				<div class="tab-pane fade in <?php echo ($function->id == 1) ? 'active' : ''; ?>" id="role-permission-<?php echo md5($function->name); ?>">
					<h3><?php echo $function->name; ?></h3>
					<table class="table table-bordered table-striped table-hover">
						<thead>
							<tr>
								<th class="text-center">#</th>
								<th class="text-center">Has Access?</th>
								<th class="text-center">Name</th>
							</tr>
						</thead>
						<tbody>
						<?php $checker = FALSE; ?>
						<?php foreach ($role_permissions as $role_permission): ?>
						<?php if ($role_permission['system_function_id'] == $function->id): ?>
							<?php $checker = TRUE; ?>
							<tr>
								<td class="text-center"><?php echo $role_permission['id']; ?></td>
								<td class="text-center">
									<a href="<?php echo site_url('role_permissions/update_status/'.$role_permission['id']); ?>" data-toggle="modal" data-target="#update-role-permission-<?php echo md5($role_permission['id']); ?>">
										<?php echo $role_permission['status']; ?>
									</a>
								</td>
								<td class="text-left"><?php echo $role_permission['system_permission_name']; ?></td>
								<div class="modal fade" id="update-role-permission-<?php echo md5($role_permission['id']); ?>" role="dialog">
									<div class="modal-dialog">
										<!-- Modal content-->
										<div class="modal-content"></div>
									</div>
								</div>
							</tr>
						<?php endif ?>
						<?php endforeach ?>
						<?php if (!$checker): ?>
							<tr>
								<td colspan="3" class="text-center">No record match found!</td>
							</tr>
						<?php endif ?>
						</tbody>
					</table>
				</div>
				<?php endforeach ?>

                <div class="tab-pane fade in" id="employees">
                    <table class="table table-bordered table-striped table-hover" id="">
                        <thead>
                            <tr>
                                <th class="text-left">Header</th>
                                <th class="text-left">Header</th>
                                <th class="text-left">Header</th>
                                <th class="text-left">Header</th>
                                <th class="text-left">Header</th>
                                <th class="text-left">Header</th>
                                <th class="text-left">Header</th>
                                <th class="text-left">Header</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-left">TAB 2 DATA</td>
                                <td class="text-left">TAB 2 DATA</td>
                                <td class="text-left">TAB 2 DATA</td>
                                <td class="text-left">TAB 2 DATA</td>
                                <td class="text-left">TAB 2 DATA</td>
                                <td class="text-left">TAB 2 DATA</td>
                                <td class="text-left">TAB 2 DATA</td>
                                <td class="text-left">TAB 2 DATA</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="tab-pane fade in" id="test1">
                    <h3>test1</h3>
                </div>
                <div class="tab-pane fade in" id="test2">
                    <h3>test2</h3>
                </div>
                <div class="tab-pane fade in" id="test3">
                    <h3>test3</h3>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
	$('#function-menu > ul.dropdown-menu li').on('click', function (evt) {

		evt.preventDefault();

		// $('#function-menu > ul.dropdown-menu li').removeClass('active');
		// $(this).addClass('active');
	});
</script>
