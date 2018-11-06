<?php

defined('BASEPATH') OR exit('No direct script access allowed!');

require APPPATH.'/third_party/kint.php';

if ( ! function_exists('remove_unknown_field'))
{
    function remove_unknown_field($raw_data, $expected_fields)
    {
        $new_data = [];
        foreach ($raw_data as $field_name => $field_value)
        {
            if ($field_value != "" && in_array($field_name, array_values($expected_fields)))
            {
                $new_data[$field_name] = $field_value;
            }
        }

        return $new_data;
    }
}

if ( ! function_exists('filter_data'))
{
    function filter_data($table, $data)
    {
        $ci =& get_instance();

        $filtered_data = array();
        $columns = $ci->db->list_fields($table);

        if ( ! is_array($data)) return FALSE;

        foreach ($columns as $column)
        {
            if (array_key_exists($column, $data))
                $filtered_data[$column] = $data[$column];
        }

        return $filtered_data;
    }
}

if ( ! function_exists('dump'))
{
    function dump($var, $label = 'Dump', $echo = true)
    {
        // Store dump in variable
        ob_start();
        var_dump($var);
        $output = ob_get_clean();

        // Custom CSS style
        $style = 'background: #282c34;
                color: #83c379;
                margin: 10px;
                padding: 10px;
                text-align: left;
                font-family: Inconsolata, Monaco, Consolas, Courier New, Courier;;
                font-size: 15px;
                border: 1px;
                border-radius: 1px;
                overflow: auto;
                border: 2px;
                -webkit-box-shadow: 5px 5px 5px #a4a4a4;';

        // Add formatting
        $output = preg_replace("/\]\=\>\n(\s+)/m", '] => ', $output);
        $output = '<pre style="'.$style.'">'.$label.' => '.$output.'</pre>';

        // Output
        if ($echo == true)
        {
            echo $output;
        } else {
            return $output;
        }
    }
}

if ( ! function_exists('dump_exit'))
{
    function dump_exit($var)
    {
        dump($var);
        exit;
    }
}


if ( ! function_exists('dd'))
{
    function dd($var)
    {
        d($var);
    }
}


if ( ! function_exists('generateRandomString'))
{
    function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++)
        {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}

if ( ! function_exists('daterange'))
{
    function daterange($date_start, $date_end, $differenceFormat = '%a')
    {
        $new_date_start = date_create($date_start);
        $new_date_end   = date_create($date_end);
        $interval       = date_diff($new_date_start, $new_date_end);
        $pre_total      = $interval->format($differenceFormat);
        $total          = $pre_total + 1;
        return $total;
    }
}

if ( ! function_exists('calculate_leave_balance'))
{
    function calculate_leave_balance($leave_balance, $total_days_filed)
    {
        $new_leave_balance      = $leave_balance;
        $new_dtotal_days_filed  = $total_days_filed;
        $total                  = $new_leave_balance - $new_dtotal_days_filed;
        return (float)$total;
    }
}

if ( ! function_exists('add_leave_balance'))
{
    function add_leave_balance($leave_balance, $total_days_filed)
    {
        $new_leave_balance      = $leave_balance;
        $new_dtotal_days_filed  = $total_days_filed;
        $total                  = $new_leave_balance + $new_dtotal_days_filed;
        return (float)$total;
    }
}

if ( ! function_exists('number_of_hours'))
{

    function number_of_hours($time_start, $time_end)
    {
        $new_time_start = $time_start;
        $new_time_end   = $time_end;
        $total_hours    = strtotime($new_time_start) + strtotime($new_time_end);
        return (float)$total_hours;
    }
}

if ( ! function_exists('minutes_tardy'))
{

    function minutes_tardy($time_start, $time_end)
    {
        $new_time_start = $time_start;
        $new_time_end   = $time_end;
        $total_minutes  = strtotime($new_time_start) - strtotime($new_time_end);
        return (float)$total_minutes;
    }
}

if ( ! function_exists('minutes_undertime'))
{

    function minutes_undertime($time_start, $time_end)
    {
        $new_time_start  = $time_start;
        $new_time_end    = $time_end;
        $total_undertime = strtotime($new_time_start) - strtotime($new_time_end);
        return (float)$total_undertime;
    }
}

if (!function_exists('datetime_diff'))
{
    function datetime_diff($interval, $datetime, $method = 'add', $format = 'Y-m-d H:i:s')
    {
        $datetime = new DateTime($datetime);
        $datetime->$method(new DateInterval($interval));

        return $datetime->format($format);
    }
}

if (!function_exists('timediff_minutes'))
{
    function timediff_minutes($datetime_start, $datetime_end = '')
    {
        $datetime_end = ($datetime_end == '') ? date('Y-m-d H:i:s') : $datetime_end;

        $datetime1 = strtotime($datetime_start);
        $datetime2 = strtotime($datetime_end);
        $interval  = abs($datetime2 - $datetime1);
        $minutes   = round($interval / 60);

        return $minutes; 
    }
}

if (!function_exists('incremental_year'))
{
	function incremental_year($range = 11, $year_start = '')
	{
		$year_start = ($year_start == '') ? date('Y') : $year_start;
		$year_end	= $year_start + $range;
		$years 		= range($year_start, $year_end);

		return $years;
	}
}

if ( ! function_exists('current_git_branch'))
{
    function current_git_branch()
    {
        $stringfromfile = file('.git/HEAD', FILE_USE_INCLUDE_PATH);

        $firstLine = $stringfromfile[0]; //get the string from the array

        $explodedstring = explode("/", $firstLine, 3); //seperate out by the "/" in the string

        $branchname = $explodedstring[2]; //get the one that is always the branch name

        return $branchname;
    }
}

if ( ! function_exists('string_converter'))
{
    function string_converter($string, $callback)
    {
        $result = array(
            'lower' => strtolower($string),
            'upper' => strtoupper($string)
        );

        if (is_callable($callback))
        {
            call_user_func($callback, $result);
        }
    }
}

if ( ! function_exists('e'))
{
    function e($string)
    {
        return htmlentities($string);
    }
}

if ( ! function_exists('ordered_list'))
{
    function ordered_list($array, $parent_id = 0)
    {
        $temp_array = array();
        
        foreach($array as $element)
        {
            if ($element['parent_id'] == $parent_id)
            {
                $element['subs'] = ordered_list($array, $element['id']);
                $temp_array[] = $element;
            }
        }

        return $temp_array;
    }
}


if (!function_exists('datetime_range')) {
    /**
     * Get the total range of two set dates
     *
     * @param string $datetime_start
     * @param string $datetime_end
     * @param string $unit DEFAULT minutes
     * @return void
     */
    function datetime_range($datetime_start, $datetime_end, $unit = 'minutes')
    {
        $timestamp_start = date_timestamp_get(date_create($datetime_start));
        $timestamp_end = date_timestamp_get(date_create($datetime_end));

        $seconds = abs($timestamp_end - $timestamp_start);
        $minutes = $seconds / 60;
        $hours   = ($seconds / 60) / 60;

        $time_units = array(
            'seconds' => $seconds,
            'minutes' => $minutes,
            'hours' => $hours
        );

        return $time_units[$unit];
    }
}

if (!function_exists('time_stamp_diff')) {
    function time_stamp_diff($unit = 'hours', $date_start, $date_end = null)
    {
        $date_end = ($date_end == null) ? date('Y-m-d H:i:s') : $date_end;

        $date_start = date_create($date_start); // estimated checkout
        $date_end = date_create($date_end);

        $interval = $date_start->diff($date_end);

        $result = [
            'days' => $interval->format('%d'),
            'hours' => $interval->format('%h'),
            'minutes' => $interval->format('%i'),
            'interval' => $interval
        ];

        return $result[$unit];
    }
}
