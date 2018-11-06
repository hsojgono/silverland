
<div class="row">
    <div class="col-md-3">
        <div class="box box-primary">
            <div class="box-body">
                <h3 class="text-center"><?php echo $position['name']; ?></h3>
                <p class="text-muted text-center">
                    <a href="<?php echo site_url('positions/details/' . $position['company_id']); ?>">
                        <?php echo $position['company_name']; ?>
                    </a>
                </p>
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>Created:</b><br>
                        <?php echo date('d F Y', strtotime($position['created'])); ?> <br>
						<b>Created by:</b><br>
                        <?php echo $position['full_name']; ?>
						
                    </li>
                </ul>
            </div>
        </div>
    </div>
<script>
$(function() {
$('#datatable-positions').DataTable();
});
</script>
    <div class="col-md-9">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <!--<li class="active">
                    <a href="#tab1" data-toggle="tab">Sites</a>
                </li>-->
                <li class="">
                    <a href="#tab1" data-toggle="tab">Employees</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade in active" id="tab1">
                    <table  id="datatable-positions"  class='table table-bordered table-stripped table-hover'>
                        <thead>
                            <tr>
								<th class="text-left">Action</th>
                                <th class="text-left">Employee Code</th>
                                <th class="text-left">Full Name</th>
                                <th class="text-left">Department</th>
                            </tr>
                        </thead>
                       <tbody>
                            <?php if (!empty($employees)): ?>
                                <?php foreach ($employees as $employee): ?>
                                    <tr>
							<td>
								<a class="<?php echo $btn_view; ?>" href="<?php echo site_url('employees/informations/' . $employee['employee_id']); ?>">
									<i class="fa fa-search"></i> View
								</a>
                            </td>
                                        <td class="text-right"><?php echo $employee['employee_positions_id']; ?></td>
                                        <td class="text-left"><?php echo $employee['full_name']; ?></td>
                                        <td class="text-left"><?php echo $employee['department']; ?></td>
                                        <!-- <td class="text-left">
                                            <a href="<?php echo site_url('employees/details/' . $employee['id']); ?>">
                                                <?php echo $employee['name']; ?>
                                            </a>
                                        </td> -->
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <!-- <tr>
                                    <td class="text-center" colspan="4">No Records Found!</td>
                                </tr> -->
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<script>
    $(function() {
        $('#datatable-positions').DataTable();
    });
</script>

</div>