<div class="row">
    <div class="col-md-6">&nbsp;</div>
    <div class="col-md-6">
        <div class="pull-right">
            <a href="<?php echo site_url('sanction_types/add'); ?>" class="btn btn-primary">
                <i class="fa fa-plus"></i>
                <span>Add Sanction Type</span>
            </a>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-list"></i> <h3 class="box-title">List of Sanction Types</h3>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped table-hover" id="datatables-sanctions">
                    <thead>
                        <tr>
                            <th style="width: 250px;" class="text-center">Action</th>
                            <th class="text-center">Sanction Types</th>
                            <th class="text-center">Description</th>
                            <th class="text-center">Company</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ( ! empty($sanction_types)): ?>
                        <?php foreach ($sanction_types as $sanction_type): ?>
                        <tr>
                            <td>
                                
                                <a class="<?php echo $btn_update; ?>" href="<?php echo site_url('sanction_types/confirmation/edit/' . $sanction_type['id']); ?>" data-toggle="modal" data-target="#update-company-<?php echo md5($sanction_type['id']); ?>">
                                    <i class="fa fa-pencil-square-o"></i> Edit
                                </a>
                                <a class="<?php echo $btn_update; ?>" href="<?php echo site_url('sanction_types/confirmation/' . $sanction_type['status_url']. '/'. $sanction_type['id']); ?>" data-toggle="modal" data-target="#update-company-status-<?php echo md5($sanction_type['id']); ?>">
                                    <i class="fa fa-cog"></i> <?php echo $sanction_type['status_action']; ?>
                                </a>
                            </td>
                            <td class="text-center"><?php echo $sanction_type['name']; ?></td>
                            <td class="text-center"><?php echo $sanction_type['description']; ?></td>
							<td class="text-center"><?php echo $sanction_type['company_name']; ?></td>
                            <td class="text-center"><?php echo $sanction_type['status_label']; ?></td>
                        </tr>
                        <div class="modal fade" id="update-company-status-<?php echo md5($sanction_type['id']); ?>" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content"></div>
                            </div>
                        </div>
                         <div class="modal fade" id="update-company-<?php echo md5($sanction_type['id']); ?>" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content"></div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<!-- <script>
$(function() {
$('#datatable-sanctions').DataTable();
});
</script>
<div class="row">
    <div class="col-sm-12" >
        <div class='box box-primary'>
            <div class='box-header'>
            <h3 class="box-title">List of Sanction</h3>
                <div class="box-tools"> 
                    <a href="<?php echo site_url('sanctions/add'); ?>" class="btn btn-box-tool">
                        <i class="fa fa-plus"></i>
                        <span class="text-blue">Add New Sanction </span>
                    </a> 
                </div> 
            </div>              
                <div class='box-body'>
                <div class='table-responsive'>
                <table  id="datatable-sanctions"  class='table table-bordered table-stripped table-hover'>
                    <thead>
                        <tr>
                            <th>Action</th>
                            <th>Sanctions</th>
                            <th>Description</th>
                            <th>Sanction Type</th>
							<th class="text-center">Company</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php foreach($sanctions as $index => $sanction): ?>
                        <tr>
                            <td>
                                <a href="<?php echo site_url('sanctions/confirmation/edit/' . $sanction['id']); ?>" data-toggle="modal" data-target="#modal-confirmation-<?php echo $index; ?>">
                                    <i class="fa fa-pencil"></i>
                                    <span>Edit</span>
                                </a>
                                <a href="<?php echo site_url('sanctions/confirmation/' . $sanction['status_url'] . '/' . $sanction['id']); ?>" class="btn btn-link" data-toggle="modal" data-target="#modal-confirmation-<?php echo $index; ?>">
                                            <i class="fa <?php echo $sanction['status_icon']; ?>"></i> <?php echo $sanction['status_action']; ?>
                                </a>
                            </td>
                            <td><?php echo $sanction['name']; ?></td>
                            <td><?php echo $sanction['description']; ?></td>
                            <td><?php echo $sanction['sanction_type_name']; ?></td>
							<td class="text-center"><?php echo $sanction['company_name']; ?></td>
                            <td class="text-center"><?php echo $sanction['status_label']; ?></td>
                        </tr>
                                    <div class="modal fade" id="modal-confirmation-<?php echo $index; ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content"></div>
                                        </div>
                                    </div>
                        
                        <?php endforeach; ?>
                                    <?php if (empty($sanctions)): ?>
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
        $('#datatable-sanctions').DataTable();
    });
</script> -->