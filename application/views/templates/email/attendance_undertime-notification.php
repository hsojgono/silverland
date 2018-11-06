<html>

	<body>
        <h1>Undertime</h1>
        <p>Requested by: <?php echo $employee_data['first_name'].' '.$employee_data['last_name']; ?></p>
        <p>This is to request the approval for my undertime on <?php echo $ut_data['date']; ?> at 
          <?php echo $ut_data['time_start'].'-'.$ut_data['time_end']; ?> 

        </p>
        <p></p>
        <p><a href=" <?php echo site_url('undertimes/approve/'.$ut_id); ?> ">APPROVE</a> | <a href="<?php echo site_url('undertimes/reject/'.$ut_id); ?>">DISAPPROVE</a> | <a href=" <?php echo site_url('undertimes/cancel/'.$ut_id); ?> ">CANCEL</a></p>
    </body>

</html>