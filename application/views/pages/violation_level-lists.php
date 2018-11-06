<script>
$(function() {
$('#datatable-violation_levels').DataTable();
});
</script>
<div class="row">
    <div class="col-sm-12" >
        <div class='box box-primary'>
            <div class='box-header'>
            <h3 class="box-title">List of Violation Levels</h3>
                <div class="box-tools"> 
                    <a href="<?php echo site_url('violation_levels/add'); ?>" class="btn btn-box-tool">
                        <i class="fa fa-plus"></i>
                        <span class="text-blue">Add New Violation Level</span>
                    </a> 
                </div> 
            </div>              
                <div class='box-body'>
                <div class='table-responsive'>
                <table  id="datatable-violation_levels"  class='table table-bordered table-stripped table-hover'>
                    <thead>
                        <tr>
                            <th>ACTION</th>
                            <th>VIOLATION LEVEL NAME</th>
                            <th>DESCRIPTION</th>
							<th class="text-center">COMPANY</th>
                            <th class="text-center">STATUS</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($violation_levels as $index => $violation_level): ?>
                        <tr>
                            <td>
                                <a href="<?php echo site_url('violation_levels/confirmation/edit/' . $violation_level['id']); ?>" data-toggle="modal" data-target="#modal-confirmation-<?php echo $index; ?>">
                                    <i class="fa fa-pencil"></i>
                                    <span>Edit</span>
                                </a>
                                <a href="<?php echo site_url('violation_levels/confirmation/' . $violation_level['status_url'] . '/' . $violation_level['id']); ?>" class="btn btn-link" data-toggle="modal" data-target="#modal-confirmation-<?php echo $index; ?>">
                                            <i class="fa <?php echo $violation_level['status_icon']; ?>"></i> <?php echo $violation_level['status_action']; ?>
                                </a>
                            </td>
                            <td><?php echo $violation_level['name']; ?></td>
                            <td><?php echo $violation_level['description']; ?></td>
							<td class="text-center"><?php echo $violation_level['company_name']; ?></td>
                            <td class="text-center"><?php echo $violation_level['status_label']; ?></td>
                        </tr>
                                    <div class="modal fade" id="modal-confirmation-<?php echo $index; ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content"></div>
                                        </div>
                                    </div>
                    
                        <?php endforeach; ?>
                                    <?php if (empty($violation_levels)): ?>
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
        $('#datatable-violation_levels').DataTable();
    });
</script>