<script>
$(function() {
$('#datatable-violation_types').DataTable();
});
</script>
<div class="row">
    <div class="col-sm-12" >
        <div class='box box-primary'>
            <div class='box-header'>
            <h3 class="box-title">List of Violation types</h3>
                <div class="box-tools"> 
                    <a href="<?php echo site_url('violation_types/add'); ?>" class="btn btn-box-tool">
                        <i class="fa fa-plus"></i>
                        <span class="text-blue">Add New Violation type</span>
                    </a> 
                </div> 
            </div>              
                <div class='box-body'>
                <div class='table-responsive'>
                <table  id="datatable-violation_types"  class='table table-bordered table-stripped table-hover'>
                    <thead>
                        <tr>
                            <th>ACTION</th>
                            <th>VIOLATION type NAME</th>
                            <th>DESCRIPTION</th>
							<th class="text-center">COMPANY</th>
                            <th class="text-center">STATUS</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($violation_types as $index => $violation_type): ?>
                        <tr>
                            <td>
                                <a href="<?php echo site_url('violation_types/confirmation/edit/' . $violation_type['id']); ?>" data-toggle="modal" data-target="#modal-confirmation-<?php echo $index; ?>">
                                    <i class="fa fa-pencil"></i>
                                    <span>Edit</span>
                                </a>
                                <a href="<?php echo site_url('violation_types/confirmation/' . $violation_type['status_url'] . '/' . $violation_type['id']); ?>" class="btn btn-link" data-toggle="modal" data-target="#modal-confirmation-<?php echo $index; ?>">
                                            <i class="fa <?php echo $violation_type['status_icon']; ?>"></i> <?php echo $violation_type['status_action']; ?>
                                </a>
                            </td>
                            <td><?php echo $violation_type['name']; ?></td>
                            <td><?php echo $violation_type['description']; ?></td>
							<td class="text-center"><?php echo $violation_type['company_name']; ?></td>
                            <td class="text-center"><?php echo $violation_type['status_label']; ?></td>
                        </tr>
                                    <div class="modal fade" id="modal-confirmation-<?php echo $index; ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content"></div>
                                        </div>
                                    </div>
                    
                        <?php endforeach; ?>
                                    <?php if (empty($violation_types)): ?>
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
        $('#datatable-violation_types').DataTable();
    });
</script>