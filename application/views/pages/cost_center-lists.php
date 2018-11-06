<div class="row">
    <div class="col-md-6">&nbsp;</div>
    <div class="col-md-6">
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                    <i class="fa fa-list"></i> <h3 class="box-title">List of Cost Centers</h3>
            <div class="pull-right">
                <a href="<?php echo site_url('cost_centers/add'); ?>" class="btn btn-primary">
                    <i class="fa fa-plus"></i>
                    <span>Add Cost Center</span>
                </a>
            </div>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped table-hover" id="datatables-cost_centers">
                    <thead>
                        <tr>
                            <th style="width: 75px;">&nbsp;</th>
                            <!-- <th class="text-left">No.</th> -->
                            <th class="text-left">Name</th>
                            <th class="text-left">Description</th>
                            <th class="text-left">Company</th>
                            <th class="text-left">Branch</th>
                            <th class="text-left">Department</th>
                            <th class="text-left">Team</th>
                            <th class="text-left">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ( ! empty($cost_centers)): ?>
                            <?php foreach ($cost_centers as $cost_center): ?>
                                <tr>
                                    <td>
                                        <!-- <a class="<?php echo $btn_view; ?>" href="<?php echo site_url('cost_centers/details/' . $cost_center['id']); ?>">
                                            <i class="fa fa-search"></i> View
                                        </a> -->
                                        <a href="<?php echo site_url('cost_centers/edit_confirmation/' . $cost_center['id']); ?>" class="btn btn-link" data-toggle="modal" data-target="#update-cost_center-<?php echo md5($cost_center['id']); ?>">
                                            <i class="fa fa-pencil-square-o" title="Edit <?php echo $cost_center['name']; ?>" data-toggle="tooltip"></i>
                                        </a>
                                        <a class="<?php echo $btn_update; ?>" href="<?php echo site_url('cost_centers/update_status/' . $cost_center['id']); ?>" data-toggle="modal" data-target="#update-cost_center-status-<?php echo md5($cost_center['id']); ?>">
                                        <i class="fa <?php echo $cost_center['status_icon']; ?>" title="<?php echo $cost_center['status_action']; ?> <?php echo $cost_center['name']; ?>" data-toggle="tooltip"></i> 
                                        </a>
                                    </td>
                                    <!-- <td class="text-right"><?php echo $cost_center['id']; ?></td> -->
                                    <td class="text-left"><?php echo $cost_center['name']; ?></td>
                                    <td class="text-left"><?php echo $cost_center['description']; ?></td>
                                    <td class="text-left"><?php echo $cost_center['company_name']; ?></td>
                                    <td class="text-left"><?php echo $cost_center['branch_name']; ?></td>
                                    <td class="text-left"><?php echo $cost_center['department_name']; ?></td>
                                    <td class="text-left"><?php echo $cost_center['team_name']; ?></td>
                                    <td class="text-center"><?php echo $cost_center['status_label']; ?></td>
                                </tr>
                                <div class="modal fade" id="update-cost_center-status-<?php echo md5($cost_center['id']); ?>" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <!-- http://localhost/kawani_ci/roles/update_status/1 -->

                                        </div>
                                    </div>
                                </div>
                                 <div class="modal fade" id="update-cost_center-<?php echo md5($cost_center['id']); ?>" role="dialog">
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
