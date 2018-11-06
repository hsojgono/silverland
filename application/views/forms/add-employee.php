<div class="row">
    <div class="col-sm-12">
        <div class="box box-primary">
            <div class="box-header with-border"><h4 class="box-title">FILL UP ALL FIELDS</h4></div>
            <div class="box-body">
                <form action="<?php echo site_url('employees/add'); ?>" class="form-horizontal" method="post">
                    <div class="form-group ">
                        <label class="control-label col-sm-2" for="company_id">
                            Company <span class="asteriskField">*</span>
                        </label>
                        <div class="col-sm-9">
                            <select class="select form-control" id="company_id" name="company_id">
                                <option value="">-- Select Company --</option>
                                <?php foreach ($companies as $company): ?>
                                    <option value="<?php echo $company['id']; ?>"><?php echo $company['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="validation_error"><?php echo form_error('company_id'); ?></div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label class="control-label col-sm-2 requiredField" for="first_name">
                            First Name <span class="asteriskField">*</span>
                        </label>
                        <div class="col-sm-9">
                            <input class="form-control" id="first_name" name="first_name" placeholder="First name" type="text"/>
                            <div class="validation_error"><?php echo form_error('first_name'); ?></div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label class="control-label col-sm-2 requiredField" for="middle_name">
                            Middle Name <span class="asteriskField">*</span>
                        </label>
                        <div class="col-sm-9">
                            <input class="form-control" id="middle_name" name="middle_name" placeholder="Middle Name" type="text"/>
                            <div class="validation_error"><?php echo form_error('middle_name'); ?></div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label class="control-label col-sm-2 requiredField" for="last_name">
                            Last Name <span class="asteriskField">*</span>
                        </label>
                        <div class="col-sm-9">
                            <input class="form-control" id="last_name" name="last_name" placeholder="Last Name" type="text"/>
                            <div class="validation_error"><?php echo form_error('last_name'); ?></div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label class="control-label col-sm-2" for="email">
                            Email Address
                        </label>
                        <div class="col-sm-9">
                            <input class="form-control" id="email" name="email" placeholder="example@example.com" type="text"/>
                            <div class="validation_error"><?php echo form_error('email'); ?></div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label class="control-label col-sm-2" for="position_id">
                            Position
                        </label>
                        <div class="col-sm-9">
                            <select class="select form-control" id="position_id" name="position_id">
                                <option value="">-- Select Position --</option>
                                <?php foreach ($positions as $position): ?>
                                    <option value="<?php echo $position['id']; ?>"><?php echo $position['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="validation_error"><?php echo form_error('position_id'); ?></div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label class="control-label col-sm-2" for="reports_to">
                            Reports To:
                        </label>
                        <div class="col-sm-9">
                            <select class="select2 form-control" id="reports_to" name="reports_to">
                                <!-- <input class="form-control" id="email" name="email" placeholder="example@example.com" type="text"/> -->
                                <option value="">-- Select Superior --</option>
                                <?php foreach ($employees as $employee): ?>
                                    <option value="<?php echo $employee['employee_id']; ?>"><?php echo $employee['employee_code'] . ' - ' . $employee['full_name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="validation_error"><?php echo form_error('reports_to'); ?></div>
                        </div>
                    </div>

                    <div class="form-group ">
                        <label class="control-label col-sm-2" for="email">
                            Monthly Salary
                        </label>
                        <div class="col-sm-9">
                            <input class="form-control" id="monthly_salary" name="monthly_salary" type="text" />
                            <div class="validation_error"><?php echo form_error('monthly_salary'); ?></div>
                        </div>
                    </div>
                    <!-- <div class="form-group ">
                        <label class="control-label col-sm-2" for="email">
                            Benefits
                        </label>
                        <div class="col-sm-9">
                            <ul id="available-benefits">
                            </ul>
                        </div>
                    </div> -->

                    <div id="hidden-elements">

                    </div>
                    
                    <div class="form-group">
                        <div class="col-sm-9 col-sm-offset-2">
                            <input type="hidden" name="save" value="add">
                            <button class="btn btn-primary btn-block" name="submit" type="submit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-message">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">Message</div>
            <div class="modal-body">
                <p id="message"></p>
            </div>
        </div>
    </div>
</div>

<style>
    .tabcontrol > .content {
        position: relative;
        display: inline-block;
        width: 100%;
        height: 25em;
        overflow: auto;
        border-top: 1px solid #bbb;
        padding-top: 20px;
    }
</style>
<script>
    $(function() {
        var positionID = $('#position_id');
        var monthlySalary = $('#monthly_salary');
        var availableBenefits = $('#available-benefits');
        var hiddenElements = $('#hidden-elements');
        var modalMessage = $('#modal-message');

        positionID.on('change', getPositionCompensationPackage);

        function getPositionCompensationPackage() {

            var dataParam = {
                position_id: positionID.val()
            };

            $.ajax({
                url: BASE_URL + 'employees/position_compensation_package',
                method: 'POST',
                data: dataParam,
                dataType: 'json',
                success: function (response) {

                    if (response.message)
                        toastr.error(response.message);

                    var comp_package   = response.compensation_package;
                    var salary_package = comp_package.salary;
                    var benefits_package = comp_package.benefits;

                    monthlySalary.val(salary_package.monthly_salary);

                    $("#available-benefits > li").remove();
                    $("#hidden-elements > input").remove();

                    availableBenefits
                     .css({opacity:0, marginTop:200})
                     .removeClass()
                     .stop(true, false)
                     .animate({
                         "margin-top": "10px",
                         "opacity": "1"
                     }, 300);

                    $.each(benefits_package, function(index, value) {
                        hiddenElements.append("<input type='hidden' name='benefit_ids[]' value='"+value.benefit_id+"'>");
                        availableBenefits.append("<li>"+value.benefit_name+" - "+value.amount+"</li>");
                    });
                }
            });
        }
    });
</script>