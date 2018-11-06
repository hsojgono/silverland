<div class="row">
<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Incentive Matrices</h3>
            <div class="box-tools pull-right">
                <a href="<?php echo site_url('incentive_matrices/load_form'); ?>" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#md-add-incentive_matrix"><i class="fa fa-plus"></i> Add Incentive Matrix</a>
            </div>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="datatables-incentive_matrices">
                    <thead>
                        <tr>
                            <th style="width: 300px;">Action</th>
                            <th>Effectivity Year</th>
                            <th>Description</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ( ! empty($incentive_matrices)): ?>
                        <?php foreach ($incentive_matrices as $index => $incentive_matrix): ?>
                        <tr>
                            <td>
                                <a href="<?php echo site_url('incentive_matrices/details/' . $incentive_matrix['id']); ?>" class="btn btn-link">
                                    <i class="fa fa-eye"></i> View
                                </a>
                                <a href="<?php echo site_url('incentive_matrices/confirmation/edit/' . $incentive_matrix['id']); ?>" class="btn btn-link" data-toggle="modal" data-target="#modal-confirmation-<?php echo $index; ?>">
                                    <i class="fa fa-edit"></i> Edit
                                </a>
                                <a href="<?php echo site_url('incentive_matrices/confirmation/' . $incentive_matrix['status_url'] . '/' . $incentive_matrix['id']); ?>" class="btn btn-link" data-toggle="modal" data-target="#modal-confirmation-<?php echo $index; ?>">
                                    <i class="fa <?php echo $incentive_matrix['status_icon']; ?>"></i> <?php echo $incentive_matrix['status_action']; ?>
                                </a>
                            </td>
                            <td class="text-left"><?php echo $incentive_matrix['year_effective']; ?></td>
                            <td class="text-left"><?php echo $incentive_matrix['description']; ?></td>
							<td class="text-center"><?php echo $incentive_matrix['status_label']; ?></td>
                        </tr>

                        <div class="modal fade" id="modal-confirmation-<?php echo $index; ?>">
                            <div class="modal-dialog">
                                <div class="modal-content"></div>
                            </div>
                        </div>
                        <?php endforeach ?>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- MODALS -->

        <div class="modal fade" id="md-add-incentive_matrix">
            <div class="modal-dialog">
                <div class="modal-content"></div>
            </div>
        </div>
        
        <?php if ($show_modal): ?>
            <div class="modal fade" id="modal-edit-incentive_matrix">
                <div class="modal-dialog">
                    <div class="modal-content"><?php $this->load->view($modal_file_path); ?></div>
                </div>
            </div>
            <script type="text/javascript">
                $(function() {
                    $('#modal-edit-incentive_matrix').modal({
                        backdrop: false,
                        keyboard: false
                    });
                });
            </script>
        <?php endif ?>
        
    </div>
</div>
</div>


