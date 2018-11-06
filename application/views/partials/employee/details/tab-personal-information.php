<div class="tab-pane active fade in" id="tab-personal-information">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="pull-left">Personal Information</h4>
            <!-- <a href="<?php echo site_url('employees/confirmation/edit/personal_information/'.$employee_id); ?>" class="btn btn-primary pull-right" data-toggle="modal" data-target="#modal-confirmation-personal-information"> -->
            <a href="<?php echo site_url('employees/confirmation/edit/personal_information/'.$employee_id); ?>" class="btn btn-primary pull-right" data-toggle="modal" data-target="#modal-confirmation-personal-information">
                <i class="fa fa-edit"></i> Edit
            </a>
            <div class="modal fade" id="modal-confirmation-personal-information">
                <div class="modal-dialog">
                    <div class="modal-content"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <table class="table table-user-information">
                <tbody>
                    <tr>
                        <td>First Name:</td>
                        <td><?php echo $personal_information['first_name']; ?></td>
                    </tr>
                    <tr>
                        <td>Middle Name:</td>
                        <td><?php echo $personal_information['middle_name']; ?></td>
                    </tr>
                    <tr>
                        <td>Last Name:</td>
                        <td><?php echo $personal_information['last_name']; ?></td>
                    </tr>
                    <tr>
                        <td>Birthdate:</td>
                        <td><?php echo $personal_information['birthdate']; ?></td>
                    </tr>
                    <tr>
                        <td>Birthplace:</td>
                        <td><?php echo $personal_information['birthplace']; ?></td>
                    </tr>
                    <tr>
                        <td>Gender:</td>
                        <td><?php echo ($personal_information['gender'] == 1) ? 'Male':'Female'; ?></td>
                    </tr>
                    <tr>
                        <td>Civil Status:</td>
                        <?php $civil_status_id = $personal_information['civil_status_id']; ?>
                        <?php $index_id = array_search($civil_status_id, array_column($civil_status, 'id')); ?>
                        <td><?php echo $civil_status[$index_id]['status_name']; ?></td>
                    </tr>
                    <tr>
                        <td>TIN:</td>
                        <td><?php echo isset($government_id_number[0]['tin']) ? $government_id_number[0]['tin'] : ''; ?></td>
                    </tr>
                    <tr>
                        <td>SSS:</td>
                        <td><?php echo isset($government_id_number[0]['sss']) ? $government_id_number[0]['sss'] : ''; ?></td>
                    </tr>
                    <tr>
                    <tr>
                        <td>PHIC:</td>
                        <td><?php echo isset($government_id_number[0]['phic']) ? $government_id_number[0]['phic'] : '' ?></td>
                    </tr>
                        <td>HDMF:</td>
                        <td><?php echo isset($government_id_number[0]['hdmf']) ? $government_id_number[0]['hdmf'] : '' ?></td>
                    </tr>
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
