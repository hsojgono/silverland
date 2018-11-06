<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Name:
 *
 * Version: 2.0.1
 *
 * Author: Cristhian Kevin Sagun
 * 		  cristhiansagun@gmail.com
 *
 *
 * Created:  01.01.2016
 *
 * Requirements: PHP5 or above
 *
 */
$config['app_version'] = 'Beta 1.0.1';

/**
 * LAYOUT COLOR
 *
 * skin-blue
 * skin-black
 * skin-purple
 * skin-yellow
 * skin-red
 * skin-green
 * ---------------------------------------------------------------------------
 * LAYOUT OPTION
 *
 * fixed
 * layout-boxed
 * layout-top-nav
 * sidebar-collapse
 * sidebar-mini
 */
$config['layout_settings']['layout_color'] = 'skin-blue';
$config['layout_settings']['layout_option'] = 'sidebar-collapse sidebar-mini';

/**
 * Button colors
 *
 * btn-default = light gray
 * btn-primary = blue
 * btn-info 	= light blue
 * btn-success = green
 * btn-warning = yellow / orange
 * btn-danger 	= red
 * btn-link 	= <a href> link
 */
// Common Buttons Settings
$config['btn_settings']['btn_add']      = 'btn btn-flat btn-md btn-primary';
$config['btn_settings']['btn_edit']     = 'btn btn-flat btn-primary';
$config['btn_settings']['btn_view']     = 'btn btn-flat btn-link';
$config['btn_settings']['btn_update']   = 'btn btn-flat btn-link';
$config['btn_settings']['btn_submit']   = 'btn btn-flat btn-primary btn-block';
$config['btn_settings']['btn_delete']   = 'btn btn-flat btn-danger';
$config['btn_settings']['btn_activate'] = 'btn btn-flat btn-link';
$config['btn_settings']['btn_checkin']  = 'btn btn-link';
$config['btn_settings']['btn_ok']       = 'btn btn-flat btn-primary';
$config['btn_settings']['btn_yes']      = '';
$config['btn_settings']['btn_no']       = '';

// Main Layout Components Settings
$config['main_components']['main_header']  = 'main-header';
$config['main_components']['main_footer']  = 'main-footer';
$config['main_components']['main_sidebar'] = 'main-sidebar';
$config['main_components']['main_control_sidebar'] = 'main-control-sidebar';

// Attendance Summary Vars
$config['attendance_summary_vars'] = array(
    'number_of_hours',
    'unpaid_leaves',
    'minutes_tardy',
    'minutes_undertime',
    'minutes_nightdiff',
    'minutes_ot',
    'minutes_ot_nightdiff',
    'minutes_hday_reg',
    'minutes_hday_reg_nightdiff',
    'minutes_hday_reg_ot',
    'minutes_hday_reg_ot_nightdiff',
    'minutes_hday_spcl',
    'minutes_hday_spcl_nightdiff',
    'minutes_hday_spcl_ot',
    'minutes_hday_spcl_ot_nightdiff',
    'minutes_rest',
    'minutes_rest_nightdiff',
    'minutes_rest_ot',
    'minutes_rest_ot_nightdiff',
    'minutes_rest_hday_reg',
    'minutes_rest_hday_reg_nightdiff',
    'minutes_rest_hday_reg_ot',
    'minutes_rest_hday_reg_ot_nightdiff',
    'minutes_rest_hday_spcl',
    'minutes_rest_hday_spcl_nightdiff',
    'minutes_rest_hday_spcl_ot',
    'minutes_rest_hday_spcl_ot_nightdiff'
);

