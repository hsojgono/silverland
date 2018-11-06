<div class="row">
<div class="col-md-3">
    <div class="box box-primary">
        <div class="box-body">
            <h3 class="text-center"><?php echo $employee['full_name']; ?></h3>
            <p class="text-muted text-center">
                <a href="">
                    <?php echo $employee['position']; ?>
                </a>
            </p>
            <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                    <b>Employee Number</b> <a class="pull-right"><?php echo $employee['employee_code']; ?></a>
                </li>
                <li class="list-group-item">
                    <b>Department</b> <a class="pull-right"><?php echo $employee['department']; ?></a>
                </li>
            </ul>
           <!-- <a href="<?php echo site_url('department/edit/' . $department['id']); ?>" class="<?php echo $btn_edit; ?> btn-block">Edit Details</a> -->
        </div>
    </div>
</div>

<div class="col-md-9">
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="#tab1tab1tab1" data-toggle="tab">Leave Credits</a>
            </li>               
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade in active" id="tab1tab1tab1">
                <table class="table table-bordered table-striped table-hover" id="">
                    <thead>
                        <tr>
                            <th class="text-left">Leave Types</th>
                            <th class="text-left">Leave Balance</th>
                            <!-- <th class="text-left">Team</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (! empty($employee_leave_credits)): ?>
                         	<?php foreach ($employee_leave_credits as $employee_leave_credit): ?>
                         		<tr>
                                 <td class="text-left"><?php echo $employee_leave_credit['leave_type']; ?></td>
                                 <td class="text-right"><?php echo $employee_leave_credit['elc_balance']; ?></td>
                         		</tr>
                         	<?php endforeach ?>
                        <?php else: ?>
                        <tr>
                            <td class="text-center" colspan="4">No Records Found!</td>
                        </tr>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
     
        </div>
    </div>
</div>
</div>
