<div class="row">
    <div class="col-md-6">&nbsp;</div>
    <div class="col-md-6">
        <div class="pull-right">
            <a href="<?php echo site_url('attachment_types/add'); ?>" class="btn btn-primary">
                <i class="fa fa-plus"></i>
                <span>Add Attachment Type</span>
            </a>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-list"></i> <h3 class="box-title">List of Attachment Types</h3>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped table-hover" id="datatables-attachment_types">
                    <thead>
                        <tr>
                            <th style="width: 350px;">&nbsp;</th>
                            <th class="text-left">Name</th>
                            <th class="text-left">Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ( ! empty($attachment_types)): ?>
                            <?php foreach ($attachment_types as $attachment_type): ?>
                                <tr>
                                    <td>
                                        <a class="<?php echo $btn_view; ?>" href="<?php echo site_url('attachment_types/details/' . $attachment_type['id']); ?>">
                                            <i class="fa fa-eye"></i> View
                                        </a>
                                        <a class="<?php echo $btn_update; ?>" href="<?php echo site_url('attachment_types/edit_confirmation/' . $attachment_type['id']); ?>" data-toggle="modal" data-target="#update-attachment_type-<?php echo md5($attachment_type['id']); ?>">
                                            <i class="fa fa-pencil-square-o"></i> Edit
                                        </a>
                                         <a class="<?php echo $btn_update; ?>" href="<?php echo site_url('attachment_types/update_status/' . $attachment_type['id']); ?>" data-toggle="modal" data-target="#update-attachment_type-status-<?php echo md5($attachment_type['id']); ?>">
                                            <i class="fa fa-cog"></i> <?php echo $attachment_type['status_label']; ?>
                                        </a>
                                    </td>
                                    <!-- <td class="text-right"><?php echo $attachment_type['id']; ?></td> -->
                                    <td class="text-left"><?php echo $attachment_type['name']; ?></td>
                                    <td class="text-left"><?php echo $attachment_type['description']; ?></td>                                </tr>
                                <div class="modal fade" id="update-attachment_type-status-<?php echo md5($attachment_type['id']); ?>" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <!-- http://localhost/kawani_ci/roles/update_status/1 -->

                                        </div>
                                    </div>
                                </div>
                                 <div class="modal fade" id="update-attachment_type-<?php echo md5($attachment_type['id']); ?>" role="dialog">
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
