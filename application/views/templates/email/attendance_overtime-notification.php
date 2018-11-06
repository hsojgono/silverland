<html>
    <body>
        <h1>Overtime</h1>
        <p>Requested by: <?php echo $employee_data['first_name'].' '.$employee_data['last_name']; ?></p>
        <p>Date:  <?php echo date('F d, Y', strtotime($ot_data['date'])); ?></p>
        <p>Time Start:  <?php echo date('h:i A',strtotime($ot_data['time_start'])); ?></p>
        <p>Time End:    <?php echo date('h:i A', strtotime($ot_data['time_end'])); ?></p>
        <p>Reason:    <?php echo $ot_data['reason']; ?></p>
        
        <p>This is to request the approval for my overtime on the said schedule stated above.

        </p>
        <p></p>
        <p><a href="<?php echo site_url('overtimes/approve/'.$ot_id); ?>">APPROVE</a> | <a href="<?php echo site_url('overtimes/reject/'.$ot_id); ?>">DISAPPROVE</a> | <a href=" <?php echo site_url('overtimes/cancel/'.$ot_id); ?> ">CANCEL</a></p>
    </body>
</html>
