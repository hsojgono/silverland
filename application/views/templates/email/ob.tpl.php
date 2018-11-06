<html>
    <body>
        <h1>Official Business</h1>
        <p>Requested by: <?php echo $employee_data['first_name'].' '.$employee_data['last_name']; ?></p>
        <p>This is to request my official business travel on <?php echo $ob_data['date']; ?> in 
           <?php echo $account['name'].', '.$ob_data['location']; ?> at <?php echo $ob_data['time_start'].'-'.$ob_data['time_end']; ?> to meet with <?php echo $contact_person['first_name'].' '.$contact_person['last_name'].'.'; ?>

        </p>
        <p></p>
        <p><a href="<?php echo site_url('attendance_official_businesses/approve/'.$ob_id); ?>">APPROVE</a> | <a href="<?php echo site_url('attendance_official_businesses/disapprove/'.$ob_id); ?>">REJECT</a> | <a href="<?php echo site_url('attendance_official_businesses/disapprove/'.$ob_id); ?>">CANCEL</a></p> 
    </body>
</html>
