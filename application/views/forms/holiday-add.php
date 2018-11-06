<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-pencil-square-o"></i> <h3 class="box-title">Add Holiday</h3>
            </div>
            <div class="box-body">
            <form class="form-horizontal" action="<?php echo site_url('holidays/add'); ?>" method="post">
                <label class="col-xs-3 text-left">Company</label>
                <div class="form-group">
                    <div class="col-xs-6">
                        <select class="form-control select2 col-xs-3 col-md-3 col-sm-3 col-lg-3" name="company_id" id="company">
                            <option value="">-- Select Company --</option>
                            <?php foreach ($companies as $company): ?>
                                <option value="<?php echo $company['id']; ?>"><?php echo $company['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="validation_error"><?php echo form_error('company_id'); ?></div>
                    </div>
                </div>
                <label class="col-xs-3 text-left">Branch</label>
                <div class="form-group">
                    <div class="col-xs-6">
                        <select class="form-control select2 col-xs-3 col-md-3 col-sm-3 col-lg-3" name="branch_id" id="branch">
                            <option value="">-- Select Branch --</option>
                            <!-- <?php foreach ($branches as $branch): ?>
                                <option value="<?php echo $branch['id']; ?>"><?php echo $branch['name']; ?></option>
                            <?php endforeach; ?> -->
                        </select>
                        <div class="validation_error"><?php echo form_error('branch_id'); ?></div>
                    </div>
                </div>
                <label class="col-xs-3 text-left">Site</label>
                    <div class="form-group">
                        <div class="col-xs-6">
                            <select class="form-control select2 col-xs-3 col-md-3 col-sm-3 col-lg-3" name="site_id" id="site">
                                <option value="">-- Select Site --</option>
                                <?php foreach ($sites as $site): ?>
                                    <option value="<?php echo $site['id']; ?>"><?php echo $site['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="validation_error"><?php echo form_error('site_id'); ?></div>
                        </div>
                    </div>
                <label class="col-xs-3 text-left">Holiday Type</label>
                <div class="form-group">
                    <div class="col-xs-6">
                        <select class="form-control select2 col-xs-3 col-md-3 col-sm-3 col-lg-3" name="attendance_holiday_type_id" id="holiday_type">
                            <option value="">-- Select Holiday Type --</option>
                            <!-- <?php foreach ($holiday_types as $holiday_type): ?>
                                <option value="<?php echo $holiday_type['id']; ?>"><?php echo $holiday_type['name']; ?></option>
                            <?php endforeach; ?> -->
                        </select>
                        <div class="validation_error"><?php echo form_error('attendance_holiday_type_id'); ?></div>
                    </div>
                    </div>
                    <label class="col-xs-3 text-left">Date</label>
                    <div class="form-group">
                        <div class="col-xs-6">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                <input type="text" name="holiday_date" class="form-control pull-right datepicker" value="<?php echo date('Y-m-d'); ?>">
                            </div>
                            <div class="validation_error"><?php echo form_error('holiday_date'); ?></div>
                        </div>
                     </div>
                    <label class="col-xs-3 text-left" for="name">Name</label>
                    <div class="form-group">
                        <div class="col-xs-6">
                            <input id="name" type="text" name="name" class="form-control" value="<?php echo set_value('name'); ?>">
                            <div class="validation_error"><?php echo form_error('name'); ?></div>
                        </div>
                    </div>
                    <label class="col-xs-3 text-left">Description</label>
                    <div class="form-group">
                        <div class="col-xs-6">
                            <textarea name="description" class="form-control" rows="4" cols="40"><?php echo set_value('description'); ?></textarea>
                            <div class="validation_error"><?php echo form_error('description'); ?></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-offset-3 col-xs-6">
                            <button type="submit" class="<?php echo $btn_submit; ?>">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    var company = $('#company'); 
    var branch = $('#branch');
    var site = $('#site');
    var holiday_type = $('#holiday_type')

    $(document).ready(function() {
        $(company).on('change', function() {
            
            var company_id = $(this).val();
            if (company_id == '') 
            {

            }
            else
            {
                $.ajax({
                    url: BASE_URL + 'holidays/populate_branch',
                    type: 'POST',
                    data: {'company_id' : company_id},
                    dataType: 'json',
                    success: function(data) {
                        $(branch).html(data);
                    },
                    error: function () {
                        alert('Error')
                    }
                });

                $.ajax({
                    url: BASE_URL + 'holidays/populate_holiday',
                    type: 'POST',
                    data: {'company_id' : company_id},
                    dataType: 'json',
                    success: function(data) {
                        $(holiday_type).html(data);
                    },
                    error: function () {
                        alert('Error')
                    }
                });
            }
        });
    }); 

    $(document).ready(function() {
        $(branch).on('change', function() {

            var company_id = $(company).val();
            var branch_id = $(this).val();

            if (branch_id == '')
            {

            }
            else
            {
                $.ajax({
                    url: BASE_URL + 'holidays/populate_site',
                    type: 'POST',
                    data: {'company_id' : company_id, 'branch_id' : branch_id},
                    dataType: 'json',
                    success: function(data) {
                        $(site).html(data);
                    },
                    error: function () {
                        alert('Error')
                    }
                });
            }

        });
    });

</script>
