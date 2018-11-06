<!-- <div class="row">
    <div class="col-md-6">&nbsp;</div>
    <div class="col-md-6">
        <div class="pull-right">
            <a href="<?php echo site_url('courses/add'); ?>" class="btn btn-primary">
                <i class="fa fa-plus"></i>
                <span>Add Course</span>
            </a>
        </div>
    </div>
</div>
<br> -->
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-list"></i> <h3 class="box-title">List of Courses</h3>
                <div class="box-tools pull-right ">
                    <a href="<?php echo site_url('courses/add'); ?>" class="btn btn-primary btn-sm">
                        <i class="fa fa-plus"></i>
                        <span>Add Course</span>
                    </a>
                </div>                
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped table-hover" id="datatables-courses">
                    <thead>
                        <tr>
                            <th style="width: 130px;">&nbsp;</th>
                            <th class="text-left">Course</th>
                            <th class="text-left">Description</th>
                            <th class="text-left">Degree</th>
                            <th class="text-left">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ( ! empty($courses)): ?>
                            <?php foreach ($courses as $index => $course): ?>
                                <tr>
                                    <td>
                                        <a class="<?php echo $btn_view; ?>" href="<?php echo site_url('courses/details/' . $course['id']); ?>">
                                            <i class="fa fa-search" title= "View <?php echo $course['course']; ?>" data-toggle="tooltip"></i>
                                        </a>
                                        <a href="<?php echo site_url('courses/confirmation/edit/' . $course['id']); ?>" class="btn btn-link" data-toggle="modal" data-target="#modal-confirmation-<?php echo $index; ?>">
                                            <i class="fa fa-pencil-square-o" title="Edit <?php echo $course['course']; ?>" data-toggle="tooltip"></i>
                                        </a>
                                         <a class="<?php echo $btn_update; ?>" href="<?php echo site_url('courses/update_status/' . $course['id']); ?>" data-toggle="modal" data-target="#update-course-status-<?php echo md5($course['id']); ?>">
                                        <i class="fa <?php echo $course['status_icon']; ?>" title="<?php echo $course['status_action']; ?> <?php echo $course['course']; ?>" data-toggle="tooltip"></i> 
                                        </a>
                                    </td>
                                    <!-- <td class="text-right"><?php echo $course['id']; ?></td> -->
                                    <td class="text-left"><?php echo $course['course']; ?></td>
                                    <td class="text-left"><?php echo $course['description']; ?></td> 
                                    <td class="text-left"><?php echo $course['degree']; ?></td> 
                                    <td class="text-center"><?php echo $course['status_label']; ?></td>    
                                </tr>

                                <div class="modal fade" id="modal-confirmation-<?php echo $index; ?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content"></div>
                                    </div>
                                </div>

                                <div class="modal fade" id="update-course-status-<?php echo md5($course['id']); ?>" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <!-- http://localhost/kawani_ci/roles/update_status/1 -->

                                        </div>
                                    </div>
                                </div>
                                 <div class="modal fade" id="update-course-<?php echo md5($course['id']); ?>" role="dialog">
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
                <div class="modal fade" id="modal-edit-course">
                    <div class="modal-dialog">
                        <div class="modal-content"><?php $this->load->view($modal_file_path); ?></div>
                    </div>
                </div>
                <script type="text/javascript">
                    $(function() {
                        $('#modal-edit-course').modal({
                            backdrop: false,
                            keyboard: false
                        });
                    });
                </script>
            <?php endif ?>  

    </div>
</div>
