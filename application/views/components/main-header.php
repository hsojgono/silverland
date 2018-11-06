<header class="main-header">
    <a href="javascript:void(0);" class="logo">
        <span class="logo-mini">
             <img src="<?php echo site_url('assets/img/app/kawani_mini.png'); ?>" alt="Image" width="30" height="30">
        </span>
        <span class="logo-lg">
            <img src="<?php echo site_url('assets/img/app/kawani.png'); ?>" alt="Image" width="150" height="30">
        </span>
    </a>
    <nav class="navbar navbar-static-top" role="navigation">
        <a href="javascript:void(0)" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- <li class="user user-menu">
                    <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="hidden-xs">GIT BRANCH: <?php // echo current_git_branch(); ?></span>
                    </a>
                </li> -->
                <li class="dropdown user user-menu">
                    <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?php echo site_url('assets/img/app/avatar.png'); ?>" class="user-image" alt="User Image">
                        <span class="hidden-xs"><?php echo $user_details->first_name . ' ' . $user_details->last_name; ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <img src="<?php echo site_url('assets/img/app/avatar.png'); ?>" class="img-circle" alt="User Image">
                            <p>
                                <?php echo $user_details->first_name . ' ' . $user_details->last_name; ?>
                                <?php if (is_numeric($user_details->created_on)) { ?>
                                <small>Member since <?php echo date('M d Y', $user_details->created_on); ?></small>
                                <?php } ?>
                                <small><?php echo $user_role; ?></small>
                            </p>
                        </li>
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="<?php echo site_url('auth/change_password'); ?>" class="btn btn-default btn-flat">Change Password</a>
                            </div>
                            <div class="pull-right">
                                <a href="<?php echo site_url('auth/logout'); ?>" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
