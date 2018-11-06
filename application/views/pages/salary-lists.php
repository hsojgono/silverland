<div class="row">
<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Salaries</h3>
            <div class="box-tools pull-right">
                <a href="<?php echo site_url('salaries/load_form'); ?>" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#md-add-salary"><i class="fa fa-plus"></i> Add Salary</a>
            </div>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="datatables-salaries">
                    <thead>
                        <tr>
                            <th style="width: 300px;">Action</th>
                            <th>Salary Matrix</th>
                            <th>Monthly Salary</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ( ! empty($salaries)): ?>
                        <?php foreach ($salaries as $index => $salary): ?>
                        <tr>
                            <td>
                                <a href="<?php echo site_url('salaries/details/' . $salary['id']); ?>" class="btn btn-link">
                                    <i class="fa fa-eye"></i> View
                                </a>
                                <a href="<?php echo site_url('salaries/confirmation/edit/' . $salary['id']); ?>" class="btn btn-link" data-toggle="modal" data-target="#modal-confirmation-<?php echo $index; ?>">
                                    <i class="fa fa-edit"></i> Edit
                                </a>
                                <a href="<?php echo site_url('salaries/confirmation/' . $salary['status_url'] . '/' . $salary['id']); ?>" class="btn btn-link" data-toggle="modal" data-target="#modal-confirmation-<?php echo $index; ?>">
                                    <i class="fa <?php echo $salary['status_icon']; ?>"></i> <?php echo $salary['status_action']; ?>
                                </a>
                            </td>
                            <td class="text-left"><?php echo $salary['salary_matrix_desc']; ?></td>
                            <td class="text-right"><?php echo $salary['monthly_salary']; ?></td>
							<td class="text-center"><?php echo $salary['status_label']; ?></td>
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

        <div class="modal fade" id="md-add-salary">
            <div class="modal-dialog">
                <div class="modal-content"></div>
            </div>
        </div>
        
        <?php if ($show_modal): ?>
            <div class="modal fade" id="modal-edit-salary">
                <div class="modal-dialog">
                    <div class="modal-content"><?php $this->load->view($modal_file_path); ?></div>
                </div>
            </div>
            <script type="text/javascript">
                $(function() {
                    $('#modal-edit-salary').modal({
                        backdrop: false,
                        keyboard: false
                    });
                });
            </script>
        <?php endif ?>
        
    </div>
</div>
</div>


