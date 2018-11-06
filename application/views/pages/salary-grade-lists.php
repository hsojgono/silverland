<div class="row">
<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Salary Grades</h3>
            <div class="box-tools pull-right">
                <a href="<?php echo site_url('salary_grades/load_form'); ?>" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#md-add-salary_grade"><i class="fa fa-plus"></i> Add Salary Grade</a>
            </div>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="datatables-salary_grades">
                    <thead>
                        <tr>
                            <th style="width: 300px;">Action</th>
                            <th>Company</th>
                            <th>Grade Code</th>
                            <th>Description</th>
                            <th>Minimum Salary</th>
                            <th>Maxmimum Salary</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ( ! empty($salary_grades)): ?>
                        <?php foreach ($salary_grades as $index => $salary_grade): ?>
                        <tr>
                            <td class="text-center">
                                <!-- <a href="<?php echo site_url('salary_grades/details/' . $salary_grade['id']); ?>" class="btn btn-link">
                                    <i class="fa fa-eye"></i> View
                                </a>
                                <a href="<?php echo site_url('salary_grades/confirmation/edit/' . $salary_grade['id']); ?>" class="btn btn-link" data-toggle="modal" data-target="#modal-confirmation-<?php echo $index; ?>">
                                    <i class="fa fa-edit"></i> Edit
                                </a> -->
                                <a href="<?php echo site_url('salary_grades/confirmation/' . $salary_grade['status_url'] . '/' . $salary_grade['id']); ?>" class="btn btn-link" data-toggle="modal" data-target="#modal-confirmation-<?php echo $index; ?>">
                                    <i class="fa <?php echo $salary_grade['status_icon']; ?>"></i> <?php echo $salary_grade['status_action']; ?>
                                </a>
                            </td>
                            <td class="text-left"><?php echo $salary_grade['company_name']; ?></td>
                            <td class="text-left"><?php echo $salary_grade['grade_code']; ?></td>
                            <td class="text-left"><?php echo $salary_grade['description']; ?></td>
                            <td class="text-left"><?php echo $salary_grade['minimum_salary']; ?></td>
                            <td class="text-left"><?php echo $salary_grade['maximum_salary']; ?></td>
							<td class="text-center"><?php echo $salary_grade['status_label']; ?></td>
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

        <div class="modal fade" id="md-add-salary_grade">
            <div class="modal-dialog">
                <div class="modal-content"></div>
            </div>
        </div>
        
        <?php if ($show_modal): ?>
            <div class="modal fade" id="modal-edit-salary_grade">
                <div class="modal-dialog">
                    <div class="modal-content"><?php $this->load->view($modal_file_path); ?></div>
                </div>
            </div>
            <script type="text/javascript">
                $(function() {
                    $('#modal-edit-salary_grade').modal({
                        backdrop: false,
                        keyboard: false
                    });
                });
            </script>
        <?php endif ?>
        
    </div>
</div>
</div>


