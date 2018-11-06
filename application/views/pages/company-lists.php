<div class="row">
    <div class="col-md-6">&nbsp;</div>

</div>
<br>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-list"></i> <h3 class="box-title">List of Companies</h3>
                <div class="pull-right">
                    <a href="<?php echo site_url('companies/add'); ?>" class="btn btn-primary">
                        <i class="fa fa-plus"></i>
                        <span>Add Company</span>
                    </a>
                </div>
            </div>
         
            <div class="box-body">
                <table class="table table-bordered table-striped table-hover" id="datatables-companies">
                    <thead>
                        <tr>
                            <th style="width: 150px;">&nbsp;</th>
                            <th class="text-left">Name</th>
                            <th class="text-left">Short Name</th>
                            <!-- <th class="text-left">Address</th> -->
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ( ! empty($companies)): ?>
                        <?php foreach ($companies as $company): ?>
                        <tr>
                            <td>
                                <a class="<?php echo $btn_view; ?>" href="<?php echo site_url('companies/details/' . $company['id']); ?>">
                                    <i class="fa fa-search" title="View <?php echo $company['name']; ?>" data-toggle="tooltip"></i>
                                </a>
                                <a class="<?php echo $btn_update; ?>" href="<?php echo site_url('companies/edit_confirmation/' . $company['id']); ?>" data-toggle="modal" data-target="#update-company-<?php echo md5($company['id']); ?>">
                                    <i class="fa fa-pencil-square-o" title="Edit <?php echo $company['name']; ?>" data-toggle="tooltip"></i> 
                                </a>
                                <a class="<?php echo $btn_update; ?>" href="<?php echo site_url('companies/update_status/' . $company['id']); ?>" data-toggle="modal" data-target="#update-company-status-<?php echo md5($company['id']); ?>">
                                    <!-- <i class="fa fa-cog" title="<?php echo $company['status_label']; ?>" data-toggle="tooltip"></i>  -->
                                    <i class="fa <?php echo $company['status_icon']; ?>" title="<?php echo $company['status_action']; ?> <?php echo $company['name']; ?>" data-toggle="tooltip"></i> 
                                </a>
                                
                            </td>
                            <!-- <td class="text-right"><?php echo $company['id']; ?></td> -->
                            <td class="text-left"><?php echo $company['name']; ?></td>
                            <td class="text-left"><?php echo $company['short_name']; ?></td>
                            <!-- <td class="text-left"><?php echo $company['full_address']; ?></td>						 -->
                            <td class="text-center"><?php echo $company['status_label']; ?></td>
                        </tr>
                        <div class="modal fade" id="update-company-status-<?php echo md5($company['id']); ?>" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content"></div>
                            </div>
                        </div>
                         <div class="modal fade" id="update-company-<?php echo md5($company['id']); ?>" role="dialog">
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

<!-- 

<script type="text/javascript">

    $($document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip({
            placement: 'right',
            title: "<h3>TEST</h3>",
            animation: true,
            html: true
        });
    });

</script> -->
