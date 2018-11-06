<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-list"></i> <h3 class="box-title">List of Trainings</h3>
                <div class="box-tools pull-right ">
                    <a href="<?php echo site_url('trainings/add'); ?>" class="btn btn-primary btn-sm">
                        <i class="fa fa-plus"></i>
                        <span>Add Training</span>
                    </a>
                    <!-- <a href="<?php echo site_url('trainings/load_form'); ?>" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#md-add-new-training"><i class="fa fa-plus"></i> Add Training</a> -->
                </div>                
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped table-hover" id="datatables-trainings">
                    <thead>
                        <tr>
                            <th style="width: 350px;">&nbsp;</th>
                            <th class="text-left">Company</th>
                            <th class="text-left">Title</th>
                            <th class="text-left">Facilitator</th>
                            <th class="text-left">Institution</th>
                            <th class="text-left">Location</th>
                            <th class="text-left">Date Started</th>
                            <th class="text-left">Date Ended</th>
                            <th class="text-left">Hours</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ( ! empty($trainings)): ?>
                            <?php foreach ($trainings as $index => $training): ?>
                                <tr>
                                    <td>
                                        <a class="<?php echo $btn_view; ?>" href="<?php echo site_url('trainings/details/' . $training['id']); ?>">
                                            <i class="fa fa-eye"></i> View
                                        </a>
                                        <a href="<?php echo site_url('trainings/confirmation/edit/' . $training['id']); ?>" class="btn btn-link" data-toggle="modal" data-target="#modal-confirmation-<?php echo $index; ?>">
                                            <i class="fa fa-edit"></i> Edit
                                        </a>
                                         <a class="<?php echo $btn_update; ?>" href="<?php echo site_url('trainings/update_status/' . $training['id']); ?>" data-toggle="modal" data-target="#update-training-status-<?php echo md5($training['id']); ?>">
                                            <i class="fa fa-cog"></i> <?php echo $training['status_label']; ?>
                                        </a>
                                    </td>
                                    <td class="text-left"><?php echo $training['company_name']; ?></td>
                                    <td class="text-left"><?php echo $training['title']; ?></td> 
                                    <td class="text-left"><?php echo $training['facilitator']; ?></td> 
                                    <td class="text-left"><?php echo $training['institution']; ?></td> 
                                    <td class="text-left"><?php echo $training['location']; ?></td> 
                                    <td class="text-left"><?php echo $training['date_started']; ?></td> 
                                    <td class="text-left"><?php echo $training['date_ended']; ?></td> 
                                    <td class="text-left"><?php echo $training['hours']; ?></td> 
                                </tr>

                                <div class="modal fade" id="modal-confirmation-<?php echo $index; ?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content"></div>
                                    </div>
                                </div>

                                <div class="modal fade" id="update-training-status-<?php echo md5($training['id']); ?>" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <!-- http://localhost/kawani_ci/roles/update_status/1 -->

                                        </div>
                                    </div>
                                </div>
                                 <div class="modal fade" id="update-training-<?php echo md5($training['id']); ?>" role="dialog">
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

			<!-- MODALS -->
			<div class="modal fade" id="md-add-new-training">
				<div class="modal-dialog">
					<div class="modal-content"></div>
				</div>
			</div>
			
            <?php if ($show_modal): ?>
                <div class="modal fade" id="modal-edit-training">
                    <div class="modal-dialog">
                        <div class="modal-content"><?php $this->load->view($modal_file_path); ?></div>
                    </div>
                </div>
                <script type="text/javascript">
                    $(function() {
                        $('#modal-edit-training').modal({
                            backdrop: false,
                            keyboard: false
                        });
                    });
                </script>
            <?php endif ?>  

    </div>
</div>
