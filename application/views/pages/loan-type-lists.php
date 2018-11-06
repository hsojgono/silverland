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
                <i class="fa fa-list"></i> <h3 class="box-title">List of Loan Types</h3>
            <div class="pull-right">
            <a href="<?php echo site_url('loan_types/add'); ?>" class="btn btn-primary">
                <i class="fa fa-plus"></i>
                <span>Add Loan Type</span>
                 </a>
              </div>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped table-hover" id="datatables-loan-types">
                    <thead>
                        <tr>
                            <th style="width: 120px;">&nbsp;</th>
                            <th class="text-left">Name</th>
                            <!-- <th class="text-left">Limit</th> -->
                            <th class="text-left">Interest Per Month</th>
                            <th class="text-left">Frequency</th>
                            <th class="text-left">Description</th>
                            <th class="text-left">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ( ! empty($loan_types)): ?>
                            <?php foreach ($loan_types as $loan_type): ?>
                                <tr>
                                    <td>
                                        <!-- <a class="<?php echo $btn_view; ?>" href="<?php echo site_url('loan_types/details/' . $loan_type['id']); ?>">
                                            <i class="fa fa-search"></i> View
                                        </a> -->
                                        <a href="<?php echo site_url('loan_types/edit_confirmation/' . $loan_type['id']); ?>" class="btn btn-link" data-toggle="modal" data-target="#update-loan_type-<?php echo md5($loan_type['id']); ?>">
                                            <i class="fa fa-pencil-square-o" title="Edit" data-toggle="tooltip"></i>
                                        </a>
                                        <a class="<?php echo $btn_update; ?>" href="<?php echo site_url('loan_types/update_status/' . $loan_type['id']); ?>" data-toggle="modal" data-target="#update-loan_type-status-<?php echo md5($loan_type['id']); ?>">
                                            <i class="fa <?php echo $loan_type['status_icon']; ?>" title="<?php echo $loan_type['status_action']; ?>" data-toggle="tooltip"></i> 
                                        </a>
                                    </td>
                                    <td class="text-left"><?php echo $loan_type['name']; ?></td>
                                    <!-- <td class="text-right"><?php echo $loan_type['loan_limit']; ?></td> -->
                                    <td class="text-right"><?php echo $loan_type['interest_per_month'] * 100 . '%'; ?></td>
                                    <td class="text-right"><?php echo $loan_type['frequency']; ?></td>
                                    <td class="text-left"><?php echo $loan_type['description']; ?></td>
                                    <td class="text-center"><?php echo $loan_type['status_label']; ?></td>
                                </tr>
                                <div class="modal fade" id="update-loan_type-status-<?php echo md5($loan_type['id']); ?>" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <!-- http://localhost/kawani_ci/roles/update_status/1 -->

                                        </div>
                                    </div>
                                </div>
                                 <div class="modal fade" id="update-loan_type-<?php echo md5($loan_type['id']); ?>" role="dialog">
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

<script type="text/javascript">

	$(document).ready(function() {
		$('#datatables-loan-types').DataTable();
	});
	
</script>
