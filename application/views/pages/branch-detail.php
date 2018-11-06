<div class="row">
    <div class="col-md-3">
        <div class="box box-primary">
            <div class="box-body">
                <h3 class="text-center"><?php echo $branch['name']; ?></h3>
                <p class="text-muted text-center">
                    <a href="<?php echo site_url('branches/details/' . $branch['company_id']); ?>">
                        <?php echo $branch['company_name']; ?>
                    </a>
                </p>
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>Address</b><br>
                        <?php echo $branch['street']; ?>
                    </li>
                </ul>
                <a href="<?php echo site_url('branches/edit/' . $branch['id']); ?>" class="<?php echo $btn_edit; ?> btn-block">Edit Details</a>
            </div>
        </div>
    </div>

    <div class="col-md-9">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#tab1" data-toggle="tab">Sites</a>
                </li>
                <li class="">
                    <a href="#tab2" data-toggle="tab">Employees</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade in active" id="tab1">
                    <table class="table table-bordered table-striped table-hover" id="">
                        <thead>
                            <tr>
                                <!-- <th class="text-left">Site No.</th> -->
                                <th class="text-left">Name</th>
                                <th class="text-left">Description</th>
                                <th class="text-left">Address</th>
                            </tr>
                        </thead>
                         <tbody>
                            <?php if (!empty($sites)): ?>
                                <?php foreach ($sites as $site): ?>
                                    <tr>
                                        <!-- <td class="text-right"><?php echo $site['id']; ?></td> -->
                                        <td class="text-left"><?php echo $site['name']; ?></td>
                                        <td class="text-left"><?php echo $site['description']; ?></td>
                                        <td class="text-left"><?php echo $site['site_address']; ?></td></td>
                                    </tr>
                                <?php endforeach; ?>local
                            <?php else: ?>
                                <tr>
                                    <td class="text-center" colspan="4">No Records Found!</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade in" id="tab2">
                    <table class="table table-bordered table-striped table-hover" id="">
                        <thead>
                            <tr>
                                <th class="text-left">Employee Code</th>
                                <th class="text-left">Full Name</th>
                                <th class="text-left">Position</th>
                                <th class="text-left">Department</th>
                                <th class="text-left">Team</th>
                            </tr>
                        </thead>
                       <tbody>
                            <?php if (!empty($employee_infos)): ?>
                                <?php foreach ($employee_infos as $employee_info): ?>
                                    <tr>
                                        <td class="text-right">
                                            <a href="<?php echo site_url('employees/informations/' . $employee_info['id']); ?>">
                                                <?php echo $employee_info['employee_code']; ?>
                                            </a>
                                        </td>
                                        <!-- <td class="text-right"><?php echo $employee_info['employee_code']; ?></td> -->
                                        <td class="text-left"><?php echo $employee_info['full_name']; ?></td>
                                        <td class="text-left"><?php echo $employee_info['position']; ?></td>
                                        <td class="text-left"><?php echo $employee_info['department']; ?></td>
                                        <td class="text-left"><?php echo $employee_info['team']; ?></td>
                                        <!-- <td class="text-left">
                                            <a href="<?php echo site_url('employees/details/' . $employee['id']); ?>">
                                                <?php echo $employee['name']; ?>
                                            </a>
                                        </td> -->
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td class="text-center" colspan="4">No Records Found!</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
