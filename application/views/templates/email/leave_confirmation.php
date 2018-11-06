<html>
    <body>
        <h1><?php echo $leave_data['leave_type']; ?> Request</h1>
        <p>Requested by: <?php echo $requester_data['full_name']; ?> - <?php echo $requester_data['employee_code']; ?></p>
        <p>Reason: <?php echo $leave_data['leave_reason']; ?></p>
        <p>Date Start: <?php echo $leave_data['date_start']; ?></p>
        <p>Date End: <?php echo $leave_data['date_end']; ?></p>
        <p>
            Your <?php echo $leave_data['leave_type']; ?> Request has been successfully approved by <?php echo $approver_data['full_name']; ?>.
        </p>
    </body>
</html>
