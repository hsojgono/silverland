<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config = array(
	'company_add' => array(
		array('field' => 'name', 'label' => 'Company Name', 'rules' => 'trim|required'),
		array('field' => 'short_name', 'label' => 'Company Code', 'rules' => 'trim|required'),
		array('field' => 'description', 'label' => 'Company Description', 'rules' => 'trim|required')
	),
	'company_edit' => array(
		array('field' => 'name', 'label' => 'Company Name', 'rules' => 'trim|required'),
		array('field' => 'short_name', 'label' => 'Company Code', 'rules' => 'trim|required'),
		array('field' => 'description', 'label' => 'Company Description', 'rules' => 'trim|required')
	),
	'branch_add' => array(
		array('field' => 'name', 'label' => 'Branch Name', 'rules' => 'trim|required'),
		array('field' => 'company_id', 'label' => 'Company', 'rules' => 'trim|required'),
		array('field' => 'description', 'label' => 'Description', 'rules' => 'trim'),
		array('field' => 'block_number', 'label' => 'Block Number', 'rules' => 'trim'),
		array('field' => 'lot_number', 'label' => 'Lot Number', 'rules' => 'trim'),
		array('field' => 'floor_number', 'label' => 'Floor Number', 'rules' => 'trim'),
		array('field' => 'building_number', 'label' => 'Building Number', 'rules' => 'trim'),
		array('field' => 'building_name', 'label' => 'Building Name', 'rules' => 'trim'),
		array('field' => 'street', 'label' => 'Street', 'rules' => 'trim')
	),
	'branch_edit' => array(
		array('field' => 'name', 'label' => 'Branch Name', 'rules' => 'trim|required'),
		array('field' => 'company_id', 'label' => 'Company', 'rules' => 'trim|required'),
		array('field' => 'description', 'label' => 'Description', 'rules' => 'trim'),
		array('field' => 'block_number', 'label' => 'Block Number', 'rules' => 'trim'),
		array('field' => 'lot_number', 'label' => 'Lot Number', 'rules' => 'trim'),
		array('field' => 'floor_number', 'label' => 'Floor Number', 'rules' => 'trim'),
		array('field' => 'building_number', 'label' => 'Building Number', 'rules' => 'trim'),
		array('field' => 'building_name', 'label' => 'Building Name', 'rules' => 'trim'),
		array('field' => 'street', 'label' => 'Street', 'rules' => 'trim')
	),
	'department_add' => array(
		array('field' => 'name', 'label' => 'Department Name', 'rules' => 'trim|required'),
		array('field' => 'description', 'label' => 'Description', 'rules' => 'trim'),
		array('field' => 'company_id', 'label' => 'Company', 'rules' => 'trim'),
		array('field' => 'branch_id', 'label' => 'Branch', 'rules' => 'trim'),
		array('field' => 'site_id', 'label' => 'Site', 'rules' => 'trim'),
		array('field' => 'floor_number', 'label' => 'Floor Number', 'rules' => 'trim')
	),
	'department_edit' => array(
		array('field' => 'name', 'label' => 'Branch Name', 'rules' => 'trim|required'),
		array('field' => 'description', 'label' => 'Description', 'rules' => 'trim')
	),
	'employment_type_add' => array(
		array('field' => 'type_name', 'label' => 'Type Name', 'rules' => 'trim|required'),
		array('field' => 'description', 'label' => 'Description', 'rules' => 'trim')
	),
	'employment_type_add' => array(
		array('field' => 'type_name', 'label' => 'Type Name', 'rules' => 'trim|required'),
		array('field' => 'description', 'label' => 'Description', 'rules' => 'trim')
	),
	'site_add' => array(
		array('field' => 'company_id', 'label' => 'Company', 'rules' => 'trim|required'),
		array('field' => 'branch_id', 'label' => 'Branch', 'rules' => 'trim|required'),
		array('field' => 'name', 'label' => 'Site Name', 'rules' => 'trim|required'),
		array('field' => 'description', 'label' => 'Description', 'rules' => 'trim'),
		array('field' => 'block_number', 'label' => 'Block Number', 'rules' => 'trim'),
		array('field' => 'lot_number', 'label' => 'Lot Number', 'rules' => 'trim'),
		array('field' => 'floor_number', 'label' => 'Floor Number', 'rules' => 'trim'),
		array('field' => 'building_number', 'label' => 'Building Number', 'rules' => 'trim'),
		array('field' => 'building_name', 'label' => 'Building Name', 'rules' => 'trim'),
		array('field' => 'street', 'label' => 'Street', 'rules' => 'trim'),
		array('field' => 'location_id', 'label' => 'Location Id', 'rules' => 'trim')
	),
	'site_edit' => array(
		array('field' => 'company_id', 'label' => 'Company', 'rules' => 'trim|required'),
		array('field' => 'branch_id', 'label' => 'Branch', 'rules' => 'trim|required'),
		array('field' => 'name', 'label' => 'Site Name', 'rules' => 'trim|required'),
		array('field' => 'description', 'label' => 'Description', 'rules' => 'trim|required'),
		array('field' => 'block_number', 'label' => 'Block Number', 'rules' => 'trim'),
		array('field' => 'lot_number', 'label' => 'Lot Number', 'rules' => 'trim'),
		array('field' => 'floor_number', 'label' => 'Floor Number', 'rules' => 'trim'),
		array('field' => 'building_number', 'label' => 'Building Number', 'rules' => 'trim'),
		array('field' => 'building_name', 'label' => 'Building Name', 'rules' => 'trim'),
		array('field' => 'street', 'label' => 'Street', 'rules' => 'trim'),
		array('field' => 'location_id', 'label' => 'Location Id', 'rules' => 'trim')
	),
	'ob_add' => array(
		array('field' => 'account_id', 'label' => 'Account', 'rules' => 'trim'),
		array('field' => 'employee_id', 'label' => 'Employee', 'rules' => 'trim'),
		array('field' => 'contact_person_id', 'label' => 'Client', 'rules' => 'trim'),
		array('field' => 'agenda', 'label' => 'Agenda', 'rules' => 'trim'),
		array('field' => 'location', 'label' => 'Location', 'rules' => 'trim'),
		array('field' => 'date', 'label' => 'OB Date', 'rules' => 'trim|required'),
		array('field' => 'time_start', 'label' => 'Time Start', 'rules' => 'trim|required'),
		array('field' => 'time_end', 'label' => 'Time End', 'rules' => 'trim|required')
	),
	'ob_edit' => array(
		array('field' => 'account_id', 'label' => 'Account', 'rules' => 'trim'),
		array('field' => 'employee_id', 'label' => 'Employee', 'rules' => 'trim'),
		array('field' => 'contact_person_id', 'label' => 'Client', 'rules' => 'trim'),
		array('field' => 'agenda', 'label' => 'Agenda', 'rules' => 'trim'),
		array('field' => 'location', 'label' => 'Location', 'rules' => 'trim'),
		array('field' => 'date', 'label' => 'OB Date', 'rules' => 'trim|required'),
		array('field' => 'time_start', 'label' => 'Time Start', 'rules' => 'trim|required'),
		array('field' => 'time_end', 'label' => 'Time End', 'rules' => 'trim|required')
	),

	'add_module' => array(
		array('field' => 'name','label' => 'Module Name', 'rules' => 'trim|required|alpha'),
		array('field' => 'description','label' => 'Description', 'rules' => 'trim'),
		array('field' => 'link','label' => 'Link', 'rules' => 'trim')
	),

	'edit_module' => array(
		array('field' => 'name','label' => 'Module Name', 'rules' => 'trim|required|alpha'),
		array('field' => 'description','label' => 'Description', 'rules' => 'trim'),
		array('field' => 'link','label' => 'Link', 'rules' => 'trim')
	),

	'add_employee' => array(
		array('field' => 'first_name', 'label' => 'First Name', 'rules' => 'trim|required'),
		array('field' => 'middle_name', 'label' => 'Middle Name', 'rules' => 'trim'),
		array('field' => 'last_name', 'label' => 'Last Name', 'rules' => 'trim|required'),
		array('field' => 'email', 'label' => 'Email Address', 'rules' => 'trim|required|valid_email|is_unique[system_users.email]'),
		array('field' => 'position_id', 'label' => 'Position', 'rules' => 'trim|required'),
		array('field' => 'monthly_salary', 'label' => 'Monthly Salary', 'rules' => 'trim'),
		array('field' => 'reports_to', 'label' => 'Reports To', 'rules' => 'trim|required'),
		array('field' => 'company_id', 'label' => 'Company', 'rules' => 'trim|required'),
	),

	'leave_type_add' => array(
		array('field' => 'name', 'label' => 'Leave Type', 'rules' => 'trim|required'),
		array('field' => 'description', 'label' => 'Description', 'rules' => 'trim')
	),

	'leave_type_edit' => array(
		array('field' => 'name', 'label' => 'Leave Type', 'rules' => 'trim|required'),
		array('field' => 'description', 'label' => 'Description', 'rules' => 'trim')
	),

	'leave_add' => array(
		array('field' => 'attendance_leave_type_id', 'label' => 'Leave Type', 'rules' => 'trim|required'),
		array('field' => 'date_start', 'label' => 'Date Start', 'rules' => 'trim|required'),
		array('field' => 'date_end', 'label' => 'Date End', 'rules' => 'trim|required'),
		array('field' => 'reason', 'label' => 'Reason', 'rules' => 'trim'),
		array('field' => 'payment_status', 'label' => 'Payment Status', 'rules' => 'trim|required'),
	),

	'leave_edit' => array(
		array('field' => 'attendance_leave_type_id', 'label' => 'Leave Type', 'rules' => 'trim|required'),
		array('field' => 'date_start', 'label' => 'Date Start', 'rules' => 'trim|required'),
		array('field' => 'date_end', 'label' => 'Date End', 'rules' => 'trim|required'),
		array('field' => 'reason', 'label' => 'Reason', 'rules' => 'trim')
	),

	'overtime_add' => array(
		array('field' => 'employee_id', 'label' => 'Leave Type', 'rules' => 'trim'),
		array('field' => 'date', 'label' => 'Overtime Date', 'rules' => 'trim|required'),
		array('field' => 'time_start', 'label' => 'Time Start', 'rules' => 'trim|required'),
		array('field' => 'time_end', 'label' => 'Time End', 'rules' => 'trim|required'),
		array('field' => 'reason', 'label' => 'Reason', 'rules' => 'trim')
	),

	'overtime_edit' => array(
		array('field' => 'employee_id', 'label' => 'Leave Type', 'rules' => 'trim'),
		array('field' => 'date', 'label' => 'Overtime Date', 'rules' => 'trim|required'),
		array('field' => 'time_start', 'label' => 'Time Start', 'rules' => 'trim|required'),
		array('field' => 'time_end', 'label' => 'Time End', 'rules' => 'trim|required'),
		array('field' => 'reason', 'label' => 'Reason', 'rules' => 'trim')
	),

	'undertime_add' => array(
		array('field' => 'employee_id', 'label' => 'Employee', 'rules' => 'trim'),
		array('field' => 'date', 'label' => 'Undertime Date', 'rules' => 'trim|required'),
		array('field' => 'time_start', 'label' => 'Time Start', 'rules' => 'trim|required'),
		array('field' => 'time_end', 'label' => 'Time End', 'rules' => 'trim|required'),
		array('field' => 'reason', 'label' => 'Reason', 'rules' => 'trim')
	),

	'undertime_edit' => array(
		array('field' => 'employee_id', 'label' => 'Employee', 'rules' => 'trim'),
		array('field' => 'date', 'label' => 'Undertime Date', 'rules' => 'trim|required'),
		array('field' => 'time_start', 'label' => 'Time Start', 'rules' => 'trim|required'),
		array('field' => 'time_end', 'label' => 'Time End', 'rules' => 'trim|required'),
		array('field' => 'reason', 'label' => 'Reason', 'rules' => 'trim')
	),

	'cost_center_add' => array(
		array('field' => 'name', 'label' => 'Cost Center Name', 'rules' => 'trim|required'),
		array('field' => 'description', 'label' => 'Description', 'rules' => 'trim|required'),
		array('field' => 'company_id', 'label' => 'Company', 'rules' => 'trim|required'),
		array('field' => 'branch_id', 'label' => 'Branch', 'rules' => 'trim|required'),
		array('field' => 'department_id', 'label' => 'Department', 'rules' => 'trim|required'),
		array('field' => 'team_id', 'label' => 'Team', 'rules' => 'trim')
	),

	'cost_center_edit' => array(
		array('field' => 'name', 'label' => 'Cost Center Name', 'rules' => 'trim|required'),
		array('field' => 'description', 'label' => 'Description', 'rules' => 'trim|required'),
		array('field' => 'company_id', 'label' => 'Company', 'rules' => 'trim|required'),
		array('field' => 'branch_id', 'label' => 'Branch', 'rules' => 'trim|required'),
		array('field' => 'department_id', 'label' => 'Department', 'rules' => 'trim|required'),
		array('field' => 'team_id', 'label' => 'Team', 'rules' => 'trim')
	),

	'bank_add' => array(
		array('field' => 'name', 'label' => 'Bank', 'rules' => 'trim|required'),
		array('field' => 'address', 'label' => 'Address', 'rules' => 'trim'),
		array('field' => 'contact_person', 'label' => 'Contact Person', 'rules' => 'trim'),
		array('field' => 'contact_number', 'label' => 'Contact Number', 'rules' => 'trim'),
		array('field' => 'description', 'label' => 'Description', 'rules' => 'trim')
	),

	'bank_edit' => array(
		array('field' => 'name', 'label' => 'Bank', 'rules' => 'trim|required'),
		array('field' => 'address', 'label' => 'Address', 'rules' => 'trim'),
		array('field' => 'contact_person', 'label' => 'Contact Person', 'rules' => 'trim'),
		array('field' => 'contact_number', 'label' => 'Contact Number', 'rules' => 'trim'),
		array('field' => 'description', 'label' => 'Description', 'rules' => 'trim')
	),

	'holiday_type_add' => array(
		array('field' => 'name', 'label' => 'Holiday', 'rules' => 'trim|required'),
		array('field' => 'description', 'label' => 'Description', 'rules' => 'trim'),
		array('field' => 'company_id', 'label' => 'Company', 'rules' => 'trim|required')
	),

	'holiday_type_edit' => array(
		array('field' => 'name', 'label' => 'Holiday', 'rules' => 'trim|required'),
		array('field' => 'description', 'label' => 'Description', 'rules' => 'trim'),
		array('field' => 'company_id', 'label' => 'Company', 'rules' => 'trim|required')
	),

	'holiday_add' => array(
		array('field' => 'attendance_holiday_type_id', 'label' => 'Holiday', 'rules' => 'trim|required'),
		array('field' => 'holiday_date', 'label' => 'Holiday Date', 'rules' => 'trim|required'),
		array('field' => 'name', 'label' => 'Holiday', 'rules' => 'trim|required'),
		array('field' => 'description', 'label' => 'Description', 'rules' => 'trim'),
		array('field' => 'company_id', 'label' => 'Company', 'rules' => 'trim'),
		array('field' => 'branch_id', 'label' => 'Branch', 'rules' => 'trim'),
		array('field' => 'site_id', 'label' => 'Site', 'rules' => 'trim')
	),

	'holiday_edit' => array(
		array('field' => 'attendance_holiday_type_id', 'label' => 'Holiday', 'rules' => 'trim|required'),
		array('field' => 'holiday_date', 'label' => 'Holiday Date', 'rules' => 'trim|required'),
		array('field' => 'name', 'label' => 'Holiday', 'rules' => 'trim|required'),
		array('field' => 'description', 'label' => 'Description', 'rules' => 'trim'),
		array('field' => 'company_id', 'label' => 'Company', 'rules' => 'trim'),
		array('field' => 'branch_id', 'label' => 'Branch', 'rules' => 'trim'),
		array('field' => 'site_id', 'label' => 'Site', 'rules' => 'trim')
	),

	'shift_schedule_add' => array(
		array('field' => 'company_id', 'label' => 'Company', 'rules' => 'trim|required'),
		array('field' => 'code', 'label' => 'Shift Code', 'rules' => 'trim|required'),
		array('field' => 'description', 'label' => 'Description', 'rules' => 'trim'),
		array('field' => 'type', 'label' => 'Type', 'rules' => 'trim'),
		array('field' => 'time_start', 'label' => 'Time Start', 'rules' => 'trim'),
		array('field' => 'time_end', 'label' => 'Time End', 'rules' => 'trim'),
		array('field' => 'grace_period', 'label' => 'Grace Period', 'rules' => 'trim'),
		array('field' => 'number_of_hours', 'label' => 'Number of Hours', 'rules' => 'trim')
	),

	'shift_schedule_edit' => array(
		array('field' => 'company_id', 'label' => 'Company', 'rules' => 'trim|required'),
		array('field' => 'code', 'label' => 'Shift Code', 'rules' => 'trim|required'),
		array('field' => 'description', 'label' => 'Description', 'rules' => 'trim'),
		array('field' => 'type', 'label' => 'Type', 'rules' => 'trim'),
		array('field' => 'time_start', 'label' => 'Time Start', 'rules' => 'trim'),
		array('field' => 'time_end', 'label' => 'Time End', 'rules' => 'trim'),
		array('field' => 'grace_period', 'label' => 'Grace Period', 'rules' => 'trim'),
		array('field' => 'number_of_hours', 'label' => 'Number of Hours', 'rules' => 'trim')
	),

	'employee_schedule_add' => array(
		array('field' => 'employee_id', 'label' => 'Employee', 'rules' => 'trim'),
		array('field' => 'date', 'label' => 'Date', 'rules' => 'trim'),
		array('field' => 'shift_id', 'label' => 'Shift Code', 'rules' => 'trim'),
		array('field' => 'company_id', 'label' => 'Company', 'rules' => 'trim')
	),

	'employee_schedule_edit' => array(
		array('field' => 'employee_id', 'label' => 'Employee', 'rules' => 'trim|required'),
		array('field' => 'date', 'label' => 'Date', 'rules' => 'trim|required'),
		array('field' => 'shift_id', 'label' => 'Shift Code', 'rules' => 'trim'),
		array('field' => 'company_id', 'label' => 'Company', 'rules' => 'trim')
	),

	'employee_personal_information' => array(
		array('field' => 'first_name', 'label' => 'First Name', 'rules' => 'trim|required'),
		array('field' => 'middle_name', 'label' => 'Middle Name', 'rules' => 'trim'),
		array('field' => 'last_name', 'label' => 'Last Name', 'rules' => 'trim'),
		array('field' => 'birthdate', 'label' => 'Birthdate', 'rules' => 'trim'),
		array('field' => 'birthplace', 'label' => 'Birthplace', 'rules' => 'trim'),
		array('field' => 'gender', 'label' => 'Gender', 'rules' => 'trim'),
		array('field' => 'civil_status_id', 'label' => 'Civil Status', 'rules' => 'trim')
	),

	'employee_parents_information' => array(
		array('field' => 'employee_id', 'label' => 'Employee ID', 'rules' => 'trim'),
		array('field' => 'first_name', 'label' => 'First Name', 'rules' => 'trim'),
		array('field' => 'middle_name', 'label' => 'Middle Name', 'rules' => 'trim'),
		array('field' => 'last_name', 'label' => 'Last Name', 'rules' => 'trim'),
		array('field' => 'birthdate', 'label' => 'Birthdate', 'rules' => 'trim'),
		array('field' => 'birthplace', 'label' => 'Birthplace', 'rules' => 'trim'),
		array('field' => 'gender', 'label' => 'Gender', 'rules' => 'trim'),
		array('field' => 'occupation', 'label' => 'Occupation', 'rules' => 'trim'),
		array('field' => 'relationship_id', 'label' => 'Relationship', 'rules' => 'trim'),
		array('field' => 'type', 'label' => 'Type', 'rules' => 'trim'),
		array('field' => 'block_number', 'label' => 'Block Number', 'rules' => 'trim'),
		array('field' => 'lot_number', 'label' => 'Type', 'rules' => 'trim'),
		array('field' => 'floor_number', 'label' => 'Floor Number', 'rules' => 'trim'),
		array('field' => 'street', 'label' => 'Street', 'rules' => 'trim'),
		array('field' => 'build_number', 'label' => 'Building Number', 'rules' => 'trim'),
		array('field' => 'building_name', 'label' => 'Building Name', 'rules' => 'trim')
	),

	'employee_spouse_information' => array(
		array('field' => 'first_name', 'label' => 'first_name', 'rules' => 'trim|required'),
		array('field' => 'middle_name', 'label' => 'middle_name', 'rules' => 'trim'),
		array('field' => 'last_name', 'label' => 'last_name', 'rules' => 'trim|required'),
		array('field' => 'birthdate', 'label' => 'birthdate', 'rules' => 'trim'),
		array('field' => 'block_number', 'label' => 'block_number', 'rules' => 'trim'),
		array('field' => 'lot_number', 'label' => 'lot_number', 'rules' => 'trim'),
		array('field' => 'floor_number', 'label' => 'floor_number', 'rules' => 'trim'),
		array('field' => 'building_number', 'label' => 'building_number', 'rules' => 'trim'),
		array('field' => 'building_name', 'label' => 'building_name', 'rules' => 'trim'),
		array('field' => 'street', 'label' => 'street', 'rules' => 'trim'),
		array('field' => 'barangay', 'label' => 'barangay', 'rules' => 'trim')
	),

	'employee_benefits' => array(
		array('field' => 'employee_id', 'label' => 'employee_id', 'rules' => 'trim'),
		array('field' => 'benefit_id', 'label' => 'benefit_id', 'rules' => 'trim'),
		array('field' => 'amount', 'label' => 'amount', 'rules' => 'trim')
	),

	'add_employee_dependants' => array(
		array('field' => 'employee_id', 'label' => 'employee', 'rules' => 'trim'),
		array('field' => 'name_prefix', 'label' => 'name_prefix', 'rules' => 'trim'),
		array('field' => 'first_name', 'label' => 'first_name', 'rules' => 'trim'),
		array('field' => 'middle_name', 'label' => 'middle_name', 'rules' => 'trim'),
		array('field' => 'last_name', 'label' => 'last_name', 'rules' => 'trim'),
		array('field' => 'name_suffix', 'label' => 'name_suffix', 'rules' => 'trim'),
		array('field' => 'relationship_id', 'label' => 'relationship_id', 'rules' => 'trim'),
		array('field' => 'birthdate', 'label' => 'birthdate', 'rules' => 'trim'),
		array('field' => 'block_number', 'label' => 'block_number', 'rules' => 'trim'),
		array('field' => 'lot_number', 'label' => 'lot_number', 'rules' => 'trim'),
		array('field' => 'floor_number', 'label' => 'floor_number', 'rules' => 'trim'),
		array('field' => 'building_number', 'label' => 'building_number', 'rules' => 'trim'),
		array('field' => 'building_name', 'label' => 'building_name', 'rules' => 'trim'),
		array('field' => 'street', 'label' => 'street', 'rules' => 'trim'),
		array('field' => 'location_id', 'label' => 'location_id', 'rules' => 'trim'),
		array('field' => 'remarks', 'label' => 'remarks', 'rules' => 'trim'),
		array('field' => 'birth_certificate', 'label' => 'birth_certificate', 'rules' => 'trim'),
		array('field' => 'company_id', 'label' => 'company_id', 'rules' => 'trim'),
	),

	'edit_employee_dependants' => array(
		array('field' => 'employee_id', 'label' => 'employee', 'rules' => 'trim'),
		array('field' => 'name_prefix', 'label' => 'name_prefix', 'rules' => 'trim'),
		array('field' => 'first_name', 'label' => 'first_name', 'rules' => 'trim'),
		array('field' => 'middle_name', 'label' => 'middle_name', 'rules' => 'trim'),
		array('field' => 'last_name', 'label' => 'last_name', 'rules' => 'trim'),
		array('field' => 'name_suffix', 'label' => 'name_suffix', 'rules' => 'trim'),
		array('field' => 'relationship_id', 'label' => 'relationship_id', 'rules' => 'trim'),
		array('field' => 'birthdate', 'label' => 'birthdate', 'rules' => 'trim'),
		array('field' => 'block_number', 'label' => 'block_number', 'rules' => 'trim'),
		array('field' => 'lot_number', 'label' => 'lot_number', 'rules' => 'trim'),
		array('field' => 'floor_number', 'label' => 'floor_number', 'rules' => 'trim'),
		array('field' => 'building_number', 'label' => 'building_number', 'rules' => 'trim'),
		array('field' => 'building_name', 'label' => 'building_name', 'rules' => 'trim'),
		array('field' => 'street', 'label' => 'street', 'rules' => 'trim'),
		array('field' => 'location_id', 'label' => 'location_id', 'rules' => 'trim'),
		array('field' => 'remarks', 'label' => 'remarks', 'rules' => 'trim'),
		array('field' => 'birth_certificate', 'label' => 'birth_certificate', 'rules' => 'trim'),
		array('field' => 'company_id', 'label' => 'company_id', 'rules' => 'trim'),
	),

    'employee_spouse_information' => array(
        array('field' => 'first_name', 'label' => 'first_name', 'rules' => 'trim|required'),
        array('field' => 'middle_name', 'label' => 'middle_name', 'rules' => 'trim'),
        array('field' => 'last_name', 'label' => 'last_name', 'rules' => 'trim|required'),
        array('field' => 'birthdate', 'label' => 'birthdate', 'rules' => 'trim'),
        array('field' => 'block_number', 'label' => 'block_number', 'rules' => 'trim'),
        array('field' => 'lot_number', 'label' => 'lot_number', 'rules' => 'trim'),
        array('field' => 'floor_number', 'label' => 'floor_number', 'rules' => 'trim'),
        array('field' => 'building_number', 'label' => 'building_number', 'rules' => 'trim'),
        array('field' => 'building_name', 'label' => 'building_name', 'rules' => 'trim'),
        array('field' => 'street', 'label' => 'street', 'rules' => 'trim'),
        array('field' => 'barangay', 'label' => 'barangay', 'rules' => 'trim')
    ),

    'daily_time_record_add' => array(
        array('field' => 'shift_schedule_id', 'label' => 'Shift Schedule',   'rules' => 'trim'),
        array('field' => 'date', 'label' => 'Date',   'rules' => 'trim'),
        array('field' => 'time_in',  'label' => 'Time In', 'rules' => 'trim'),
        array('field' => 'time_out', 'label' => 'Time Out','rules' => 'trim'),
        array('field' => 'company_id', 'label' => 'Time Out','rules' => 'trim')
    ),

    'daily_time_record_edit' => array(
        array('field' => 'shift_schedule_id', 'label' => 'Shift Schedule',   'rules' => 'trim|required'),
        array('field' => 'date', 'label' => 'Date',   'rules' => 'trim|required'),
        array('field' => 'time_in',           'label' => 'Time In',          'rules' => 'trim|required'),
        array('field' => 'time_out',          'label' => 'Time Out',         'rules' => 'trim'),
        array('field' => 'company_id', 'label' => 'Time Out','rules' => 'trim')
    ),

    'daily_time_log_add' => array(
        array('field' => 'employee_id', 'label' => 'Employee',    'rules' => 'trim|required'),
        array('field' => 'date_time',   'label' => 'Date & Time', 'rules' => 'trim'),
        array('field' => 'log_type',    'label' => 'Log Type',    'rules' => 'trim'),
        array('field' => 'device_id',   'label' => 'Device',      'rules' => 'trim'),
        array('field' => 'company_id',  'label' => 'Company',     'rules' => 'trim'),
        array('field' => 'latitude',    'label' => 'Latitude',    'rules' => 'trim'),
        array('field' => 'longitude',   'label' => 'Longitude',   'rules' => 'trim')
    ),

    'daily_time_log_edit' => array(
        array('field' => 'employee_id', 'label' => 'Employee',    'rules' => 'trim|required'),
        array('field' => 'date_time',   'label' => 'Date & Time', 'rules' => 'trim'),
        array('field' => 'log_type',    'label' => 'Log Type',    'rules' => 'trim'),
        array('field' => 'device_id',   'label' => 'Device',      'rules' => 'trim'),
        array('field' => 'company_id',  'label' => 'Company',     'rules' => 'trim'),
        array('field' => 'latitude',    'label' => 'Latitude',    'rules' => 'trim'),
        array('field' => 'longitude',   'label' => 'Longitude',   'rules' => 'trim')
    ),

	'add_employee_address' => array(
		array('field' => 'employee_id', 'label' => 'Employee', 'rules' => 'trim|required'),
		array('field' => 'type', 'label' => 'Type', 'rules' => 'trim|required'),
		array('field' => 'block_number', 'label' => 'Block Number', 'rules' => 'trim'),
		array('field' => 'lot_number', 'label' => 'Lot Number', 'rules' => 'trim'),
		array('field' => 'floor_number', 'label' => 'Floor Number', 'rules' => 'trim'),
		array('field' => 'building_number', 'label' => 'Building Number', 'rules' => 'trim'),
		array('field' => 'building_name', 'label' => 'Building Name', 'rules' => 'trim'),
		array('field' => 'street', 'label' => 'Street', 'rules' => 'trim'),
		array('field' => 'country_id', 'label' => 'Country', 'rules' => 'trim')
	),
	'device_add' => array(
		array('field' => 'name', 		'label' => 'Name', 		  'rules' => 'trim|required'),
		array('field' => 'description', 'label' => 'Description', 'rules' => 'trim|required'),
		array('field' => 'ip_address',  'label' => 'IP Address',  'rules' => 'trim'),
		array('field' => 'company_id',  'label' => 'Company', 	  'rules' => 'trim'),
		array('field' => 'site_id',     'label' => 'Site', 		  'rules' => 'trim')
	),
	'device_edit' => array(
		array('field' => 'name', 		'label' => 'Name', 		  'rules' => 'trim|required'),
		array('field' => 'description', 'label' => 'Description', 'rules' => 'trim|required'),
		array('field' => 'ip_address',  'label' => 'IP Address',  'rules' => 'trim'),
		array('field' => 'company_id',  'label' => 'Company', 	  'rules' => 'trim'),
		array('field' => 'site_id',     'label' => 'Site', 		  'rules' => 'trim')
	),
	'attachment_type_add' => array(
		array('field' => 'name', 		'label' => 'Name', 		  'rules' => 'trim|required'),
		array('field' => 'description', 'label' => 'Description', 'rules' => 'trim|required')
	),
	'attachment_type_edit' => array(
		array('field' => 'name', 		'label' => 'Name', 		  'rules' => 'trim|required'),
		array('field' => 'description', 'label' => 'Description', 'rules' => 'trim|required')
  ),
	'edit_employee_salary' => array(
		array('field' => 'company_id', 'label' => '', 'rules' => ''),
		array('field' => 'employee_id', 'label' => '', 'rules' => ''),
		array('field' => 'position_id', 'label' => '', 'rules' => ''),
		array('field' => 'salaray_matrix_Is', 'label' => '', 'rules' => ''),
		array('field' => '', 'label' => '', 'rules' => '')
	),
	'set_employee_salary' => array(
		array('field' => '', 'label' => '', 'rules' => ''),
		array('field' => '', 'label' => '', 'rules' => ''),
		array('field' => '', 'label' => '', 'rules' => ''),
		array('field' => '', 'label' => '', 'rules' => ''),
		array('field' => '', 'label' => '', 'rules' => '')
	),
	'violation_add' => array(
		array('field' => 'name', 'label' => 'Name', 'rules' => 'trim|required'),
		array('field' => 'description', 'label' => 'Description', 'rules' => 'trim|required')
	),
	'violation_edit' => array(
		array('field' => 'name', 'label' => 'Name', 'rules' => 'trim|required'),
		array('field' => 'description', 'label' => 'Description', 'rules' => 'trim|required')
	),
	'course_add' => array(
		array('field' => 'course', 'label' => 'Course', 'rules' => 'trim|required'),
		array('field' => 'description', 'label' => 'Description', 'rules' => 'trim|required'),
		array('field' => 'educational_attainment_id', 'label' => 'Educational Attainment', 'rules' => 'trim|required')
	),
	'course_edit' => array(
		array('field' => 'course', 'label' => 'Course', 'rules' => 'trim|required'),
		array('field' => 'description', 'label' => 'Description', 'rules' => 'trim|required'),
		array('field' => 'educational_attainment_id', 'label' => 'Educational Attainment', 'rules' => 'trim|required')
	),
	'training_add' => array(
		array('field' => 'title', 'label' => 'Title', 'rules' => 'trim|required'),
		array('field' => 'facilitator', 'label' => 'Facilitator', 'rules' => 'trim|required'),
		array('field' => 'institution', 'label' => 'Institution', 'rules' => 'trim|required'),
		array('field' => 'location', 'label' => 'Location', 'rules' => 'trim|required'),
		array('field' => 'date_started', 'label' => 'Date Started', 'rules' => 'trim|required'),
		array('field' => 'date_ended', 'label' => 'Date Ended', 'rules' => 'trim|required'),
		array('field' => 'hours', 'label' => 'Hours', 'rules' => 'trim|required'),
		array('field' => 'company_id', 'label' => 'Company', 'rules' => 'trim|required')
	),
	'training_edit' => array(
		array('field' => 'title', 'label' => 'Title', 'rules' => 'trim|required'),
		array('field' => 'facilitator', 'label' => 'Facilitator', 'rules' => 'trim|required'),
		array('field' => 'institution', 'label' => 'Institution', 'rules' => 'trim|required'),
		array('field' => 'location', 'label' => 'Location', 'rules' => 'trim|required'),
		array('field' => 'date_started', 'label' => 'Date Started', 'rules' => 'trim|required'),
		array('field' => 'date_ended', 'label' => 'Date Ended', 'rules' => 'trim|required'),
		array('field' => 'hours', 'label' => 'Hours', 'rules' => 'trim|required'),
		array('field' => 'company_id', 'label' => 'Company', 'rules' => 'trim|required')
	),
	'salary_matrix_add' => array(
		array('field' => 'company_id', 'label' => 'Company', 'rules' => 'trim|required'),
		array('field' => 'effectivity_date', 'label' => 'Effectivity Date', 'rules' => 'trim|required'),
		array('field' => 'description', 'label' => 'Description', 'rules' => 'trim|required')
	),
	'salary_matrix_edit' => array(
		array('field' => 'company_id', 'label' => 'Company', 'rules' => 'trim|required'),
		array('field' => 'effectivity_date', 'label' => 'Effectivity Date', 'rules' => 'trim|required'),
		array('field' => 'description', 'label' => 'Description', 'rules' => 'trim|required')
	),
	'salary_add' => array(
		array('field' => 'salary_matrix_id', 'label' => 'Salary Matrix', 'rules' => 'trim|required'),
		array('field' => 'monthly_salary', 'label' => 'Effectivity Date', 'rules' => 'trim|required')
	),
	'salary_edit' => array(
		array('field' => 'salary_matrix_id', 'label' => 'Salary Matrix', 'rules' => 'trim|required'),
		array('field' => 'monthly_salary', 'label' => 'Effectivity Date', 'rules' => 'trim|required')
	),
	'salary_grade_add' => array(
		array('field' => 'company_id', 'label' => 'Company', 'rules' => 'trim|required'),
		array('field' => 'grade_code', 'label' => 'Grade Code', 'rules' => 'trim'),
		array('field' => 'description', 'label' => 'Description', 'rules' => 'trim'),
		array('field' => 'minimum_salary', 'label' => 'Minimum Salary', 'rules' => 'trim'),
		array('field' => 'maximum_salary', 'label' => 'Maximum Salary', 'rules' => 'trim')
	),
	'salary_grade_edit' => array(
		array('field' => 'company_id', 'label' => 'Company', 'rules' => 'trim|required'),
		array('field' => 'grade_code', 'label' => 'Grade Code', 'rules' => 'trim'),
		array('field' => 'description', 'label' => 'Description', 'rules' => 'trim'),
		array('field' => 'minimum_salary', 'label' => 'Minimum Salary', 'rules' => 'trim'),
		array('field' => 'maximum_salary', 'label' => 'Maximum Salary', 'rules' => 'trim')
	),
	'compensation_package_add' => array(
		array('field' => 'company_id', 'label' => 'Company', 'rules' => 'trim'),
		array('field' => 'position_id', 'label' => 'Position', 'rules' => 'trim'),
		array('field' => 'salary_id', 'label' => 'Salary', 'rules' => 'trim')
	),
	'compensation_package_edit' => array(
		array('field' => 'company_id', 'label' => 'Company', 'rules' => 'trim'),
		array('field' => 'position_id', 'label' => 'Position', 'rules' => 'trim|required'),
		array('field' => 'salary_id', 'label' => 'Salary', 'rules' => 'trim|required')
	),
	'incentive_type_add' => array(
		array('field' => 'name', 'label' => 'Name', 'rules' => 'trim|required'),
		array('field' => 'description', 'label' => 'Description', 'rules' => 'trim')
	),
	'incentive_type_edit' => array(
		array('field' => 'name', 'label' => 'Name', 'rules' => 'trim|required'),
		array('field' => 'description', 'label' => 'Description', 'rules' => 'trim')
	),
	'incentive_matrix_add' => array(
		array('field' => 'year_effective', 'label' => 'Effectivity Year', 'rules' => 'trim|required'),
		array('field' => 'description', 'label' => 'Description', 'rules' => 'trim')
	),
	'incentive_matrix_edit' => array(
		array('field' => 'year_effective', 'label' => 'Effectivity Year', 'rules' => 'trim|required'),
		array('field' => 'description', 'label' => 'Description', 'rules' => 'trim')
	),
	'incentive_add' => array(
		array('field' => 'incentive_matrix_id', 'label' => 'Incentive Matrix', 'rules' => 'trim|required'),
		array('field' => 'incentive_type_id', 'label' => 'Incentive Type', 'rules' => 'trim|required'),
		array('field' => 'amount', 'label' => 'Amount', 'rules' => 'trim|required')
	),
	'incentive_edit' => array(
		array('field' => 'incentive_matrix_id', 'label' => 'Incentive Matrix', 'rules' => 'trim|required'),
		array('field' => 'incentive_type_id', 'label' => 'Incentive Type', 'rules' => 'trim|required'),
		array('field' => 'amount', 'label' => 'Amount', 'rules' => 'trim|required')
	),
	'benefit_add' => array(
		array('field' => 'company_id', 'label' => 'Company', 'rules' => 'trim'),
		array('field' => 'benefit_matrix_id', 'label' => 'Benefit Matrix', 'rules' => 'trim'),
		array('field' => 'name', 'label' => 'Name', 'rules' => 'trim'),
		array('field' => 'amount', 'label' => 'Amount', 'rules' => 'trim'),
		array('field' => 'description', 'label' => 'Description', 'rules' => 'trim')
	),
	'benefit_edit' => array(
		array('field' => 'company_id', 'label' => 'Company', 'rules' => 'trim'),
		array('field' => 'benefit_matrix_id', 'label' => 'Benefit Matrix', 'rules' => 'trim'),
		array('field' => 'name', 'label' => 'Name', 'rules' => 'trim'),
		array('field' => 'amount', 'label' => 'Amount', 'rules' => 'trim'),
		array('field' => 'description', 'label' => 'Description', 'rules' => 'trim')
	),
	'benefit_matrix_add' => array(
		array('field' => 'effectivity_date', 'label' => 'Effectivity Date', 'rules' => 'trim|required'),
		array('field' => 'description', 'label' => 'Description', 'rules' => 'trim')
	),
	'benefit_matrix_edit' => array(
		array('field' => 'effectivity_date', 'label' => 'Effectivity Date', 'rules' => 'trim|required'),
		array('field' => 'description', 'label' => 'Description', 'rules' => 'trim')
	),
	
	'company_address_add' => array(
		array('field' => 'company_id', 'label' => 'Company', 'rules' => 'trim|required'),
		array('field' => 'unit_number', 'label' => 'Unit Number', 'rules' => 'trim'),
		array('field' => 'floor_number', 'label' => 'Floor Number', 'rules' => 'trim'),
		array('field' => 'building_number', 'label' => 'Building Number', 'rules' => 'trim'),
		array('field' => 'block_number', 'label' => 'Block Number', 'rules' => 'trim'),
		array('field' => 'lot_number', 'label' => 'Lot Number', 'rules' => 'trim'),
		array('field' => 'street', 'label' => 'Street', 'rules' => 'trim'),
		array('field' => 'location_id', 'label' => 'Location', 'rules' => 'trim|required')
	),
	'company_address_edit' => array(
		array('field' => 'company_id', 'label' => 'Company', 'rules' => 'trim|required'),
		array('field' => 'unit_number', 'label' => 'Unit Number', 'rules' => 'trim'),
		array('field' => 'floor_number', 'label' => 'Floor Number', 'rules' => 'trim'),
		array('field' => 'building_number', 'label' => 'Building Number', 'rules' => 'trim'),
		array('field' => 'block_number', 'label' => 'Block Number', 'rules' => 'trim'),
		array('field' => 'lot_number', 'label' => 'Lot Number', 'rules' => 'trim'),
		array('field' => 'street', 'label' => 'Street', 'rules' => 'trim'),
		array('field' => 'location_id', 'label' => 'Location', 'rules' => 'trim|required')
	),
	'company_contact_information_add' => array(
		array('field' => 'company_id', 'label' => 'Company', 'rules' => 'trim|required'),
		array('field' => 'telephone_number', 'label' => 'Telephone Number', 'rules' => 'trim'),
		array('field' => 'mobile_number', 'label' => 'Mobile Number', 'rules' => 'trim'),
		array('field' => 'fax_number', 'label' => 'Fax Number', 'rules' => 'trim'),
		array('field' => 'email', 'label' => 'Email Address', 'rules' => 'trim'),
		array('field' => 'website', 'label' => 'Website', 'rules' => 'trim')
	),
	'company_government_id_numbers_add' => array(
		array('field' => 'company_id', 'label' => 'Company', 'rules' => 'trim|required'),
		array('field' => 'revenue_district_office_id', 'label' => 'Revenue District Office', 'rules' => 'trim|required'),
		array('field' => 'tin', 'label' => 'TIN', 'rules' => 'trim'),
		array('field' => 'sss', 'label' => 'SSS Number', 'rules' => 'trim'),
		array('field' => 'hdmf', 'label' => 'HDMF Number', 'rules' => 'trim'),
		array('field' => 'phic', 'label' => 'PHIC Address', 'rules' => 'trim'),
		array('field' => 'business_registration_number', 'label' => 'Business Registration Number', 'rules' => 'trim')
	),
	'company_government_id_numbers_edit' => array(
		array('field' => 'company_id', 'label' => 'Company', 'rules' => 'trim|required'),
		array('field' => 'revenue_district_office_id', 'label' => 'Revenue District Office', 'rules' => 'trim|required'),
		array('field' => 'tin', 'label' => 'TIN', 'rules' => 'trim'),
		array('field' => 'sss', 'label' => 'SSS Number', 'rules' => 'trim'),
		array('field' => 'hdmf', 'label' => 'HDMF Number', 'rules' => 'trim'),
		array('field' => 'phic', 'label' => 'PHIC Address', 'rules' => 'trim'),
		array('field' => 'business_registration_number', 'label' => 'Business Registration Number', 'rules' => 'trim')
	),
	'company_information_add' => array(
		array('field' => 'company_id', 'label' => 'Company', 'rules' => 'trim|required'),
		array('field' => 'company_address_id', 'label' => 'Company Address', 'rules' => 'trim|required'),
		array('field' => 'company_contact_id', 'label' => 'Company Contact Number', 'rules' => 'trim'),
		array('field' => 'government_id_numbers_id', 'label' => 'Government ID Numbers', 'rules' => 'trim')
	),
	'company_information_edit' => array(
		array('field' => 'company_id', 'label' => 'Company', 'rules' => 'trim|required'),
		array('field' => 'company_address_id', 'label' => 'Company Address', 'rules' => 'trim|required'),
		array('field' => 'company_contact_id', 'label' => 'Company Contact Number', 'rules' => 'trim'),
		array('field' => 'government_id_numbers_id', 'label' => 'Government ID Numbers', 'rules' => 'trim')
	),
	'team_add' => array(
		array('field' => 'name', 'label' => 'Team', 'rules' => 'trim|required'),
		array('field' => 'description', 'label' => 'Description', 'rules' => 'trim|required'),
		array('field' => 'company_id', 'label' => 'Company', 'rules' => 'trim'),
		array('field' => 'branch_id', 'label' => 'Branch', 'rules' => 'trim'),
		array('field' => 'cost_center_id', 'label' => 'Cost Center', 'rules' => 'trim'),
		array('field' => 'department_id', 'label' => 'Department', 'rules' => 'trim'),
		array('field' => 'site_id', 'label' => 'Site', 'rules' => 'trim'),
	),
	
	'team_edit' => array(
		array('field' => 'name', 'label' => 'Team', 'rules' => 'trim|required'),
		array('field' => 'description', 'label' => 'Description', 'rules' => 'trim|required'),
		array('field' => 'company_id', 'label' => 'Company', 'rules' => 'trim'),
		array('field' => 'branch_id', 'label' => 'Branch', 'rules' => 'trim'),
		array('field' => 'cost_center_id', 'label' => 'Cost Center', 'rules' => 'trim'),
		array('field' => 'department_id', 'label' => 'Department', 'rules' => 'trim'),
		array('field' => 'site_id', 'label' => 'Site', 'rules' => 'trim'),
	),

	'employee_educational_background_add' => array(
		array('field' => 'company_id', 'label' => 'Company', 'rules' => 'trim'),
		array('field' => 'employee_id', 'label' => 'Employee', 'rules' => 'trim'),
		array('field' => 'educational_attainment_id', 'label' => 'Educational Attainment', 'rules' => 'trim'),
		array('field' => 'school', 'label' => 'School', 'rules' => 'trim'),
		array('field' => 'year_start', 'label' => 'Year Started', 'rules' => 'trim'),
		array('field' => 'year_end', 'label' => 'Year Ended', 'rules' => 'trim'),
		array('field' => 'certification', 'label' => 'Certification', 'rules' => 'trim'),
		array('field' => 'awards', 'label' => 'Site', 'Awards' => 'trim'),
		array('field' => 'gpa', 'label' => 'Site', 'GPA' => 'trim'),
		array('field' => 'major gpa', 'label' => 'Major GPA', 'rules' => 'trim'),
		array('field' => 'course_id', 'label' => 'Course', 'rules' => 'trim'),
	),

	'employee_educational_background_edit' => array(
		array('field' => 'company_id', 'label' => 'Company', 'rules' => 'trim'),
		array('field' => 'employee_id', 'label' => 'Employee', 'rules' => 'trim'),
		array('field' => 'educational_attainment_id', 'label' => 'Educational Attainment', 'rules' => 'trim'),
		array('field' => 'school', 'label' => 'School', 'rules' => 'trim'),
		array('field' => 'year_start', 'label' => 'Year Started', 'rules' => 'trim'),
		array('field' => 'year_end', 'label' => 'Year Ended', 'rules' => 'trim'),
		array('field' => 'certification', 'label' => 'Certification', 'rules' => 'trim'),
		array('field' => 'awards', 'label' => 'Site', 'Awards' => 'trim'),
		array('field' => 'gpa', 'label' => 'Site', 'GPA' => 'trim'),
		array('field' => 'major gpa', 'label' => 'Major GPA', 'rules' => 'trim'),
		array('field' => 'course_id', 'label' => 'Course', 'rules' => 'trim'),
	),

	'client_add' => array(
		array('field' => 'account_id', 'label' => 'Account', 'rules' => 'trim|required'),
		array('field' => 'name_prefix', 'label' => 'Prefix', 'rules' => 'trim'),
		array('field' => 'first_name', 'label' => 'First Name', 'rules' => 'trim'),
		array('field' => 'middle_name', 'label' => 'Middle Name', 'rules' => 'trim'),
		array('field' => 'last_name', 'label' => 'Last Name', 'rules' => 'trim'),
		array('field' => 'name_suffix', 'label' => 'Suffix', 'rules' => 'trim')
	),

	'client_edit' => array(
		array('field' => 'account_id', 'label' => 'Account', 'rules' => 'trim|required'),
		array('field' => 'name_prefix', 'label' => 'Prefix', 'rules' => 'trim'),
		array('field' => 'first_name', 'label' => 'First Name', 'rules' => 'trim'),
		array('field' => 'middle_name', 'label' => 'Middle Name', 'rules' => 'trim'),
		array('field' => 'last_name', 'label' => 'Last Name', 'rules' => 'trim'),
		array('field' => 'name_suffix', 'label' => 'Suffix', 'rules' => 'trim')
	),

	'company_address_add' => array(
		array('field' => 'company_id', 'label' => 'Company', 'rules' => 'trim|required'),
		array('field' => 'unit_name', 'label' => 'Unit Name', 'rules' => 'trim'),
		array('field' => 'floor_number', 'label' => 'Floor Number', 'rules' => 'trim'),
		array('field' => 'building_number', 'label' => 'Building Number', 'rules' => 'trim'),
		array('field' => 'building_name', 'label' => 'Building Name', 'rules' => 'trim'),
		array('field' => 'block_number', 'label' => 'Block Number', 'rules' => 'trim'),
		array('field' => 'lot_number', 'label' => 'Lot Number', 'rules' => 'trim'),
		array('field' => 'street', 'label' => 'Street', 'rules' => 'trim'),
		array('field' => 'location_id', 'label' => 'Location', 'rules' => 'trim'),
	),
	'company_address_edit' => array(
		array('field' => 'company_id', 'label' => 'Company', 'rules' => 'trim|required'),
		array('field' => 'unit_name', 'label' => 'Unit Name', 'rules' => 'trim'),
		array('field' => 'floor_number', 'label' => 'Floor Number', 'rules' => 'trim'),
		array('field' => 'building_number', 'label' => 'Building Number', 'rules' => 'trim'),
		array('field' => 'building_name', 'label' => 'Building Name', 'rules' => 'trim'),
		array('field' => 'block_number', 'label' => 'Block Number', 'rules' => 'trim'),
		array('field' => 'lot_number', 'label' => 'Lot Number', 'rules' => 'trim'),
		array('field' => 'street', 'label' => 'Street', 'rules' => 'trim'),
		array('field' => 'location_id', 'label' => 'Location', 'rules' => 'trim'),
	),
	'company_information_add' => array(
		array('field' => 'company_id', 'label' => 'Company', 'rules' => 'trim|required'),
		array('field' => 'company_address_id', 'label' => 'Unit Name', 'rules' => 'trim'),
		array('field' => 'company_contact_id', 'label' => 'Floor Number', 'rules' => 'trim'),
		array('field' => 'government_id_numbers_id', 'label' => 'Building Number', 'rules' => 'trim')
	),
	'company_information_edit' => array(
		array('field' => 'company_id', 'label' => 'Company', 'rules' => 'trim|required'),
		array('field' => 'company_address_id', 'label' => 'Unit Name', 'rules' => 'trim'),
		array('field' => 'company_contact_id', 'label' => 'Floor Number', 'rules' => 'trim'),
		array('field' => 'government_id_numbers_id', 'label' => 'Building Number', 'rules' => 'trim')
	),
	'company_government_id_numbers_add' => array(
		array('field' => 'company_id', 'label' => 'Company', 'rules' => 'trim|required'),
		array('field' => 'revenue_district_office_id', 'label' => 'Revenue District Office', 'rules' => 'trim'),
		array('field' => 'tin', 'label' => 'TIN', 'rules' => 'trim'),
		array('field' => 'sss', 'label' => 'SSS', 'rules' => 'trim'),
		array('field' => 'hdmf', 'label' => 'HDMF', 'rules' => 'trim'),
		array('field' => 'phic', 'label' => 'PHIC', 'rules' => 'trim'),
		array('field' => 'business_registration_number', 'label' => 'Business Registration Number', 'rules' => 'trim')
	),
	'company_government_id_numbers_edit' => array(
		array('field' => 'company_id', 'label' => 'Company', 'rules' => 'trim|required'),
		array('field' => 'revenue_district_office_id', 'label' => 'Revenue District Office', 'rules' => 'trim'),
		array('field' => 'tin', 'label' => 'TIN', 'rules' => 'trim'),
		array('field' => 'sss', 'label' => 'SSS', 'rules' => 'trim'),
		array('field' => 'hdmf', 'label' => 'HDMF', 'rules' => 'trim'),
		array('field' => 'phic', 'label' => 'PHIC', 'rules' => 'trim'),
		array('field' => 'business_registration_number', 'label' => 'Business Registration Number', 'rules' => 'trim')
	),
	'company_contact_information_add' => array(
		array('field' => 'company_id', 'label' => 'Company', 'rules' => 'trim|required'),
		array('field' => 'telephone_number', 'label' => 'Telephone Number', 'rules' => 'trim'),
		array('field' => 'mobile_number', 'label' => 'Mobile Number', 'rules' => 'trim'),
		array('field' => 'fax_number', 'label' => 'Fax Number', 'rules' => 'trim'),
		array('field' => 'email', 'label' => 'Email Address', 'rules' => 'trim'),
		array('field' => 'website', 'label' => 'Website', 'rules' => 'trim')
	),
	'company_contact_information_edit' => array(
		array('field' => 'company_id', 'label' => 'Company', 'rules' => 'trim|required'),
		array('field' => 'telephone_number', 'label' => 'Telephone Number', 'rules' => 'trim'),
		array('field' => 'mobile_number', 'label' => 'Mobile Number', 'rules' => 'trim'),
		array('field' => 'fax_number', 'label' => 'Fax Number', 'rules' => 'trim'),
		array('field' => 'email', 'label' => 'Email Address', 'rules' => 'trim'),
		array('field' => 'website', 'label' => 'Website', 'rules' => 'trim')
	),
	'employee_work_experiences_add' => array(
		array('field' => 'employee_id', 'label' => 'employee', 'rules' => 'trim'),
		array('field' => 'name_prefix', 'label' => 'name_prefix', 'rules' => 'trim'),
		array('field' => 'first_name', 'label' => 'first_name', 'rules' => 'trim'),
		array('field' => 'middle_name', 'label' => 'middle_name', 'rules' => 'trim'),
		array('field' => 'last_name', 'label' => 'last_name', 'rules' => 'trim'),
		array('field' => 'name_suffix', 'label' => 'name_suffix', 'rules' => 'trim'),
		array('field' => 'position', 'label' => 'position', 'rules' => 'trim'),
		array('field' => 'employment_type_id', 'label' => 'employment_type_id', 'rules' => 'trim'),
		array('field' => 'company_name', 'label' => 'company_name', 'rules' => 'trim'),
		array('field' => 'immediate_superior', 'label' => 'immediate_superior', 'rules' => 'trim'),
		array('field' => 'duties', 'label' => 'duties', 'rules' => 'trim'),
		array('field' => 'salary', 'label' => 'salary', 'rules' => 'trim'),
		array('field' => 'date_hired', 'label' => 'date_hired', 'rules' => 'trim'),
		array('field' => 'date_separated', 'label' => 'date_separated', 'rules' => 'trim'),
		array('field' => 'reason_for_leaving', 'label' => 'reason_for_leaving', 'rules' => 'trim'),
		array('field' => 'location_id', 'label' => 'location_id', 'rules' => 'trim'),
		array('field' => 'floor_number', 'label' => 'floor_number', 'rules' => 'trim'),
		array('field' => 'building_number', 'label' => 'building_number', 'rules' => 'trim'),
		array('field' => 'building_name', 'label' => 'building_name', 'rules' => 'trim'),
		array('field' => 'block_number', 'label' => 'block_number', 'rules' => 'trim'),
		array('field' => 'lot_number', 'label' => 'lot_number', 'rules' => 'trim'),
		array('field' => 'street', 'label' => 'street', 'rules' => 'trim'),
		array('field' => 'mobile_number', 'label' => 'mobile_number', 'rules' => 'trim'),
		array('field' => 'telephone_number', 'label' => 'telephone_number', 'rules' => 'trim'),
	),

	'employee_certifications_add' => array(
		array('field' => 'employee_id', 'label' => 'Employee ID', 'rules' => 'trim'),
		array('field' => 'name', 'label' => 'Certificate', 'rules' => 'trim'),
		array('field' => 'number', 'label' => 'Certificate Number', 'rules' => 'trim'),
		array('field' => 'issuing_authority', 'label' => 'Issuing Authority', 'rules' => 'trim'),
		array('field' => 'date_received', 'label' => 'Date Received', 'rules' => 'trim'),
		array('field' => 'validity', 'label' => 'Validity', 'rules' => 'trim'),
		array('field' => 'attachment', 'label' => 'attachment', 'rules' => 'trim'),
		array('field' => 'company_id', 'label' => 'company_id', 'rules' => 'trim')
	),

	'employee_work_experience_edit' => array(
		array('field' => 'employee_id', 'label' => 'employee', 'rules' => 'trim'),
		array('field' => 'name_suffix', 'label' => 'name_suffix', 'rules' => 'trim'),
		array('field' => 'position', 'label' => 'position', 'rules' => 'trim'),
		array('field' => 'employment_type_id', 'label' => 'employment_type_id', 'rules' => 'trim'),
		array('field' => 'company_name', 'label' => 'company_name', 'rules' => 'trim'),
		array('field' => 'immediate_superior', 'label' => 'immediate_superior', 'rules' => 'trim'),
		array('field' => 'duties', 'label' => 'duties', 'rules' => 'trim'),
		array('field' => 'salary', 'label' => 'salary', 'rules' => 'trim'),
		array('field' => 'date_hired', 'label' => 'date_hired', 'rules' => 'trim'),
		array('field' => 'date_separated', 'label' => 'date_separated', 'rules' => 'trim'),
		array('field' => 'reason_for_leaving', 'label' => 'reason_for_leaving', 'rules' => 'trim'),
		array('field' => 'location_id', 'label' => 'location_id', 'rules' => 'trim'),
		array('field' => 'floor_number', 'label' => 'floor_number', 'rules' => 'trim'),
		array('field' => 'building_number', 'label' => 'building_number', 'rules' => 'trim'),
		array('field' => 'building_name', 'label' => 'building_name', 'rules' => 'trim'),
		array('field' => 'block_number', 'label' => 'block_number', 'rules' => 'trim'),
		array('field' => 'lot_number', 'label' => 'lot_number', 'rules' => 'trim'),
		array('field' => 'street', 'label' => 'street', 'rules' => 'trim'),
		array('field' => 'mobile_number', 'label' => 'mobile_number', 'rules' => 'trim'),
		array('field' => 'telephone_number', 'label' => 'telephone_number', 'rules' => 'trim'),
	),
		
	'employee_certifications_add' => array(
		array('field' => 'employee_id', 'label' => 'Employee ID', 'rules' => 'trim'),
		array('field' => 'name', 'label' => 'Certificate', 'rules' => 'trim'),
		array('field' => 'number', 'label' => 'Certificate Number', 'rules' => 'trim'),
		array('field' => 'issuing_authority', 'label' => 'Issuing Authority', 'rules' => 'trim'),
		array('field' => 'date_received', 'label' => 'Date Received', 'rules' => 'trim'),
		array('field' => 'validity', 'label' => 'Validity', 'rules' => 'trim'),
		array('field' => 'attachment', 'label' => 'attachment', 'rules' => 'trim'),
		array('field' => 'company_id', 'label' => 'company_id', 'rules' => 'trim'),
	),

	'employee_skills_add' => array(
		array('field' => 'employee_id', 'label' => 'Employee ID', 'rules' => 'trim'),
		array('field' => 'skill_id', 'label' => 'skill_id', 'rules' => 'trim'),
		array('field' => 'proficiency_level_id', 'label' => 'proficiency_level_id', 'rules' => 'trim'),
		array('field' => 'company_id', 'label' => 'company_id', 'rules' => 'trim'),
	),
	
	'employee_skill_edit' => array(
		array('field' => 'employee_id', 'label' => 'Employee ID', 'rules' => 'trim'),
		array('field' => 'skill_id', 'label' => 'skill_id', 'rules' => 'trim'),
		array('field' => 'proficiency_level_id', 'label' => 'proficiency_level_id', 'rules' => 'trim'),
		array('field' => 'company_id', 'label' => 'company_id', 'rules' => 'trim'),
	),
	
	'employee_trainings_add' => array(
		array('field' => 'company_id', 'label' => 'Company', 'rules' => 'trim'),
		array('field' => 'employee_id', 'label' => 'Employee', 'rules' => 'trim'),
		array('field' => 'employee_training_id', 'label' => 'Training', 'rules' => 'trim'),
		array('field' => 'acquired_from', 'label' => 'Acquired Form', 'rules' => 'trim'),
		array('field' => 'training_id', 'label' => 'Training Title', 'rules' => 'trim'),
	),

	'employee_awards_add' => array(
		array('field' => 'company_id', 'label' => 'Company', 'rules' => 'trim'),
		array('field' => 'award', 'label' => 'Award Title', 'rules' => 'trim'),
		array('field' => 'date', 'label' => 'Date', 'rules' => 'trim'),
		array('field' => 'comment', 'label' => 'Comment', 'rules' => 'trim'),
	),

	'employee_violations_add' => array(
		array('field' => 'violation_id', 'label' => 'Violation', 'rules' => 'trim'),
		array('field' => 'number_of_offense', 'label' => 'Number of Offense', 'rules' => 'trim'),
	),
	
	'employee_violations_edit' => array(
		array('field' => 'violation_id', 'label' => 'Violation', 'rules' => 'trim'),
	),

	'employee_sanctions_add' => array(
		array('field' => 'sanction_id', 'label' => 'sanction', 'rules' => 'trim'),
		array('field' => 'number_of_offense', 'label' => 'Number of Offense', 'rules' => 'trim'),
	),

	'employee_sanctions_edit' => array(
		array('field' => 'sanction_id', 'label' => 'sanction', 'rules' => 'trim'),
		array('field' => 'number_of_offense', 'label' => 'Number of Offense', 'rules' => 'trim')
	),

	'loan_type_add' => array(
		array('field' => 'name', 'label' => 'Name', 'rules' => 'trim|required'),
		array('field' => 'loan_limit', 'label' => 'Loan Limit', 'rules' => 'trim'),
		array('field' => 'interest_per_month', 'label' => 'Interest Per Month', 'rules' => 'trim|required'),
		array('field' => 'frequency', 'label' => 'Frequency', 'rules' => 'trim'),
		array('field' => 'description', 'label' => 'Description', 'rules' => 'trim')
	),

	'employee_loan_add' => array(
		array('field' => 'employee_id', 'label' => 'Employee', 'rules' => 'trim|required'),
		array('field' => 'loan_type_id', 'label' => 'Loan Type', 'rules' => 'trim|required'),
		array('field' => 'loan_amount', 'label' => 'Loan Amount', 'rules' => 'trim'),
		array('field' => 'months_to_pay', 'label' => 'Months to Pay', 'rules' => 'trim|required'),
		array('field' => 'amount_interest', 'label' => 'Total Interest', 'rules' => 'trim'),
		array('field' => 'reason', 'label' => 'Reason', 'rules' => 'trim'),
		array('field' => 'date_start', 'label' => 'Date Start', 'rules' => 'trim'),
		array('field' => 'total_amount', 'label' => 'Total Amount', 'rules' => 'trim'),
		array('field' => 'monthly_amortization', 'label' => 'Monthly Amortization', 'rules' => 'trim'),
		array('field' => 'maturity_date', 'label' => 'Maturity Date', 'rules' => 'trim')
	),

	'employee_leave_credit_edit' => array(
		array('field' => 'balance', 'label' => 'Balance', 'rules' => 'numeric|required')
	),

	'employee_leave_credit_add' => array(
		array('field' => 'balance', 'label' => 'Balance', 'rules' => 'numeric|required')
	)

);
