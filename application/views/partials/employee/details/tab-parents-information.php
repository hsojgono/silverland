<div class="tab-pane fade in" id="tab-parents-information">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="pull-left">Parents Information</h4>

            <a href="<?php echo site_url('employees/add_employee_parent/' . $employee_id); ?>" class="btn btn-primary pull-right" data-toggle="modal" data-target="#modal-add-employee-parent">
                <i class="fa fa-plus"></i> Add Employee Parent
            </a>
            
            <div class="modal fade" id="modal-confirmation-parents-information">
                <div class="modal-dialog">
                    <div class="modal-content"></div>
                </div>
            </div>
            <div class="modal fade" id="modal-add-employee-parent">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
            <?php if (count($parents_information) > 0): ?>
            <?php foreach ($parents_information as $index => $parent_information) : ?>
            <div class="col-sm-6">
                <?php $relationship_id = $parent_information['relationship_id']; ?>
                <?php $index_id = array_search($relationship_id, array_column($relationships, 'id')); ?>
                <?php $relationship = $relationships[$index_id]['name']; ?>
                <table class="table table-user-information">
                    <thead>
                        <tr>
                            <th><?php echo ucwords(strtolower($relationship)); ?></th>
                            <th>
                                <button class="btn btn-link btn-sm pull-right edit-parent" value="<?php echo $parent_information['id']; ?>">
                                    <i class="fa fa-edit"></i> Edit Parent Record
                                </button>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>First Name:</td>
                            <td><?php echo $parent_information['first_name']; ?></td>
                        </tr>
                        <tr>
                            <td>Middle Name:</td>
                            <td><?php echo $parent_information['middle_name']; ?></td>
                        </tr>
                        <tr>
                            <td>Last Name:</td>
                            <td><?php echo $parent_information['last_name']; ?></td>
                        </tr>
                        <tr>
                            <td>Birthdate:</td>
                            <td><?php echo $parent_information['birthdate']; ?></td>
                        </tr>
                        <tr>
                            <td>Birthplace:</td>
                            <td><?php echo $parent_information['birthplace']; ?></td>
                        </tr>
                        <tr>
                            <td>Gender:</td>
                            <td><?php echo ($parent_information['gender'] == 1) ? 'Male' : 'Female'; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal fade" id="modal-conf-edit-parent-<?php echo $index; ?>">
                <div class="modal-dialog">
                    <div class="modal-content"></div>
                </div>
            </div>
            <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center">No parent record found.</p>
            <?php endif; ?>
    </div>
</div>


<div class="modal fade" id="modal-edit-parent">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Dynamic Content</h4>
            </div>

            <div class="modal-body">
                <p class="text-center">Content is loading...</p>
            </div>


        </div>
    </div>
</div>

<script src="<?php echo site_url('assets/libs/jquery-validation/1.16.0/dist/jquery.validate.js'); ?>"></script>
<script src="<?php echo site_url('assets/libs/bootbox.min.js'); ?>"></script>

<script>
    $.validator.setDefaults( {
        submitHandler: function (form) {
            $(form).submit();
        }
    });

    $(document).ready(function() {

        var $editParent = $('.edit-parent');

        $editParent.on('click', function() {
            var $this = $(this);
            var parentID = $this.val();
            $.ajax({
                url: BASE_URL + 'employees/rest_api/get-parent-information/' + parentID,
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    var parent_id = response.data.id;
                    bootbox.confirm({
                        title: "Edit Parent Information",
                        message: "Do you want to edit the record of "+response.data.fullname+"now? This cannot be undone.",
                        buttons: {
                            cancel: {
                                label: '<i class="fa fa-times"></i> Cancel'
                            },
                            confirm: {
                                label: '<i class="fa fa-check"></i> Confirm'
                            }
                        },
                        callback: function (result) {
                            $.get(BASE_URL + 'employees/edit_employee_parent/' + parent_id, function(html) {
                                $('#modal-edit-parent .modal-body').html(html);
                                $('#modal-edit-parent').modal('show', {backdrop: 'static'});
                            });
                        }
                    });
                }
            });
        });

        

    });
</script>

