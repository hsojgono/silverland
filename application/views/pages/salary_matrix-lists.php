<div class="row">
<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Salary Matrices</h3>
            <div class="box-tools pull-right">
                <a href="<?php echo site_url('salary_matrices/load_form'); ?>" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#md-add-salary-matrix"><i class="fa fa-plus"></i> Add Salary Matrix</a>
            </div>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="datatables-salary-matrix">
                    <thead>
                        <tr>
                            <th style="width: 300px;">Action</th>
                            <th>Company</th>
                            <th>Date Effective</th>
                            <th>Description</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ( ! empty($salary_matrices)): ?>
                        <?php foreach ($salary_matrices as $index => $salary_matrix): ?>
                        <tr>
                            <td class="text-center">
                                <a href="<?php echo site_url('salary_matrices/details/' . $salary_matrix['id']); ?>" class="btn btn-link">
                                    <i class="fa fa-eye"></i> View
                                </a>
                                <a href="<?php echo site_url('salary_matrices/confirmation/edit/' . $salary_matrix['id']); ?>" class="btn btn-link" data-toggle="modal" data-target="#modal-confirmation-<?php echo $index; ?>">
                                    <i class="fa fa-edit"></i> Edit
                                </a>
                                <a href="<?php echo site_url('salary_contribution_matrix/confirmation/' . $salary_matrix['status_url'] . '/' . $salary_matrix['id']); ?>" class="btn btn-link" data-toggle="modal" data-target="#modal-confirmation-<?php echo $index; ?>">
                                    <i class="fa <?php echo $salary_matrix['status_icon']; ?>"></i> <?php echo $salary_matrix['status_action']; ?>
                                </a>
                            </td>
                            <td class="text-left"><?php echo $salary_matrix['company_name']; ?></td>
                            <td class="text-right"><?php echo $salary_matrix['effectivity_date']; ?></td>
                            <td class="text-left"><?php echo $salary_matrix['description']; ?></td>
                            <td class="text-center"><?php echo $salary_matrix['status_label']; ?></td>
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
        <div class="modal fade" id="md-add-salary-matrix">
            <div class="modal-dialog">
                <div class="modal-content"></div>
            </div>
        </div>
        
        <?php if ($show_modal): ?>
            <div class="modal fade" id="modal-edit-salary-matrix">
                <div class="modal-dialog">
                    <div class="modal-content"><?php $this->load->view($modal_file_path); ?></div>
                </div>
            </div>
            <script type="text/javascript">
                $(function() {
                    $('#modal-edit-salary-matrix').modal({
                        backdrop: false,
                        keyboard: false
                    });
                });
            </script>
        <?php endif ?>
        
    </div>
</div>
</div>


