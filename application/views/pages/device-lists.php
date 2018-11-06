<div class="row">
    <div class="col-md-6">&nbsp;</div>
    <div class="col-md-6">
        <div class="pull-right">
            <a href="<?php echo site_url('devices/add'); ?>" class="btn btn-primary">
                <i class="fa fa-plus"></i>
                <span>Add Devices</span>
            </a>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-list"></i> <h3 class="box-title">List of Devices</h3>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped table-hover" id="datatables-devices">
                    <thead>
                        <tr>
                            <th style="width: 350px;">&nbsp;</th>
                            <th class="text-left">Name</th>
                            <th class="text-left">Description</th>
                            <th class="text-left">IP Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ( ! empty($devices)): ?>
                            <?php foreach ($devices as $device): ?>
                                <tr>
                                    <td>
                                        <a class="<?php echo $btn_view; ?>" href="<?php echo site_url('devices/details/' . $device['id']); ?>">
                                            <i class="fa fa-eye"></i> View
                                        </a>
                                        <a class="<?php echo $btn_update; ?>" href="<?php echo site_url('devices/edit_confirmation/' . $device['id']); ?>" data-toggle="modal" data-target="#update-device-<?php echo md5($device['id']); ?>">
                                            <i class="fa fa-pencil-square-o"></i> Edit
                                        </a>
                                         <a class="<?php echo $btn_update; ?>" href="<?php echo site_url('devices/update_status/' . $device['id']); ?>" data-toggle="modal" data-target="#update-device-status-<?php echo md5($device['id']); ?>">
                                            <i class="fa fa-cog"></i> <?php echo $device['status_label']; ?>
                                        </a>
                                    </td>
                                    <!-- <td class="text-right"><?php echo $device['id']; ?></td> -->
                                    <td class="text-left"><?php echo $device['name']; ?></td>
                                    <td class="text-left"><?php echo $device['description']; ?></td>        
                                    <td class="text-left"><?php echo $device['ip_address']; ?></td>                            </tr>
                                <div class="modal fade" id="update-device-status-<?php echo md5($device['id']); ?>" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <!-- http://localhost/kawani_ci/roles/update_status/1 -->

                                        </div>
                                    </div>
                                </div>
                                 <div class="modal fade" id="update-device-<?php echo md5($device['id']); ?>" role="dialog">
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
