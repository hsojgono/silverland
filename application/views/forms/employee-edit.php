<div class="row">
    <div class="col-sm-12">
        <div class="pull-right">
            <button type="button" class="btn btn-primary" onclick="saveChanges()"><i class="fa fa-check"></i> Save Changes</button>
        </div>
        <!-- <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#tab-toolbar">Toolbar</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab-toolbar">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="pull-right">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default"><i class="fa fa-plus"></i></button>
                                    <button type="button" class="btn btn-default"><i class="fa fa-minus"></i></button>
                                    <button type="button" class="btn btn-default"><i class="fa fa-edit"></i></button>
                                    <button type="button" class="btn btn-default"><i class="fa fa-bars"></i></button>
                                </div>
                                <button type="button" class="btn btn-info">Some Button</button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-3">
        <div class="box box-primary">
            <div class="box-body box-profile">
                <!-- <p id="msg"></p>
                <input id="uploadFile" type="file"/> -->
                <input type="hidden" id="employeeID" value="<?php echo $employee_id; ?>">
                <a id="uploadLink" style="cursor:pointer">
                    <img class="profile-user-img img-responsive img-circle" src="<?php echo site_url('assets/img/employee/2017/EMPLOYEE-0001.jpg'); ?>" alt="User profile picture">
                </a>
                <h3 class="profile-username text-center"><?php echo $personal_background['personal_information']['full_name']; ?></h3>
                <p class="text-muted text-center">Software Engineer</p>
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>Followers</b> <a class="pull-right">1,322</a>
                    </li>
                    <li class="list-group-item">
                        <b>Following</b> <a class="pull-right">543</a>
                    </li>
                    <li class="list-group-item">
                        <b>Friends</b> <a class="pull-right">13,287</a>
                    </li>
                </ul>
                <a href="javascript:void(0);" class="btn btn-primary btn-block">
                    <i class="fa fa-camera"></i>
                    <b>Change Profile Picture</b>
                </a>
            </div>
        </div>
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">About Me [static data]</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <strong><i class="fa fa-book margin-r-5"></i> Education</strong>
                <p class="text-muted">
                    B.S. in Information Technology from the STI College at Caloocan City, Philippines
                </p>

                <hr>

                <strong><i class="fa fa-map-marker margin-r-5"></i> Address</strong>
                <p class="text-muted">281 int., M.H. Del Pilar St., 5th ave. Grace Park, Brgy. 117, Caloocan City, Philippines</p>

                <hr>

                <strong><i class="fa fa-phone margin-r-5"></i> Contact Number</strong>
                <p class="text-muted">+639068133327</p>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
    <div class="col-md-9">
        <form class="" name="registrationForm" action="<?php echo site_url('employees/save_changes/'.$employee_id); ?>" method="post">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            Personal Background <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li role="presentation"><a data-toggle="tab" href="#tab-personal-information">Personal Information</a></li>
                            <li role="presentation"><a data-toggle="tab" href="#tab-parents-information">Parents Information</a></li>
                            <li role="presentation"><a data-toggle="tab" href="#tab-spouse-information">Spouse Information</a></li>
                            <li role="presentation"><a data-toggle="tab" href="#tab-dependents">Dependents</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            Contact Information <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li role="presentation"><a data-toggle="tab" href="#tab-address">Address</a></li>
                            <li role="presentation"><a data-toggle="tab" href="#tab-contact-numbers">Contact Numbers</a></li>
                            <li role="presentation"><a data-toggle="tab" href="#tab-emergency-contact">Emergency Contact</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            Professional Background <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li role="presentation"><a data-toggle="tab" href="#tab-educational-background">Educational Background</a></li>
                            <li role="presentation"><a data-toggle="tab" href="#tab-employee-skills">Employee Skills</a></li>
                            <li role="presentation"><a data-toggle="tab" href="#tab-work-experiences">Work Experiences</a></li>
                            <li role="presentation"><a data-toggle="tab" href="#tab-employee-trainings">Employee Trainings</a></li>
                            <li role="presentation"><a data-toggle="tab" href="#tab-employee-certifications">Employee Certifications</a></li>
                            <li role="presentation"><a data-toggle="tab" href="#tab-employee-awards">Employee Awards</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            Employment Details <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li role="presentation"><a data-toggle="tab" href="#tab-employment-information">Employment Information</a></li>
                            <li role="presentation"><a data-toggle="tab" href="#tab-positions">Positions</a></li>
                            <li role="presentation"><a data-toggle="tab" href="#tab-salary">Salary</a></li>
                            <li role="presentation"><a data-toggle="tab" href="#tab-benefits">Benefits</a></li>
                        </ul>
                    </li>
                    <!-- <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            Discipline <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li role="presentation"><a data-toggle="tab" href="#tab-violations">Violations</a></li>
                            <li role="presentation"><a data-toggle="tab" href="#tab-sanctions">Sanctions</a></li>
                        </ul>
                    </li>
                    <li><a data-toggle="tab" href="#tab-attachments">Attachments</a></li>
                    <li><a data-toggle="tab" href="#tab-attendance">Attendance</a></li>
                    <li><a data-toggle="tab" href="#tab-payroll">Payroll</a></li> -->
                </ul>
                <div class="tab-content">
                    <?php $this->load->view('forms/employee/tab-personal-information'); ?>
                    <?php $this->load->view('forms/employee/tab-parents-information'); ?>
                    <?php $this->load->view('forms/employee/tab-spouse-information'); ?>
                    <?php $this->load->view('forms/employee/tab-dependents'); ?>
                    <?php $this->load->view('forms/employee/tab-address'); ?>
                    <?php $this->load->view('forms/employee/tab-contact-numbers'); ?>
                    <?php $this->load->view('forms/employee/tab-emergency-contact'); ?>
                    <?php $this->load->view('forms/employee/tab-educational-background'); ?>
                    <?php $this->load->view('forms/employee/tab-employee-skills'); ?>
                    <?php $this->load->view('forms/employee/tab-work-experiences'); ?>
                    <?php $this->load->view('forms/employee/tab-employee-trainings'); ?>
                    <?php $this->load->view('forms/employee/tab-employee-certifications'); ?>
                    <?php $this->load->view('forms/employee/tab-employee-awards'); ?>
                    <?php $this->load->view('forms/employee/tab-employment-information'); ?>
                    <?php $this->load->view('forms/employee/tab-positions'); ?>
                    <?php $this->load->view('forms/employee/tab-salary'); ?>
                    <?php $this->load->view('forms/employee/tab-benefits'); ?>
                    <?php $this->load->view('forms/employee/tab-violations'); ?>
                    <?php $this->load->view('forms/employee/tab-sanctions'); ?>
                    <?php $this->load->view('forms/employee/tab-attachments'); ?>
                    <?php $this->load->view('forms/employee/tab-attendance'); ?>
                    <?php $this->load->view('forms/employee/tab-payroll'); ?>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="<?php echo site_url('assets/js/employee-profile-image.js'); ?>" charset="utf-8"></script>
<script>

    function saveChanges()
    {
        console.log('saving changes....');

        document.registrationForm.submit();
    }

	$('#function-menu > ul.dropdown-menu li').on('click', function (evt) {
		evt.preventDefault();
	});

    $('.datepicker').datepicker({
        format:'yyyy-mm-dd'
    });
</script>
