<html>
    <body>
        <h1>Official Business</h1>
        <p>Requested by: <?php echo $employee_data['first_name'].' '.$employee_data['last_name']; ?></p>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        <p>Do you want to approve? <a href="<?php echo site_url('welcome/approve/'.$ob_id); ?>">YES</a> | <a href="<?php echo site_url('welcome/disapprove/'.$ob_id); ?>">NO</a></p>
    </body>
</html>
