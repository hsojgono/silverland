<div class="row">
    <div class="col-md-3">
        <div class="box box-primary">
            <div class="box-body">
                <h3 class="text-center"><?php echo $site['name']; ?></h3>
                <p class="text-muted text-center">
                    <a href="<?php echo site_url('sites/details/' . $site['company_id']); ?>">
                        <?php echo $site['company_name']; ?>
                    </a>
                </p>
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>Address</b><br>
                        <?php echo $site['street']; ?>
                    </li>
                </ul>
                <a href="<?php echo site_url('sites/edit/' . $site['id']); ?>" class="<?php echo $btn_edit; ?> btn-block">Edit Details</a>
            </div>
        </div>
    </div>

    <div class="col-md-9">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#tab1" data-toggle="tab">Employees</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade in active" id="tab1">
                    <table class="table table-bordered table-striped table-hover" id="">
                        <thead>
                            <tr>
                                <!-- <th class="text-left">No.</th> -->
                                <th class="text-left">Employee Code</th>
                                <th class="text-left">Employee Name</th>
                                <th class="text-left">Position</th>
                                <th class="text-left">Department</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($sites)): ?>
                                <?php foreach ($sites as $site): ?>
                                    <tr>
                                        <!-- <td class="text-right"><?php echo $employee['employee_code']; ?></td> -->
                                        <td class="text-right">
                                            <a href="<?php echo site_url('employees/informations/' . $site['id']); ?>">
                                                <?php echo $site['employee_code']; ?>
                                            </a>
                                         </td>
                                        <!-- <td class="text-right"><?php echo $site['employee_id']; ?></td> -->
                                        <!-- <td class="text-right"><?php echo $site['employee_code']; ?></td> -->
                                        <td class="text-left"><?php echo mb_strtoupper($site['full_name']); ?></td>
                                        <td class="text-left"><?php echo mb_strtoupper($site['position_name']); ?></td>
                                        <td class="text-left"><?php echo mb_strtoupper($site['department_name']); ?></td>
                                    </tr>
                                <?php endforeach ?>
                            <?php endif ?>
                        </tbody>
                    </table>
                </div>
                
            </div>
        </div>
    </div>
</div>
