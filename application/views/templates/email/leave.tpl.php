<html>
    <body>
        <h1><?php echo $leave_data['leave_type']; ?> - Request</h1>
        <p>Requested by: <?php echo $requester_data['full_name']; ?> - <?php echo $requester_data['employee_code']; ?></p>
        <p>Reason: <?php echo $leave_data['leave_reason']; ?></p>
        <p>Date Start: <?php echo $leave_data['date_start']; ?></p>
        <p>Date End: <?php echo $leave_data['date_end']; ?></p>
        <p>
        	This is to request my <?php echo $leave_data['leave_type']; ?> on <?php echo date('F j, Y', strtotime($leave_data['date_start'])).' - '.date('F j, Y', strtotime($leave_data['date_end'])); ?> for a total of <?php echo $leave_days_request; ?> days.
        </p>
        <a href="<?php echo site_url('leave_confirmations/approve/'.$leave_data['id']); ?>">APPROVE</a> | <a href="<?php echo site_url('leave_confirmations/disapprove/'.$leave_data['id']); ?>">REJECT</a> <!-- | <a href="<?php echo site_url('attendance_leaves/disapprove/'.$leave_data['id']); ?>">CANCEL</a> --></p>
    </body>
</html>
