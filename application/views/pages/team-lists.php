<div class="row">
    <div class="col-md-6">&nbsp;</div>
    <div class="col-md-6">
        <div class="pull-right">
            <a href="<?php echo site_url('teams/add'); ?>" class="btn btn-primary">
                <i class="fa fa-plus"></i>
                <span>Add Team</span>
            </a>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-list"></i> <h3 class="box-title">List of Teams</h3>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped table-hover" id="datatables-teams">
                    <thead>
                        <tr>
                            <th style="width: 250px;">&nbsp;</th>
                            <!-- <th class="text-left">No.</th> -->
                            <th class="text-left">Team</th>
                            <th class="text-left">Description</th>
                            <!-- <th class="text-left">Company</th>
                            <th class="text-left">Branch</th>
                            <th class="text-left">Site</th>
                            <th class="text-left">Cost Center</th>
                            <th class="text-left">Department</th> -->
                            <th class="text-left">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ( ! empty($teams)): ?>
                            <?php foreach ($teams as $team): ?>
                                <tr>
                                    <td>
                                        <!-- <a class="<?php echo $btn_view; ?>" href="<?php echo site_url('teams/details/' . $team['id']); ?>">
                                            <i class="fa fa-search"></i> View
                                        </a> -->
                                        <a class="<?php echo $btn_update; ?>" href="<?php echo site_url('teams/edit_confirmation/' . $team['id']); ?>" data-toggle="modal" data-target="#update-team-<?php echo md5($team['id']); ?>">
                                            <i class="fa fa-pencil-square-o"></i> Edit
                                        </a>
                                       <a class="<?php echo $btn_update; ?>" href="<?php echo site_url('teams/update_status/' . $team['id']); ?>" data-toggle="modal" data-target="#update-team-status-<?php echo md5($team['id']); ?>">
                                            <i class="fa fa-cog"></i> <?php echo $team['status_label']; ?>
                                        </a>                                          
                                    </td>
                                    <!-- <td class="text-right"><?php echo $team['id']; ?></td> -->
                                    <td class="text-left"><?php echo $team['name']; ?></td>
                                    <td class="text-left"><?php echo $team['description']; ?></td>
                                    <td class="text-center"><?php echo $team['status_color']; ?></td>
                                </tr>
                                <div class="modal fade" id="update-team-status-<?php echo md5($team['id']); ?>" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <!-- http://localhost/kawani_ci/roles/update_status/1 -->
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="update-team-<?php echo md5($team['id']); ?>" role="dialog">
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
