<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-list"></i> <h3 class="box-title">List of Benefits</h3>
            <div class="pull-right">
            <a href="<?php echo site_url('benefits/add'); ?>" class="btn btn-primary">
                <i class="fa fa-plus"></i>
                <span>Add Benefit</span>
                 </a>
              </div>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped table-hover" id="datatables-benefits">
                    <thead>
                        <tr>
                            <th style="width: 120px;">&nbsp;</th>
                            <th class="text-left">Company</th>
                            <th class="text-left">Benefit Matrix</th>
                            <th class="text-left">Name</th>
                            <th class="text-left">Description</th>
                            <th class="text-left">Amount</th>
                            <th class="text-left">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ( ! empty($benefits)): ?>
                            <?php foreach ($benefits as $benefit): ?>
                                <tr>
                                    <td>
                                        <!-- <a class="<?php echo $btn_view; ?>" href="<?php echo site_url('benefits/details/' . $benefit['id']); ?>">
                                            <i class="fa fa-search"></i> View
                                        </a> -->
                                        <a href="<?php echo site_url('benefits/edit_confirmation/' . $benefit['id']); ?>" class="btn btn-link" data-toggle="modal" data-target="#update-benefit-<?php echo md5($benefit['id']); ?>">
                                            <i class="fa fa-pencil-square-o" title="Edit" data-toggle="tooltip"></i>
                                        </a>
                                        <a class="<?php echo $btn_update; ?>" href="<?php echo site_url('benefits/update_status/' . $benefit['id']); ?>" data-toggle="modal" data-target="#update-benefit-status-<?php echo md5($benefit['id']); ?>">
                                            <i class="fa <?php echo $benefit['status_icon']; ?>" title="<?php echo $benefit['status_action']; ?>" data-toggle="tooltip"></i> 
                                        </a>
                                    </td>
                                    <!-- <td class="text-right"><?php echo $benefit['id']; ?></td> -->
                                    <td class="text-left"><?php echo $benefit['company_name']; ?></td>
                                    <td class="text-right"><?php echo $benefit['effectivity_date']; ?></td>
                                    <td class="text-left"><?php echo $benefit['name']; ?></td>
                                    <td class="text-left"><?php echo $benefit['description']; ?></td>
                                    <td class="text-right"><?php echo $benefit['amount']; ?></td>
                                    <td class="text-center"><?php echo $benefit['status_label']; ?></td>
                                </tr>
                                <div class="modal fade" id="update-benefit-status-<?php echo md5($benefit['id']); ?>" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <!-- http://localhost/kawani_ci/roles/update_status/1 -->

                                        </div>
                                    </div>
                                </div>
                                 <div class="modal fade" id="update-benefit-<?php echo md5($benefit['id']); ?>" role="dialog">
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
