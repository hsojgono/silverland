<!-- <div class="row">
    <div class="col-md-6">&nbsp;</div>
    <div class="col-md-6">
        <div class="pull-right">
            <a href="<?php echo site_url('departments/add'); ?>" class="btn btn-primary">
                <i class="fa fa-plus"></i>
                <span>Add Department</span>
            </a>
        </div>
    </div>
</div> -->
<br>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-list"></i> <h3 class="box-title">List of Departments</h3>
                <div class="pull-right">
                    <a href="<?php echo site_url('departments/add'); ?>" class="btn btn-primary">
                        <i class="fa fa-plus"></i>
                        <span>Add Department</span>
                    </a>
                </div>                
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped table-hover" id="datatables-departments">
                    <thead>
                        <tr>
                            <th style="width: 120px;">&nbsp;</th>
                            <th class="text-left">Department</th>
                            <th class="text-left">Description</th>
                            <th class="text-left">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ( ! empty($departments)): ?>
                            <?php foreach ($departments as $department): ?>
                                <tr>
                                    <td>
                                        <a class="<?php echo $btn_view; ?>" href="<?php echo site_url('departments/details/' . $department['id']); ?>">
                                            <i class="fa fa-eye" title="View" data-toggle="tooltip"></i>
                                        </a>
                                        <a class="<?php echo $btn_update; ?>" href="<?php echo site_url('departments/edit/' . $department['id']); ?>">
                                            <i class="fa fa-pencil-square-o" title="Edit" data-toggle="tooltip"></i>
                                        </a>
                                       <a class="<?php echo $btn_update; ?>" href="<?php echo site_url('departments/update_status/' . $department['id']); ?>" data-toggle="modal" data-target="#update-department-status-<?php echo md5($department['id']); ?>">
                                            <i class="fa <?php echo $department['status_icon']; ?>" title="<?php echo $department['status_action']; ?>" data-toggle="tooltip"></i> 
                                        </a>                                          
                                    </td>
                                    <!-- <td class="text-right"><?php echo $department['id']; ?></td> -->
                                    <td class="text-left"><?php echo $department['name']; ?></td>
                                    <td class="text-left"><?php echo $department['description']; ?></td>
                                    <td class="text-center"><?php echo $department['status_label']; ?></td>
                                </tr>
                                <div class="modal fade" id="update-department-status-<?php echo md5($department['id']); ?>" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <!-- http://localhost/kawani_ci/roles/update_status/1 -->
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="update-department-<?php echo md5($department['id']); ?>" role="dialog">
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
