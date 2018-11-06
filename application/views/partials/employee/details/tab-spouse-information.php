<div class="tab-pane fade" id="tab-spouse-information">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="pull-left">Spouse Information</h4>
            <div class="pull-right">
                <a class="btn btn-primary" data-toggle="modal" data-target="#confirmation-add-spouse" href="<?php echo site_url('employees/confirmation/add/spouse_information/'.$employee_id); ?>"><i class="fa fa-plus"></i> Add Spouse</a>
                <div class="modal fade" id="confirmation-add-spouse">
                    <div class="modal-dialog">
                        <div class="modal-content"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <table class="table table-user-information">
                <thead>
                    <tr>
                        <th>Action</th>
                        <th>Full Name</th>
                        <th>Address</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($spouse_information as $spouse): ?>
                    <tr>
                        <td><a href="<?php echo site_url('employees/confirmation/edit/spouse_information/'.$employee_id.'/'.$spouse['id']); ?>"  data-toggle="modal" data-target="#modal-confirmation-spouse-information">Edit</a></td>
                        <td><?php echo $spouse['fullname']; ?></td>
                        <td><?php echo $spouse['address']; ?></td>
                        <td>
                            <a href="<?php echo site_url('employees/'.$spouse['status_link'].'/'.$employee_id); ?>" class="<?php echo $spouse['btn_color']; ?>"><?php echo $spouse['status_label']; ?></a>
                        </td>
                    </tr>
                    <?php endforeach ?>

                    <div class="modal fade" id="modal-confirmation-spouse-information">
                        <div class="modal-dialog">
                            <div class="modal-content"></div>
                        </div>
                    </div>
                </tbody>
            </table>
        </div>
    </div>
</div>
