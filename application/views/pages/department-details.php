<div class="row">
    <div class="col-md-3">
        <div class="box box-primary">
            <div class="box-body">
                <h3 class="text-center"><?php echo $department['description']; ?></h3>
                <p class="text-muted text-center">
                    <a href="<?php echo site_url('departments/details/' . $department['id']); ?>">
                        <?php echo $department['name']; ?>
                    </a>
                </p>
               <a href="<?php echo site_url('department/edit/' . $department['id']); ?>" class="<?php echo $btn_edit; ?> btn-block">Edit Details</a>
            </div>
        </div>
    </div>

        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#tab1" data-toggle="tab">Employees</a>
                    </li>                <li class="">
                        <!-- <a href="#tab2" data-toggle="tab">Branches</a> -->
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="tab1">
                        <table class="table table-bordered table-striped table-hover" id="">
                            <thead>
                                <tr>
                                    <th class="text-left">Action</th>
                                    <th class="text-left">Employee Code</th>
                                    <th class="text-left">Full Name</th>
                                    <th class="text-left">Position</th>
                                    <!-- <th class="text-left">Team</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($employee_infos)): ?>
                                    <?php foreach ($employee_infos as $employee_info): ?>
                                        <tr>
                                            <td>
                                                <a class="<?php echo $btn_view; ?>" href="<?php echo site_url('employees/informations/' . $employee_info['id']); ?>">
                                                    <i class="fa fa-eye"></i> View
                                                </a>
                                            </td>
                                            <td class="text-right"><?php echo $employee_info['employee_code']; ?></td>
                                            <td class="text-left"><?php echo $employee_info['full_name']; ?></td>
                                            <td class="text-left"><?php echo $employee_info['position']; ?></td>
                                            <!-- <td class="text-left"><?php echo $employee_info['team']; ?></td> -->
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
                    <div class="tab-pane fade in" id="tab2">
                        <table class="table table-bordered table-striped table-hover" id="">
                            <thead>
                                <tr>
                                    <th class="text-left">Header</th>
                                    <th class="text-left">Header</th>
                                    <th class="text-left">Header</th>
                                    <th class="text-left">Header</th>
                                    <th class="text-left">Header</th>
                                    <th class="text-left">Header</th>
                                    <th class="text-left">Header</th>
                                    <th class="text-left">Header</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-left">TAB 2 DATA</td>
                                    <td class="text-left">TAB 2 DATA</td>
                                    <td class="text-left">TAB 2 DATA</td>
                                    <td class="text-left">TAB 2 DATA</td>
                                    <td class="text-left">TAB 2 DATA</td>
                                    <td class="text-left">TAB 2 DATA</td>
                                    <td class="text-left">TAB 2 DATA</td>
                                    <td class="text-left">TAB 2 DATA</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
