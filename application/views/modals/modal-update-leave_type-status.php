<form action="<?php echo site_url('leave_types/update_status/'.$leave_type_data['id']); ?>" method="post">
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Update Leave Type Status</h4>
</div>
<div class="modal-body">
    <h4>Do you want to <strong><?php echo $leave_type_data['status_label']; ?></strong> <?php echo $leave_type_data['name']; ?>?</h4>
</div>
<div class="modal-footer">
    <input type="hidden" name="mode" value="<?php echo $leave_type_data['status_label']; ?>">
    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
    <button type="submit" class="btn btn-default">Yes</button>
</div>
</form>