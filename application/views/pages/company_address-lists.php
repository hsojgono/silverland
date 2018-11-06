<div class="row">
<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Company Addresses</h3>
            <div class="box-tools pull-right">
                <a href="<?php echo site_url('company_addresses/load_form'); ?>" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#md-add-company_address"><i class="fa fa-plus"></i> Set Company Address</a>
            </div>
        </div>
        <div class="box-body">  
            <div class="table-responsive">
                <table class="table table-bordered" id="datatables-company_addresses">
                    <thead>
                        <tr>
                            <th style="width: 300px;">Action</th>
                            <th>Company</th>
                            <th>Address</th>
                            <th>Location</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ( ! empty($company_addresses)): ?>
                        <?php foreach ($company_addresses as $index => $company_address): ?>
                        <tr>
                            <td>
                                <a href="<?php echo site_url('company_addresses/details/' . $company_address['id']); ?>" class="btn btn-link">
                                    <i class="fa fa-eye"></i> View
                                </a>
                                <a href="<?php echo site_url('company_addresses/confirmation/edit/' . $company_address['id']); ?>" class="btn btn-link" data-toggle="modal" data-target="#modal-confirmation-<?php echo $index; ?>">
                                    <i class="fa fa-edit"></i> Edit
                                </a>
                                <a href="<?php echo site_url('company_addresses/confirmation/' . $company_address['status_url'] . '/' . $company_address['id']); ?>" class="btn btn-link" data-toggle="modal" data-target="#modal-confirmation-<?php echo $index; ?>">
                                    <i class="fa <?php echo $company_address['status_icon']; ?>"></i> <?php echo $company_address['status_action']; ?>
                                </a>
                            </td>
                            <td class="text-left"><?php echo $company_address['company_name']; ?></td>
                            <td class="text-left"><?php echo $company_address['full_address']; ?></td>
							<td class="text-left"><?php echo $company_address['location']; ?></td>
							<td class="text-center"><?php echo $company_address['status_label']; ?></td>
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

        <div class="modal fade" id="md-add-company_address">
            <div class="modal-dialog">
                <div class="modal-content"></div>
            </div>
        </div>
        
        <?php if ($show_modal): ?>
            <div class="modal fade" id="modal-edit-company_address">
                <div class="modal-dialog">
                    <div class="modal-content"><?php $this->load->view($modal_file_path); ?></div>
                </div>
            </div>
            <script type="text/javascript">
                $(function() {
                    $('#modal-edit-company_address').modal({
                        backdrop: false,
                        keyboard: false
                    });
                });
            </script>
        <?php endif ?>
        
    </div>
</div>
</div>


