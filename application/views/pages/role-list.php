<div class="row">
    <div class="col-md-6">&nbsp;</div>
    <div class="col-md-6">
        <div class="pull-right">
            <a href="<?php echo site_url('roles/add'); ?>" class="<?php echo $btn_add; ?>">
                <i class="fa fa-plus"></i>
                <span>Add New Role</span>
            </a>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-list"></i> <h3 class="box-title">List of Roles</h3>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped table-hover" id="datatables-default">
                    <thead>
                        <tr>
                            <th style="width: 250px;">&nbsp;</th>
                            <th class="text-center">ID</th>
                            <th class="text-left">Name</th>
                            <th class="text-left">Description</th>
                            <!-- <th class="text-left">Created</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ( ! empty($roles)): ?>
                            <?php foreach ($roles as $role): ?>
                                <tr>
                                    <td>
                                        <a class="<?php echo $btn_view; ?>" href="<?php echo site_url('roles/details/' . $role['id']); ?>">
                                            <i class="fa fa-search"></i> View
                                        </a>
                                        <a class="<?php echo $btn_update; ?> <?php echo ($role['id'] == 1) ? 'disabled text-grey':''; ?>" href="<?php echo site_url('roles/edit/' . $role['id']); ?>">
                                            <i class="fa fa-pencil-square-o"></i> Edit
                                        </a>
                                        <a class="<?php echo $btn_update; ?> <?php echo ($role['id'] == 1) ? 'disabled text-grey':''; ?>" href="<?php echo site_url('roles/update_status/' . $role['id']); ?>" data-toggle="modal" data-target="#update-role-status-<?php echo md5($role['id']); ?>">
                                            <i class="fa fa-cog"></i> <?php echo $role['status_label']; ?>
                                        </a>
                                    </td>
                                    <td class="text-center"><?php echo $role['id']; ?></td>
                                    <td class="text-left>"<?php echo $role['name']; ?></td>
                                    <td class="text-left"><?php echo $role['description']; ?></td>
                                    <!-- <td class="text-left"><?php echo $role['created']; ?></td> -->
                                </tr>
                                <div class="modal fade" id="update-role-status-<?php echo md5($role['id']); ?>" role="dialog">
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
    </div>
</div>
