<script>

    $(function() {
        $('#datatable-positions').DataTable();
    });

</script>

<div class="row">
    <div class="col-sm-12" >
        <div class='box box-primary'>
            <div class='box-header'>
            <h3 class="box-title">Lists of Position</h3>
                <div class="box-tools"> 
                    <a href="<?php echo site_url('positions/add'); ?>" class="btn btn-box-tool">
                        <i class="fa fa-plus"></i>
                        <span class="text-blue">Add Position</span>
                    </a> 
                </div> 
            </div>              
                <div class='box-body'>
                <div class='table-responsive'>
                <table  id="datatable-positions"  class='table table-bordered table-stripped table-hover'>
                    <thead>
                        <tr>
                            <th>ACTION</th>
                            <th>POSITION</th>
                            <th>DESCRIPTION</th>
                            <th>GRADE CODE</th>
							<th>COMPANY</th>
                            <th class="text-center">STATUS</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($positions as $index => $position): ?>
                        <tr>
                            <td>
                                <a class="<?php echo $btn_view; ?>" href="<?php echo site_url('positions/details/' . $position['id']); ?>">
                                    <i class="fa fa-eye" title="View <?php echo $position['name']; ?>" data-toggle="tooltip"></i>
                                </a>
                                <a href="<?php echo site_url('positions/confirmation/edit/' . $position['id']); ?>" data-toggle="modal" data-target="#modal-confirmation-<?php echo $index; ?>">
                                    <i class="fa fa-pencil" title="Edit <?php echo $position['name']; ?>" data-toggle="tooltip"></i>
                                </a>
                                <a href="<?php echo site_url('positions/confirmation/' . $position['status_url'] . '/' . $position['id']); ?>" class="btn btn-link" data-toggle="modal" data-target="#modal-confirmation-<?php echo $index; ?>">
                                            <!-- <i class="fa <?php echo $position['status_icon']; ?> <?php echo $position['name']; ?>"></i> -->
                                            <i class="fa <?php echo $position['status_icon']; ?>" title="<?php echo $position['status_action']; ?> <?php echo $position['name']; ?>" data-toggle="tooltip"></i> 
                                </a>
                            </td>
                            <td><?php echo $position['name']; ?></td>
                            <td><?php echo $position['description']; ?></td>
                            <td class="text-left"><?php echo $position['grade_code']; ?></td>
							<td class="text-left"><?php echo $position['company_name']; ?></td>
                            <td class="text-center"><?php echo $position['status_label']; ?></td>
                        </tr>
                                    <div class="modal fade" id="modal-confirmation-<?php echo $index; ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content"></div>
                                        </div>
                                    </div>
                    
                        <?php endforeach; ?>
                            <?php if (empty($positions)): ?>
                            <tr class="text-center">
                                <td colspan="3">-- NO RECORD FOUND --</td>
                            </tr>
                        <?php endif; ?>

            </tbody>
        </table>
    </div>
</div>
<script type="text/javascript">
    $(function() {
        $('#datatable-positions').DataTable();
    });

    $($document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip({
                placement: 'right',
                animation: true,
                html: true
            });
    });    
</script>
