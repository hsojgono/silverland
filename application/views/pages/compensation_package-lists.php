<div class="row">
<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Compensation Packages</h3>
            <div class="box-tools pull-right">
                <a href="<?php echo site_url('compensation_packages/load_form'); ?>" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#md-add-compensation_package"><i class="fa fa-plus"></i> Add Compensation Package</a>
            </div>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="datatables-compensation_packages">
                    <thead>
                        <tr>
                            <th style="width: 80px;">Action</th>
                            <th>Position</th>
                            <th>Salary</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ( ! empty($compensation_packages)): ?>
                        <?php foreach ($compensation_packages as $index => $compensation_package): ?>
                        <tr>
                            <td>
                                <!-- <a href="<?php echo site_url('compensation_packages/details/' . $compensation_package['compensation_package_id']); ?>" class="btn btn-link">
                                    <i class="fa fa-eye"></i> View
                                </a> -->
                                <a href="<?php echo site_url('compensation_packages/confirmation/edit/' . $compensation_package['compensation_package_id']); ?>" class="btn btn-link" data-toggle="modal" data-target="#modal-confirmation-<?php echo $index; ?>">
                                    <i class="fa fa-edit" title="Edit" data-toggle="tooltip"></i> 
                                </a>
                                <a href="<?php echo site_url('compensation_packages/confirmation/' . $compensation_package['status_url'] . '/' . $compensation_package['compensation_package_id']); ?>" class="btn btn-link" data-toggle="modal" data-target="#modal-confirmation-<?php echo $index; ?>">
                                    <i class="fa <?php echo $compensation_package['status_icon']; ?>" title="<?php echo $compensation_package['status_action']; ?>" data-toggle="tooltip"></i> 
                                </a>
                            </td>
                            <td class="text-left"><?php echo $compensation_package['position_name']; ?></td>
                            <td class="text-right"><?php echo $compensation_package['monthly_salary']; ?></td>
							<td class="text-center"><?php echo $compensation_package['status_label']; ?></td>
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

        <div class="modal fade" id="md-add-compensation_package">
            <div class="modal-dialog">
                <div class="modal-content"></div>
            </div>
        </div>
        
        <?php if ($show_modal): ?>
            <div class="modal fade" id="modal-edit-compensation_package">
                <div class="modal-dialog">
                    <div class="modal-content"><?php $this->load->view($modal_file_path); ?></div>
                </div>
            </div>
            <script type="text/javascript">
                $(function() {
                    $('#modal-edit-compensation_package').modal({
                        backdrop: false,
                        keyboard: false
                    });
                });
            </script>
        <?php endif ?>
        
    </div>
</div>
</div>


