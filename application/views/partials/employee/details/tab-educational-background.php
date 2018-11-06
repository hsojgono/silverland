<div class="tab-pane fade" id="tab-educational-background">
<div class="row">
    <div class="col-lg-12">
        <div class="pull-right">
            <!-- <a class="btn btn-primary" data-toggle="modal" data-target="#confirmation-add-educational-background" href="<?php //echo site_url('employees/confirmation/add/education/'.$employee_id); ?>"><i class="fa fa-plus"></i> Add Educational Background</a> -->
            <div class="modal fade" id="confirmation-add-educational-background">
                <div class="modal-dialog">
                    <div class="modal-content"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-12">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th colspan="4">Educational Background</th>
                </tr>
                <tr>
                    <!-- <th class="text-center">Action</th> -->
                    <th>Level</th>
                    <th>Course</th>
                    <th>School</th>
                    <th>Year Started</th>
                    <th>Year Ended</th>
                    <th>Certification</th>
                    <th>Awards</th>
                    <th>GPA</th>
                    <th>Major GPA</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($employee_education as $index => $ea): ?>
                <tr>
                    <!-- <td class="text-center">
                        <a href="<?php echo site_url('employees/view_address_information/'.$address['employee_address_id']); ?>" data-toggle="modal" data-target="#employee-address-view-more-<?php echo $index; ?>">View More</a>
                    </td> -->
                    <td><?php echo $ea['ea_name']; ?></td>
                    <td><?php echo $ea['ec_desc']; ?></td>
                    <td><?php echo $ea['school']; ?></td>
                    <td><?php echo $ea['year_start']; ?></td>
                    <td><?php echo $ea['year_end']; ?></td>
                    <td><?php echo $ea['certification']; ?></td>
                    <td><?php echo $ea['awards']; ?></td>
                    <td><?php echo $ea['gpa']; ?></td>
                    <td><?php echo $ea['major_gpa']; ?></td>
                </tr>
                <div class="modal fade" id="employee-address-view-more-<?php echo $index; ?>">
                    <div class="modal-dialog">
                        <div class="modal-content"></div>
                    </div>
                </div>
                <div class="modal fade" id="confirmation-edit-employee-addresss-amount-<?php echo $index; ?>">
                    <div class="modal-dialog">
                        <div class="modal-content"></div>
                    </div>
                </div>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
</div>
