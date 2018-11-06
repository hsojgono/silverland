<script>
$(function() {
$('#datatable-violations').DataTable();
});
</script>
<div class="row">
    <div class="col-sm-12" >
        <div class='box box-primary'>
            <div class='box-header'>
            <h3 class="box-title">List of Violation</h3>
                <div class="box-tools"> 
                    <a href="<?php echo site_url('violations/add'); ?>" class="btn btn-box-tool">
                        <i class="fa fa-plus"></i>
                        <span class="text-blue">Add New Violation </span>
                    </a> 
                </div> 
            </div>              
                <div class='box-body'>
                <div class='table-responsive'>
                <table  id="datatable-violations"  class='table table-bordered table-stripped table-hover'>
                    <thead>
                        <tr>
                            <th>ACTION</th>
                            <th>VIOLATION LEVEL</th>
                            <th>VIOLATION TYPE</th>
							<th class="text-center">COMPANY</th>
                            <th class="text-center">STATUS</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($violations as $index => $violation): ?>
                        <tr>
                            <td>
                                <a href="<?php echo site_url('violations/confirmation/edit/' . $violation['id']); ?>" data-toggle="modal" data-target="#modal-confirmation-<?php echo $index; ?>">
                                    <i class="fa fa-pencil"></i>
                                    <span>Edit</span>
                                </a>
                                <a href="<?php echo site_url('violations/confirmation/' . $violation['status_url'] . '/' . $violation['id']); ?>" class="btn btn-link" data-toggle="modal" data-target="#modal-confirmation-<?php echo $index; ?>">
                                            <i class="fa <?php echo $violation['status_icon']; ?>"></i> <?php echo $violation['status_action']; ?>
                                </a>
                            </td>
                            <td><?php echo $violation['violation_level_name']; ?></td>
                            <td><?php echo $violation['violation_type_name']; ?></td>
							<td class="text-center"><?php echo $violation['company_name']; ?></td>
                            <td class="text-center"><?php echo $violation['status_label']; ?></td>
                        </tr>
                                    <div class="modal fade" id="modal-confirmation-<?php echo $index; ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content"></div>
                                        </div>
                                    </div>
                    
                        <?php endforeach; ?>
                                    <?php if (empty($violations)): ?>
                                    <!-- <tr class="text-center">
                                        <td colspan="3">-- NO RECORD FOUND --</td>
                                    </tr> -->
                                    <?php endif; ?>

            </tbody>
        </table>
    </div>
</div>
<script>
    $(function() {
        $('#datatable-violations').DataTable();
    });
</script>