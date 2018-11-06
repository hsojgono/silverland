<?php //dump($selected_employee); ?>
<div class="well">
    <ul>
        <li><label>EMPLOYEE CODE:</label> <?php echo $selected_employee['employee_code']; ?></li>
        <li><label>RMPLOYEE FULL NAME:</label> <?php echo $selected_employee['full_name']; ?></li>
        <li><label>COMPANY NAME:</label> <?php echo $selected_employee['company_name']; ?></li>
        <li><label>DEPARTMENT:</label> <?php echo $selected_employee['department_name']; ?></li>
        <li><label>POSITION:</label> <?php echo $selected_employee['position_name']; ?></li>
        <li><label>STATUS:</label> <?php echo $selected_employee['label_status']; ?></li>
    </ul>
</div>
<!-- <a href="<?php // echo site_url('attendance_daily_time_records/time_in/' . $selected_employee['id']); ?>" class="btn btn-info">TRIGGER TIME IN</a> -->
<a href="<?php echo site_url('attendance_daily_time_records/time_out/' . $selected_employee['id']); ?>" class="btn btn-danger">TRIGGER TIME OUT</a>