<div class="row">
    <div class="col-md-6">&nbsp;</div>
    <div class="col-md-6">
        <div class="pull-right">
            <a href="<?php echo site_url('holiday_types/add'); ?>" class="btn btn-primary">
                <i class="fa fa-plus"></i>
                <span>Add Holiday Type</span>
            </a>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-list"></i> <h3 class="box-title">List of Holiday Types</h3>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped table-hover" id="datatables-holiday_types">
                    <thead>
                        <tr>
                            <th style="width: 250px;">&nbsp;</th>
                            <th class="text-left">Company</th>
                            <th class="text-left">Name</th>
                            <th class="text-left">Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ( ! empty($holiday_types)): ?>
                            <?php foreach ($holiday_types as $holiday_type): ?>
                                <tr>
                                    <td>
                                        <a class="<?php echo $btn_view; ?>" href="<?php echo site_url('holiday_types/details/' . $holiday_type['id']); ?>">
                                            <i class="fa fa-search"></i> View
                                        </a>
                                        <a class="<?php echo $btn_update; ?>" href="<?php echo site_url('holiday_types/edit_confirmation/' . $holiday_type['id']); ?>" data-toggle="modal" data-target="#update-holiday_type-<?php echo md5($holiday_type['id']); ?>">
                                            <i class="fa fa-pencil-square-o"></i> Edit
                                        </a>
                                         <a class="<?php echo $btn_update; ?>" href="<?php echo site_url('holiday_types/update_status/' . $holiday_type['id']); ?>" data-toggle="modal" data-target="#update-holiday_type-status-<?php echo md5($holiday_type['id']); ?>">
                                            <i class="fa fa-cog"></i> <?php echo $holiday_type['status_label']; ?>
                                        </a>
                                    </td>
                                    <!-- <td class="text-right"><?php echo $holiday_type['id']; ?></td> -->
                                    <td class="text-left"><?php echo $holiday_type['company_name']; ?></td>
                                    <td class="text-left"><?php echo $holiday_type['name']; ?></td>
                                    <td class="text-left"><?php echo $holiday_type['description']; ?></td>
                                </tr>
                                <div class="modal fade" id="update-holiday_type-status-<?php echo md5($holiday_type['id']); ?>" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <!-- http://localhost/kawani_ci/roles/update_status/1 -->

                                        </div>
                                    </div>
                                </div>
                                 <div class="modal fade" id="update-holiday_type-<?php echo md5($holiday_type['id']); ?>" role="dialog">
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
