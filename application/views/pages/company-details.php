<div class="row">
    <div class="col-md-3">
        <div class="box box-primary">
            <div class="box-body">
                <h3 class="text-center"><?php echo $company['name']; ?></h3>
                <p class="text-muted text-center">
                    <a href="<?php echo site_url('companies/details/' . $company['id']); ?>">
                        <?php echo $company['name']; ?>
                    </a>
                </p>
               <a href="<?php echo site_url('companies/edit/' . $company['id']); ?>" class="<?php echo $btn_edit; ?> btn-block">Edit Details</a>
            </div>
        </div>
    </div>

    <div class="col-md-9">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#tab1" data-toggle="tab">Branches</a>
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
                                <th class="text-left">Branch ID</th>
                                <th class="text-left">Name</th>
                                <th class="text-left">Description</th>
                                <th class="text-left">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($branches)): ?>
                                <?php foreach ($branches as $branch): ?>
                                    <tr>
                                        <td class="text-right"><?php echo $branch['id']; ?></td>
                                        <td class="text-left">
                                            <a href="<?php echo site_url('branches/details/' . $branch['id']); ?>">
                                                <?php echo $branch['name']; ?>
                                            </a>
                                        </td>
                                        <td class="text-left"><?php echo $branch['description']; ?></td>
                                        <td class="text-center"><?php echo ($branch['active_status'] == true) ? 'Active' : 'Inactive'; ?></td>
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
                <div class="tab-pane fade in" id="tab2">
                    <table class="table table-bordered table-striped table-hover" id="">
                        <thead>
                            <tr>
                                <th class="text-left">Employee Code</th>
                                <th class="text-left">Last Name</th>
                                <th class="text-left">First Name</th>
                                <th class="text-left">Middle Name</th>
                                <th class="text-left">Position</th>
                                <th class="text-left">Department</th>
                                <th class="text-left">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($employees)): ?>
                                <?php foreach ($employees as $employee): ?>
                                    <tr>
                                        <!-- <td class="text-right"><?php echo $employee['employee_code']; ?></td> -->
                                        <td class="text-right">
                                            <a href="<?php echo site_url('employees/informations/' . $employee['id']); ?>">
                                                <?php echo $employee['employee_code']; ?>
                                            </a>
                                        </td>
                                        <td class="text-left"><?php echo $employee['last_name']; ?></td>
                                        <td class="text-left"><?php echo $employee['first_name']; ?></td>
                                        <td class="text-left"><?php echo $employee['middle_name']; ?></td>
                                        <td class="text-left"><?php echo $employee['middle_name']; ?></td>
                                        <td class="text-left"><?php echo $employee['middle_name']; ?></td>
                                        <td class="text-center"><?php echo ($employee['active_status'] == true) ? 'Active' : 'Inactive'; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td class="text-center" colspan="7">No Records Found!</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
