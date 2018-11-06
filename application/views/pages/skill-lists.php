<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-list"></i> <h3 class="box-title">List of Skills</h3>
                <div class="box-tools pull-right ">
                    <a href="<?php echo site_url('skills/add'); ?>" class="btn btn-primary btn-sm">
                        <i class="fa fa-plus"></i>
                        <span>Add Skill</span>
                    </a>
                </div>                
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped table-hover" id="datatables-skills">
                    <thead>
                        <tr>
                            <th style="width: 350px;">&nbsp;</th>
                            <th class="text-left">Name</th>
                            <th class="text-left">Description</th>
                            <th class="text-left">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ( ! empty($skills)): ?>
                            <?php foreach ($skills as $index => $skill): ?>
                                <tr>
                                    <td>
                                        <a class="<?php echo $btn_view; ?>" href="<?php echo site_url('skills/details/' . $skill['id']); ?>">
                                            <i class="fa fa-eye"></i> View
                                        </a>
                                        <a href="<?php echo site_url('skills/confirmation/edit/' . $skill['id']); ?>" class="btn btn-link" data-toggle="modal" data-target="#modal-confirmation-<?php echo $index; ?>">
                                            <i class="fa fa-edit"></i> Edit
                                        </a>
                                         <a class="<?php echo $btn_update; ?>" href="<?php echo site_url('skills/update_status/' . $skill['id']); ?>" data-toggle="modal" data-target="#update-skill-status-<?php echo md5($skill['id']); ?>">
                                            <i class="fa fa-cog"></i> <?php echo $skill['status_label']; ?>
                                        </a>
                                    </td>
                                    <!-- <td class="text-right"><?php echo $skill['id']; ?></td> -->
                                    <td class="text-left"><?php echo $skill['name']; ?></td>
                                    <td class="text-left"><?php echo $skill['description']; ?></td> 
                                    <td class="text-center"><?php echo $skill['active_status']; ?></td>    
                                </tr>

                                <div class="modal fade" id="modal-confirmation-<?php echo $index; ?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content"></div>
                                    </div>
                                </div>

                                <div class="modal fade" id="update-skill-status-<?php echo md5($skill['id']); ?>" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <!-- http://localhost/kawani_ci/roles/update_status/1 -->

                                        </div>
                                    </div>
                                </div>
                                 <div class="modal fade" id="update-skill-<?php echo md5($skill['id']); ?>" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <!-- http://localhost/kawani_ci/roles/update_status/1 -->

                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>


            <?php if ($show_modal): ?>
                <div class="modal fade" id="modal-edit-skill">
                    <div class="modal-dialog">
                        <div class="modal-content"><?php $this->load->view($modal_file_path); ?></div>
                    </div>
                </div>
                <script type="text/javascript">
                    $(function() {
                        $('#modal-edit-skill').modal({
                            backdrop: false,
                            keyboard: false
                        });
                    });
                </script>
            <?php endif ?>  

    </div>
</div>
