<div class="row">
    <div class="col-md-6">&nbsp;</div>
    <div class="col-md-6">
        <div class="pull-right">
            <a href="<?php echo site_url('leave_types/add'); ?>" class="btn btn-primary">
                <i class="fa fa-plus"></i>
                <span>Add Leave Type</span>
            </a>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-list"></i> <h3 class="box-title">List of Leave Types</h3>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped table-hover" id="datatables-leave_types">
                    <thead>
                        <tr>
                            <th style="width: 250px;">Action</th>
                            <th class="text-left">Name</th>
                            <th class="text-left">Description</th>
                            <th class="text-left">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ( ! empty($leave_types)): ?>
                            <?php foreach ($leave_types as $leave_type): ?>
                                <tr>
                                    <td>
                                        <!-- <a class="<?php echo $btn_view; ?>" href="<?php echo site_url('leave_types/details/' . $leave_type['id']); ?>">
                                            <i class="fa fa-eye"></i> View
                                        </a> -->
                                        <a class="<?php echo $btn_update; ?>" href="<?php echo site_url('leave_types/edit_confirmation/' . $leave_type['id']); ?>" data-toggle="modal" data-target="#update-leave_type-<?php echo md5($leave_type['id']); ?>">
                                            <i class="fa fa-pencil-square-o"></i> Edit
                                        </a>
                                        <a class="<?php echo $btn_update; ?>" href="<?php echo site_url('leave_types/update_status/' . $leave_type['id']); ?>" data-toggle="modal" data-target="#update-leave_type-status-<?php echo md5($leave_type['id']); ?>">
                                        <i class="fa fa-cog"></i> <?php echo $leave_type['status_label']; ?>
                                    </a>  
                                    </td>
                                    <td class="text-left"><?php echo $leave_type['name']; ?></td>
                                    <td class="text-left"><?php echo $leave_type['description']; ?></td>
                                    <td class="text-center"><?php echo $leave_type['active_status']; ?></td>
                                </tr>
                                <div class="modal fade" id="update-leave_type-<?php echo md5($leave_type['id']); ?>" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <!-- http://localhost/kawani_ci/roles/update_status/1 -->
                                            
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="modal fade" id="update-leave_type-status-<?php echo md5($leave_type['id']); ?>" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <!-- http://localhost/kawani_ci/roles/update_status/1 -->

                                        </div>
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
