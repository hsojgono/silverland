<div class="row">
    <div class="col-md-3">
        <div class="box box-primary">
            <div class="box-body box-profile">
                <!-- <p id="msg"></p>
                <input id="uploadFile" type="file"/> -->
                <input type="hidden" id="employeeID" value="<?php echo $employee_id; ?>">
                <a id="uploadLink" style="cursor:pointer">
                    <!-- <img class="profile-user-img img-responsive img-circle" src="<?php echo site_url('assets/img/employee/2017/EMPLOYEE-0001.jpg'); ?>" alt="User profile picture"> -->
                    <img class="profile-user-img img-responsive img-circle" src="<?php echo site_url('assets/img/app/kawani_mini.png'); ?>" alt="User profile picture">
                </a>
                <!-- <h3 class="profile-username text-center">Upload Picture</h3> -->
                <h3 class="profile-username text-center"><?php echo $personal_information['full_name']; ?></h3>
                <p class="text-muted text-center"><?php echo isset($employment_information[0]['position']) ? $employment_information[0]['position'] : ''; ?></p>
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>Employee Code</b> <a class="pull-right"><?php echo $personal_information['employee_code']; ?></a>
                    </li>
                    <li class="list-group-item">
                        <b>Department</b> <a class="pull-right"><?php echo isset($employment_information[0]['department']) ? $employment_information[0]['department'] : ''; ?></a>
                    </li>
                    <li class="list-group-item">
                        <b>Date Hired</b> <a class="pull-right"><?php echo $employment_information[0]['date_hired'] ? date('M d, Y', strtotime($employment_information[0]['date_hired'])) : ''; ?></a>
                        
                    </li>
                    <li class="list-group-item">
                        <b>Status</b> <a class="pull-right"><?php echo isset($employment_information[0]['regularization_label']) ? $employment_information[0]['regularization_label'] : ''; ?></a>
                        <b></b>
                    </li>
                   
                </ul>
                <!-- <a href="javascript:void(0);" class="btn btn-primary btn-block">
                    <i class="fa fa-camera"></i>
                    <b>Change Profile Picture</b>
                </a> -->
            </div>
        </div>
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">About Me</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <strong><i class="fa fa-birthday-cake"></i> Birthday</strong>
                
                <p class="text-muted">
                    <?php echo date('M d, Y', strtotime($personal_information['birthdate'])); ?>
                </p>

                <hr>

                <strong><i class="fa fa-map-marker margin-r-5"></i> Address</strong>
                <p class="text-muted">
                    <?php echo isset($employee_adresses[0]['full_address']) ? $employee_adresses[0]['full_address'] : ''; ?> 
                </p>

                <hr>

                <strong><i class="fa fa-phone margin-r-5"></i> Contact Number</strong>      
                <p class="text-muted">
                     <?php echo isset($employee_contacts[0]['employee_mobile_number']) ? $employee_contacts[0]['employee_mobile_number'] : ''; ?>
                </p>

                <hr>

                <strong><i class="fa fa-book margin-r-5"></i> Education</strong>
                <p class="text-muted">
            
                    Studied <?php echo $education['ec_desc']; ?> at  <?php echo $education['school']; ?> on 
                    <?php echo $education['year_start']; ?>-<?php echo $education['year_end']; ?>
                </p>

                <hr>
                
                <strong><i class="fa fa-book margin-r-5"></i> GOVERNMENT IDs</strong>
                <p class="text-muted">
                    TIN: <?php echo isset($government_id_number[0]['tin']) ? $government_id_number[0]['tin'] : ''; ?>
                </p>
                <p class="text-muted">
                    SSS: <?php echo isset($government_id_number[0]['sss']) ? $government_id_number[0]['sss'] : ''; ?>
                </p>
                
                <p class="text-muted">
                    PHIC: <?php echo isset($government_id_number[0]['phic']) ? $government_id_number[0]['phic'] : '' ?>
                </p>
                
                <p class="text-muted">
                    HDMF: <?php echo isset($government_id_number[0]['hdmf']) ? $government_id_number[0]['hdmf'] : '' ?>
                </p>

                <hr>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
    <div class="col-md-9">

        <?php $civil_status_id = $personal_information['civil_status_id']; ?>
        <?php $index_id = array_search($civil_status_id, array_column($civil_status, 'id')); ?>
        <?php $civil_status = $civil_status[$index_id]['status_name']; ?>

        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        Personal Background <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li role="presentation"><a data-toggle="tab" href="#tab-personal-information">Personal Information</a></li>
                        <li role="presentation"><a data-toggle="tab" href="#tab-parents-information">Parents Information</a></li>
                        <?php if ($civil_status != 'SINGLE'): ?>
                        <li role="presentation"><a data-toggle="tab" href="#tab-spouse-information">Spouse Information</a></li>
                        <?php endif; ?>
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
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        Attendance <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                <li role="presentation"><a data-toggle="tab" href="#tab-daily-time-records">Daily Time Records</a></li>
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
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        Payroll <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                <li><a data-toggle="tab" href="#tab-employee-payslips">Payslip</a></li>
                <li role="presentation"><a data-toggle="tab" href="#tab-loans">Loans</a></li>                
            </ul>
            </li>
            
            <div class="tab-content">
                <?php $this->load->view('partials/employee/details/tab-personal-information'); ?>
                <?php $this->load->view('partials/employee/details/tab-parents-information'); ?>
                <?php $this->load->view('partials/employee/details/tab-spouse-information'); ?>
                <?php $this->load->view('partials/employee/details/tab-dependents'); ?>
                <?php $this->load->view('partials/employee/details/tab-address'); ?>
                <?php $this->load->view('partials/employee/details/tab-contact-numbers'); ?>
                <?php $this->load->view('partials/employee/details/tab-emergency-contact'); ?>
                <?php $this->load->view('partials/employee/details/tab-educational-background'); ?>
                <?php $this->load->view('partials/employee/details/tab-employee-skills'); ?>
                <?php $this->load->view('partials/employee/details/tab-work-experiences'); ?>
                <?php $this->load->view('partials/employee/details/tab-employee-trainings'); ?>
                <?php $this->load->view('partials/employee/details/tab-employee-certifications'); ?>
                <?php $this->load->view('partials/employee/details/tab-employee-awards'); ?>
                <?php $this->load->view('partials/employee/details/tab-employment-information'); ?>
                <?php $this->load->view('partials/employee/details/tab-positions'); ?>
                <?php $this->load->view('partials/employee/details/tab-salary'); ?>
                <?php $this->load->view('partials/employee/details/tab-benefits'); ?>
                <?php $this->load->view('partials/employee/details/tab-violations'); ?>
                <?php $this->load->view('partials/employee/details/tab-sanctions'); ?>
                <?php $this->load->view('partials/employee/details/tab-attachments'); ?>
                <?php $this->load->view('partials/employee/details/tab-attendance'); ?>
                <?php $this->load->view('partials/employee/details/tab-employment-information'); ?>
                <?php $this->load->view('partials/employee/details/tab-daily-time-records'); ?>
                <?php $this->load->view('partials/employee/details/tab-payroll'); ?>
                <?php $this->load->view('partials/employee/details/tab-employee-payslips'); ?>                
                <?php $this->load->view('partials/employee/details/tab-loans'); ?>                
            </div>
        </div>

        <?php if ($show_edit_modal): ?>
        <script>
            $(document).ready(function(){
                $('#modal-edit').modal({
                    show     : true,
                    keyboard : false,
                    backdrop : false
                });
            });
        </script>
        <div class="modal fade" id="modal-edit">
            <div class="modal-dialog">
                <div class="modal-content">
                    <?php $this->load->view($modal_content); ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>
<script src="<?php echo site_url('assets/js/employee-profile-image.js'); ?>" charset="utf-8"></script>
<script>
	$('#function-menu > ul.dropdown-menu li').on('click', function (evt) {
		evt.preventDefault();
	});
</script>
