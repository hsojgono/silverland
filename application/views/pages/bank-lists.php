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
                <i class="fa fa-list"></i> <h3 class="box-title">List of Banks</h3>
            <div class="pull-right">
            <a href="<?php echo site_url('banks/add'); ?>" class="btn btn-primary">
                <i class="fa fa-plus"></i>
                <span>Add Bank</span>
                 </a>
              </div>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped table-hover" id="datatables-banks">
                    <thead>
                        <tr>
                            <th style="width: 75px;">&nbsp;</th>
                            <th class="text-left">Name</th>
                            <th class="text-left">Contact Person</th>
                            <th class="text-left">Contact Number</th>
                            <th class="text-left">Description</th>
                            <th class="text-left">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ( ! empty($banks)): ?>
                            <?php foreach ($banks as $bank): ?>
                                <tr>
                                    <td>
                                        <!-- <a class="<?php echo $btn_view; ?>" href="<?php echo site_url('banks/details/' . $bank['id']); ?>">
                                            <i class="fa fa-search"></i> View
                                        </a> -->
                                        <a href="<?php echo site_url('banks/edit_confirmation/' . $bank['id']); ?>" class="btn btn-link" data-toggle="modal" data-target="#update-bank-<?php echo md5($bank['id']); ?>">
                                            <i class="fa fa-pencil-square-o" title="Edit <?php echo $bank['name']; ?>" data-toggle="tooltip"></i>
                                        </a>
                                        <a class="<?php echo $btn_update; ?>" href="<?php echo site_url('banks/update_status/' . $bank['id']); ?>" data-toggle="modal" data-target="#update-bank-status-<?php echo md5($bank['id']); ?>">
                                            <i class="fa <?php echo $bank['status_icon']; ?>" title="<?php echo $bank['status_action']; ?> <?php echo $bank['name']; ?>" data-toggle="tooltip"></i> 
                                        </a>
                                    </td>
                                    <!-- <td class="text-right"><?php echo $bank['id']; ?></td> -->
                                    <td class="text-left"><?php echo $bank['name']; ?></td>
                                    <td class="text-left"><?php echo $bank['contact_person']; ?></td>
                                    <td class="text-right"><?php echo $bank['contact_number']; ?></td>
                                    <td class="text-left"><?php echo $bank['description']; ?></td>
                                    <td class="text-center"><?php echo $bank['status_label']; ?></td>
                                </tr>
                                <div class="modal fade" id="update-bank-status-<?php echo md5($bank['id']); ?>" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <!-- http://localhost/kawani_ci/roles/update_status/1 -->

                                        </div>
                                    </div>
                                </div>
                                 <div class="modal fade" id="update-bank-<?php echo md5($bank['id']); ?>" role="dialog">
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
