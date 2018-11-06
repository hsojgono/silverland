<div class="row">
    <div class="col-lg-3">
        <div class="employee-treeview"></div>
    </div>
    <div class="col-lg-9">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Employee Information</h3>
            </div>
            <div class="box-body">
                <p>the quick brown fox jumps over the lazy dog.</p>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="<?php echo site_url('assets/libs/bootstrap-treeview/dist/bootstrap-treeview.min.css'); ?>">
<script src="<?php echo site_url('assets/libs/bootstrap-treeview/dist/bootstrap-treeview.min.js'); ?>"></script>

<script>

    $(function () {
        var treeviewObj = $('.employee-treeview');
        var selectedDepartment = $('#selected-department');

        $.ajax({
            url: BASE_URL + 'employee_hierarchy/ajax_employee_hierarchy',
            method: 'POST',
            dataType: 'json',
            success: successCallback,
        });

        function successCallback(response) {
            console.log(response);
            treeviewObj.treeview({
                data: response.data
            });
        }
    });

</script>