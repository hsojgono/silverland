<div class="row">
<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Company Contact Information</h3>
            <div class="box-tools pull-right">
                <a href="<?php echo site_url('company_contact_information/load_form'); ?>" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#md-add-cc_information"><i class="fa fa-plus"></i> Add Company Contact Information</a>
            </div>
        </div>
        <div class="box-body">  
            <div class="table-responsive">
                <table class="table table-bordered" id="datatables-company_contact_information">
                    <thead>
                        <tr>
                            <th style="width: 300px;">Action</th>
                            <th>Company</th>
                            <th>Telephone Number</th>
                            <th>Mobile Number</th>
                            <th>Fax Number</th>
                            <th>Email Address</th>
                            <th>Website</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ( ! empty($company_contact_information)): ?>
                        <?php foreach ($company_contact_information as $index => $cc_information): ?>
                        <tr>
                            <td>
                                <a href="<?php echo site_url('company_contact_information/details/' . $cc_information['id']); ?>" class="btn btn-link">
                                    <i class="fa fa-eye"></i> View
                                </a>
                                <a href="<?php echo site_url('company_contact_information/confirmation/edit/' . $cc_information['id']); ?>" class="btn btn-link" data-toggle="modal" data-target="#modal-confirmation-<?php echo $index; ?>">
                                    <i class="fa fa-edit"></i> Edit
                                </a>
                                <a href="<?php echo site_url('company_contact_information/confirmation/' . $cc_information['status_url'] . '/' . $cc_information['id']); ?>" class="btn btn-link" data-toggle="modal" data-target="#modal-confirmation-<?php echo $index; ?>">
                                    <i class="fa <?php echo $cc_information['status_icon']; ?>"></i> <?php echo $cc_information['status_action']; ?>
                                </a>
                            </td>
                            <td class="text-left"><?php echo $cc_information['company_name']; ?></td>
                            <td class="text-left"><?php echo $cc_information['telephone_number']; ?></td>
							<td class="text-left"><?php echo $cc_information['mobile_number']; ?></td>
							<td class="text-left"><?php echo $cc_information['fax_number']; ?></td>
							<td class="text-left"><?php echo $cc_information['email']; ?></td>
							<td class="text-left"><?php echo $cc_information['website']; ?></td>
							<td class="text-center"><?php echo $cc_information['status_label']; ?></td>
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

        <div class="modal fade" id="md-add-cc_information">
            <div class="modal-dialog">
                <div class="modal-content"></div>
            </div>
        </div>
        
        <?php if ($show_modal): ?>
            <div class="modal fade" id="modal-edit-cc_information">
                <div class="modal-dialog">
                    <div class="modal-content"><?php $this->load->view($modal_file_path); ?></div>
                </div>
            </div>
            <script type="text/javascript">
                $(function() {
                    $('#modal-edit-cc_information').modal({
                        backdrop: false,
                        keyboard: false
                    });
                });
            </script>
        <?php endif ?>
        
    </div>
</div>
</div>


