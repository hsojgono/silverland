<form class="form-horizontal" action="<?php echo site_url('employees/add'); ?>" method="post">
    <div class="modal-header">
        <h4 class="modal-title">Add Employee Form</h4>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label for="first_name" class="control-label col-sm-4">FIRST NAME:</label>
            <div class="col-sm-6">
                <input type="text" name="first_name" id="first_name" class="form-control" placeholder="first name">
            </div>
        </div>
        <div class="form-group">
            <label for="last_name" class="control-label col-sm-4">LAST NAME:</label>
            <div class="col-sm-6">
                <input type="text" name="last_name" id="last_name" class="form-control" placeholder="last name">
            </div>
        </div>
        <div class="form-group">
            <label for="email" class="control-label col-sm-4">EMAIL:</label>
            <div class="col-sm-6">
                <input type="text" name="email" id="email" class="form-control" placeholder="email">
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <input type="hidden" name="add" value="add">
        <button class="btn btn-primary" type="submit">Submit</button>
        <button class="btn btn-default" type="button" data-dismiss="modal">Cancel</button>
    </div>
</form>
