<?php

class Attendance_dtr
{
    protected $ci;
    
    protected $_params = array();

    protected $istesting = false;

    protected $_dtr_date;
    protected $_dtr_time_in;
    protected $_dtr_time_out;
    protected $_number_of_hours;
    protected $_minutes_undertime;

    protected $_minutes_nightdiff;
    protected $_nightdiff_time_start;
    protected $_nightdiff_time_end;
    protected $_nightdiff_val;

    protected $_minutes_ot;
    protected $_minutes_ot_nightdiff;
    protected $_ot_time_start;
    protected $_ot_time_end;

    protected $_minutes_hday_reg;
    protected $_minutes_hday_reg_nightdiff;
    protected $_minutes_hday_reg_ot;
    protected $_minutes_hday_reg_ot_nightdiff;

    protected $_minutes_hday_spcl;
    protected $_minutes_hday_spcl_nightdiff;
    protected $_minutes_hday_spcl_ot;
    protected $_minutes_hday_spcl_ot_nightdiff;

    protected $_minutes_rest;
    protected $_minutes_rest_nightdiff;
    protected $_minutes_rest_ot;
    protected $_minutes_rest_ot_nightdiff;
    protected $_minutes_rest_hday_reg;
    protected $_minutes_rest_hday_reg_nightdiff;
    protected $_minutes_rest_hday_reg_ot;
    protected $_minutes_rest_hday_reg_ot_nightdiff;
    protected $_minutes_rest_hday_spcl;
    protected $_minutes_rest_hday_spcl_nightdiff;
    protected $_minutes_rest_hday_spcl_ot;
    protected $_minutes_rest_hday_spcl_ot_nightdiff;

    protected $_employee_shift_type;
    protected $_employee_info_shift_schedule_id;
    protected $_employee_shift_schedule;

    protected $_employee_filed_ot;

    protected $_is_rest_day             = false;
    protected $_has_undertime           = false;
    protected $_is_nightdiff            = false;
    protected $_has_ot_nightdiff        = false;
    protected $_is_regular_holiday      = false;
    protected $_is_special_holiday      = false;
    protected $_has_filed_overtime      = false;
    protected $_has_holiday_schedule    = false;

    public $return_values = array();

    function __construct()
    {
        $this->ci =& get_instance();

        $this->ci->load->model(array(
            'system_config_model',
            'shift_schedule_model',
            'attendance_time_log_model',
            'attendance_employee_daily_schedule_model',
            'holiday_model',
            'employee_information_model',
            'employee_model',
            'attendance_daily_time_record_model',
            'payroll_cutoff_model'
        ));
    }

    function initialize($params = array())
    {
        $this->_params = $params;

        $employee_id = $params['variables']['employee_id'];

        $nightdiff_time_start = $this->ci->system_config_model->get_by(array('name' => 'night_differential_time_start'));
        $nightdiff_time_end   = $this->ci->system_config_model->get_by(array('name' => 'night_differential_time_end'));

        $this->_employee_filed_ot = $this->ci->overtime_model->get_details('get_by', array(
            'attendance_overtimes.employee_id' => $employee_id
        ));

        $employee_filed_ot = $this->_employee_filed_ot;

        $this->_minutes_tardy                       = $params['employee_dtr']['minutes_tardy'];
        $this->_nightdiff_time_start                = date('H:i:s', strtotime($nightdiff_time_start['value']));
        $this->_nightdiff_time_end                  = date('H:i:s', strtotime($nightdiff_time_end['value']));
        $this->_ot_date                             = $employee_filed_ot['date'];
        $this->_ot_time_start                       = $employee_filed_ot['time_start'];
        $this->_ot_time_end                         = $employee_filed_ot['time_end'];
        $this->_dtr_date                            = $params['employee_dtr']['date'];
        $this->_dtr_time_in                         = $params['employee_dtr']['time_in'];
        $this->_dtr_time_out                        = $params['employee_dtr']['time_out'];
        $this->_number_of_hours                     = $params['employee_dtr']['number_of_hours'];
        $this->_minutes_nightdiff                   = $params['employee_dtr']['minutes_nightdiff'];
        $this->_minutes_ot                          = $params['employee_dtr']['minutes_ot'];
        $this->_minutes_ot_nightdiff                = $params['employee_dtr']['minutes_ot_nightdiff'];
        $this->_minutes_hday_reg                    = $params['employee_dtr']['minutes_hday_reg'];
        $this->_minutes_hday_reg_nightdiff          = $params['employee_dtr']['minutes_hday_reg_nightdiff'];
        $this->_minutes_hday_reg_ot                 = $params['employee_dtr']['minutes_hday_reg_ot'];
        $this->_minutes_hday_reg_ot_nightdiff       = $params['employee_dtr']['minutes_hday_reg_ot_nightdiff'];
        $this->_minutes_hday_spcl                   = $params['employee_dtr']['minutes_hday_spcl'];
        $this->_minutes_hday_spcl_nightdiff         = $params['employee_dtr']['minutes_hday_spcl_nightdiff'];
        $this->_minutes_hday_spcl_ot                = $params['employee_dtr']['minutes_hday_spcl_ot'];
        $this->_minutes_hday_spcl_ot_nightdiff      = $params['employee_dtr']['minutes_hday_spcl_ot_nightdiff'];
        $this->_minutes_rest                        = $params['employee_dtr']['minutes_rest'];
        $this->_minutes_rest_nightdiff              = $params['employee_dtr']['minutes_rest_nightdiff'];
        $this->_minutes_rest_ot                     = $params['employee_dtr']['minutes_rest_ot'];
        $this->_minutes_rest_ot_nightdiff           = $params['employee_dtr']['minutes_rest_ot_nightdiff'];
        $this->_minutes_rest_hday_reg               = $params['employee_dtr']['minutes_rest_hday_reg'];
        $this->_minutes_rest_hday_reg_nightdiff     = $params['employee_dtr']['minutes_rest_hday_reg_nightdiff'];
        $this->_minutes_rest_hday_reg_ot            = $params['employee_dtr']['minutes_rest_hday_reg_ot'];
        $this->_minutes_rest_hday_reg_ot_nightdiff  = $params['employee_dtr']['minutes_rest_hday_reg_ot_nightdiff'];
        $this->_minutes_rest_hday_spcl              = $params['employee_dtr']['minutes_rest_hday_spcl'];
        $this->_minutes_rest_hday_spcl_nightdiff    = $params['employee_dtr']['minutes_rest_hday_spcl_nightdiff'];
        $this->_minutes_rest_hday_spcl_ot           = $params['employee_dtr']['minutes_rest_hday_spcl_ot'];
        $this->_minutes_rest_hday_spcl_ot_nightdiff = $params['employee_dtr']['minutes_rest_hday_spcl_ot_nightdiff'];

        $this->_employee_shift_type = $params['employee_info']['shift_type'];
        $this->_employee_info_shift_schedule_id = $params['employee_info']['shift_schedule_id'];



        // $this->_employee_shift_schedule = $this->check_shift_schedule();
    /* Commented Functions
        // $this->check_attendance_overtime();
        // $this->check_attendance_regular_holiday();
        // $this->check_attendance_special_holiday();


        // $this->minutes_nightdiff();
        // $this->minutes_ot();        
        // $this->minutes_ot_nightdiff();

        // 
        // $this->minutes_hday_reg();
        // $this->minutes_hday_reg_nightdiff();
        // $this->minutes_hday_reg_ot();
        // $this->minutes_hday_reg_ot_nightdiff();

        // $this->minutes_hday_spcl();
        // $this->minutes_hday_spcl_nightdiff();
        // $this->minutes_hday_spcl_ot();
        // $this->minutes_hday_spcl_ot_nightdiff();

        // $this->minutes_rest();
        // $this->minutes_rest_nightdiff();
        // $this->minutes_rest_ot();
        // $this->minutes_rest_ot_nightdiff();

        // $this->minutes_rest_hday_reg();
        // $this->minutes_rest_hday_reg_nightdiff();
        // $this->minutes_rest_hday_reg_ot();
        // $this->minutes_rest_hday_reg_ot_nightdiff();

        // $this->minutes_rest_hday_spcl();
        // $this->minutes_rest_hday_spcl_nightdiff();
        // $this->minutes_rest_hday_spcl_ot();
        // $this->minutes_rest_hday_spcl_ot_nightdiff();
    */
    }

    function timeout_trigger($params)
    {
        // INFORMATION
        $employee_id = $params['employee_info']['employee_id'];
        $current_date = $params['date'];

        // TIME LOGS
        $this->_dtr_time_in = $params['time_in'];
        $this->_dtr_time_out = $params['time_out'];

        // GET SHIFT SCHEDULE
        $this->_employee_shift_type = $params['employee_info']['shift_type'];
        $this->_employee_info_shift_schedule_id = $this->get_shift_schedule_id($employee_id, $current_date);
        $this->_employee_shift_schedule = $this->get_shift_schedule($employee_id, $current_date);
        $shift_id = $this->_employee_info_shift_schedule_id;

        $this->_is_rest_day = $this->isRestDay($employee_id, $shift_id, $current_date);
        $this->_is_regular_holiday = $this->isRegHoliday($params['employee_info'], $current_date);
        $this->_is_special_holiday = $this->isSpeclHoliday($params['employee_info'], $current_date);

        // NIGHT DIFF
        $nightdiff = $this->set_night_differential_datetime($current_date);
        $this->_nightdiff_time_start = $nightdiff['time_start'];
        $this->_nightdiff_time_end = $nightdiff['time_end'];
        $this->_is_nightdiff = $this->isNightDiff();
        $this->_init_undertime_val = $param['minutes_undertime'];

        // RETURN VALUES
        $this->return_values['number_of_hours'] = $this->number_of_hours();
        $this->return_values['minutes_tardy'] = $this->minutes_tardy();
        $this->return_values['minutes_undertime'] = $this->minutes_undertime();
        $this->return_values['minutes_nightdiff'] = $this->minutes_nightdiff();

    }

    /**
     * get number_of_hours
     *
     * @return void
     */
    protected function number_of_hours()
    {
        if( !(isset($this->_dtr_time_in)) ||
            !(isset($this->_dtr_time_out)) ) 
        { 
            return 0;
        }

        $result = 0;                                                                    // return information
        $number_of_hours = intval(datetime_range($this->_dtr_time_in, $this->_dtr_time_out));
        $number_of_hours = floatval($number_of_hours / 60);
        $result = number_format($number_of_hours, 2);

        return $result;
    }

    /**
     * get tardy minutes
     *
     * @return void
     */
    protected function minutes_tardy()
    {
        /* initialization information */
        $employee_schedule = $this->_employee_shift_schedule;                           // get employee_schedule                                                               // return information
        
        if( !(isset($employee_schedule['time_gp'])) ||
            !(isset($employee_schedule['time_start'])) ||
            !(isset($this->_dtr_time_in)) ||
            !(isset($this->_dtr_time_out)) ) 
        { 
            return 0; 
        }

        if ($this->_dtr_time_in > $employee_schedule['time_gp'])
        {
            // late time-in
            $result += intval(datetime_range($this->_dtr_time_in, $employee_schedule['time_start']));
        }

        return $result;
    }

    /**
     * Undocumented function
     *
     * @return int
     */
    function minutes_nightdiff()
    {
        if( 
            ($this->_is_nightdiff) && 
            ($this->_is_regular_holiday) &&
            ($this->_is_special_holiday)
        )
        {
            return 0;
        }
        
        /* initialization information */
        $employee_schedule = $this->_employee_shift_schedule;                           // get employee_schedule                                                               // return information
        
        if( !(isset($employee_schedule['time_gp'])) ||
            !(isset($employee_schedule['time_start'])) ||
            !(isset($this->_dtr_time_in)) ||
            !(isset($this->_dtr_time_out)) ) 
        { 
            return 0; 
        }

        return intval($this->get_nightdiff_val($this->_dtr_time_in, $this->_dtr_time_out));
        
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    protected function minutes_undertime()
    {
        /* initialization information */
        $employee_schedule = $this->_employee_shift_schedule;                           // get employee_schedule
        
        if( !(isset($employee_schedule['time_gp'])) ||
            !(isset($employee_schedule['time_start'])) ||
            !(isset($this->_dtr_time_in)) ||
            !(isset($this->_dtr_time_out)) ) 
        { 

            return $this->_init_undertime_val;
        }

        if ($this->_dtr_time_in > $employee_schedule['time_gp'])
        {
            // late time-in
            $result += intval(datetime_range($this->_dtr_time_in, $employee_schedule['time_start']));
        }

        if ($this->_dtr_time_out < $employee_schedule['time_end'])
        {
            // early out
            $result += intval(datetime_range($this->_dtr_time_out, $employee_schedule['time_end']));
        }

        return ($result + $this->_init_undertime_val);
    }

    /**
     * Undocumented function
     *
     * @return int
     */
    function minutes_ot($time_start, $time_end)
    {
        if( 
            ($this->_is_nightdiff) && 
            ($this->_is_regular_holiday) &&
            ($this->_is_special_holiday)
        )
        {
            return 0;
        }
        
        /* initialization information */
        $employee_schedule = $this->_employee_shift_schedule;                           // get employee_schedule
        
        if( !(isset($employee_schedule['time_gp'])) ||
            !(isset($employee_schedule['time_start'])) ||
            !(isset($this->_dtr_time_in)) ||
            !(isset($this->_dtr_time_out)) ) 
        { 

            return 0;
        }

        // do overtime computation
        if($this->_dtr_time_out > $employee_schedule['time_end'])
        {
            // do computation
            $get_val = $this->get_ot_nd_val($time_start, $time_end);
            return $get_val['overtime'];
        }
    }

    /**
     * Undocumented function
     *
     * @return int
     */
    function minutes_ot_nightdiff($time_start, $time_end)
    {
        if ( !($this->_is_nightdiff)) return 0;

        if( 
            ($this->_is_regular_holiday) &&
            ($this->_is_special_holiday)
        )
        {
            return 0;
        }
        
        /* initialization information */
        $employee_schedule = $this->_employee_shift_schedule;                           // get employee_schedule
        
        if( !(isset($employee_schedule['time_gp'])) ||
            !(isset($employee_schedule['time_start'])) ||
            !(isset($this->_dtr_time_in)) ||
            !(isset($this->_dtr_time_out)) ) 
        { 

            return 0;
        }

        // do overtime computation
        if($this->_dtr_time_out > $employee_schedule['time_end'])
        {
            // do computation
            $get_val = $this->get_ot_nd_val($time_start, $time_end);
            return $get_val['overtime'];
        }
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    function minutes_hday_reg()
    {
        if($this->_is_nightdiff) return 0;
        if($this->_is_special_holiday) return 0; 

        if ($this->_is_regular_holiday)
        {
            /* initialization information */
            $employee_schedule = $this->_employee_shift_schedule;                           // get employee_schedule
            
            if( !(isset($employee_schedule['time_gp'])) ||
                !(isset($employee_schedule['time_start'])) ||
                !(isset($this->_dtr_time_in)) ||
                !(isset($this->_dtr_time_out)) ) 
            { 

                return 0;
            }

            return intval(datetime_range($this->_dtr_time_in, $this->_dtr_time_out));
        }
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    protected function minutes_hday_reg_nightdiff()
    {
        if ( ($this->_is_special_holiday) ) return 0;
        
        if (
            ($this->_is_nightdiff) &&
            ($this->_is_regular_holiday) 
        )
        {
            /* initialization information */
            $employee_schedule = $this->_employee_shift_schedule;                           // get employee_schedule
            
            if( !(isset($employee_schedule['time_gp'])) ||
                !(isset($employee_schedule['time_start'])) ||
                !(isset($this->_dtr_time_in)) ||
                !(isset($this->_dtr_time_out)) ) 
            { 

                return 0;
            }

            // do computation
            return $this->get_nightdiff_val($this->_dtr_time_in, $this->_dtr_time_out);
        }
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    protected function minutes_hday_reg_ot($time_start, $time_end)
    {
        if ($this->_is_special_holiday) return 0;
        if ($this->_is_nightdiff) return 0;
        
        if ($this->_is_regular_holiday)
        {
            /* initialization information */
            $employee_schedule = $this->_employee_shift_schedule;                           // get employee_schedule
            
            if( !(isset($employee_schedule['time_gp'])) ||
                !(isset($employee_schedule['time_start'])) ||
                !(isset($this->_dtr_time_in)) ||
                !(isset($this->_dtr_time_out)) ) 
            { 

                return 0;
            }

            $get_val = $this->get_ot_nd_val($time_start, $time_end);
            return $get_val['overtime'];
        }
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    protected function minutes_hday_reg_ot_nightdiff($time_start, $time_end)
    {
        if ($this->_is_special_holiday) return 0;
        
        if (
            ($this->_is_regular_holiday) &&
            ($this->_is_nightdiff)
        )
        {
            /* initialization information */
            $employee_schedule = $this->_employee_shift_schedule;                           // get employee_schedule
            
            if( !(isset($employee_schedule['time_gp'])) ||
                !(isset($employee_schedule['time_start'])) ||
                !(isset($this->_dtr_time_in)) ||
                !(isset($this->_dtr_time_out)) ) 
            { 

                return 0;
            }

            $get_val = $this->get_ot_nd_val($time_start, $time_end);
            return $get_val['night_diff'];
        }
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    protected function minutes_hday_spcl()
    {
        if ($this->_is_nightdiff) return 0;
        if ($this->_is_regular_holiday) return 0; 

        if ($this->_is_special_holiday)
        {
            /* initialization information */
            $employee_schedule = $this->_employee_shift_schedule;                           // get employee_schedule
            
            if( !(isset($employee_schedule['time_gp'])) ||
                !(isset($employee_schedule['time_start'])) ||
                !(isset($this->_dtr_time_in)) ||
                !(isset($this->_dtr_time_out)) ) 
            { 

                return 0;
            }

            return intval(datetime_range($this->_dtr_time_in, $this->_dtr_time_out));
        }
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    protected function minutes_hday_spcl_nightdiff()
    {
        if ( !($this->_is_regular_holiday)) return 0;
        if ( !($this->_is_rest_day) ) return 0;
     
        if( 
            ($this->_is_special_holiday) &&
            ($this->_is_nightdiff)
        ) 
        {
            // do computation
            return $this->get_nightdiff_val($this->_dtr_time_in, $this->_dtr_time_out);
        }

        return 0;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    protected function minutes_hday_spcl_ot($time_start, $time_end)
    {
        if ( !($this->_is_regular_holiday)) return 0;
        if ( !($this->_is_rest_day) ) return 0;
     
        if( 
            ($this->_is_special_holiday) &&
            ($this->_is_nightdiff)
        ) 
        {
            // do computation
            $get_val = $this->get_ot_nd_val($time_start, $time_end);
            return $get_val['overtime'];
        }

        return 0;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    function minutes_hday_spcl_ot_nightdiff($time_start, $time_end)
    {
        if ( !($this->_is_regular_holiday)) return 0;
        if ( !($this->_is_rest_day) ) return 0;
     
        if( 
            ($this->_is_special_holiday) &&
            ($this->_is_nightdiff)
        ) 
        {
            // do computation
            $get_val = $this->get_ot_nd_val($time_start, $time_end);
            return $get_val['night_diff'];
        }

        return 0;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    function minutes_rest()
    {
        if( !(isset($this->_dtr_time_in)) ||
            !(isset($this->_dtr_time_out)) ) 
        { 
            return 0;
        }

        return intval(datetime_range($this->_dtr_time_in, $this->_dtr_time_out));
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    function minutes_rest_nightdiff()
    {
        if( ($this->_is_rest_day) &&
            ($this->_is_nightdiff)
        ) 
        {
            // do computation
            return $this->get_nightdiff_val($this->_dtr_time_in, $this->_dtr_time_out);           
        }
        else
        {
            return 0;
        }

    }

    /**
     * Undocumented function
     *
     * @return void
     */
    function minutes_rest_ot($time_start, $time_end)
    {
        if( 
            ($this->_is_rest_day) &&
            !($this->_is_nightdiff)
        ) 
        {
            // do computation
            $get_val = $this->get_ot_nd_val($time_start, $time_end);
            return $get_val['night_diff'];
        }

        return 0;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    function minutes_rest_ot_nightdiff($time_start, $time_end)
    {
        if ( !($this->_is_special_holiday) ) return 0;
        if ( !($this->_is_regular_holiday)) return 0;

        if( 
            ($this->_is_rest_day) &&
            ($this->_is_nightdiff)
        ) 
        {
            // do computation
            $get_val = $this->get_ot_nd_val($time_start, $time_end);
            return $get_val['night_diff'];
        }

        return 0;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    protected function minutes_rest_hday_reg()
    {
        if ( !($this->_is_special_holiday) ) return 0;
        if ( !($this->_is_nightdiff) )  return 0;

        if ( 
            ($this->_is_rest_day) &&
            ($this->_is_regular_holiday)
        )
        {
            // do computation
            return intval(datetime_range($this->_dtr_time_in, $this->_dtr_time_out));
        }
        
        return 0;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    protected function minutes_rest_hday_reg_nightdiff($time_start, $time_end)
    {
        if ( !($this->_is_special_holiday) ) return 0;

        if ( 
            ($this->_is_rest_day) &&
            ($this->_is_regular_holiday) &&
            ($this->_is_nightdiff)
        )
        {
            return $this->get_nightdiff_val($time_start, $time_end);
        }
        
        return 0;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    protected function minutes_rest_hday_reg_ot($time_start, $time_end)
    {
        if ( !($this->_is_nightdiff) ) return 0;

        if ( 
            ($this->_is_rest_day) &&
            ($this->_is_regular_holiday)
        )
        {
            // do computation
            $get_val = $this->get_ot_nd_val($time_start, $time_end);
            return $get_val['overtime'];
        }
        
        return 0;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    protected function minutes_rest_hday_reg_ot_nightdiff($time_start, $time_end)
    {
        if ( 
            ($this->_is_rest_day) &&
            ($this->_is_regular_holiday) &&
            ($this->_is_nightdiff)
        )
        {
            // do computation
            $get_val = $this->get_ot_nd_val($time_start, $time_end);
            return $get_val['night_diff'];
        }
        
        return 0;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    protected function minutes_rest_hday_spcl()
    {
        if ( !($this->_is_nightdiff) ) return 0;

        if ( 
            ($this->_is_rest_day) &&
            ($this->_is_special_holiday)
        )
        {
            // do computation
            return intval(datetime_range($this->_dtr_time_in, $this->_dtr_time_out));
        }
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    protected function minutes_rest_hday_spcl_nightdiff($time_start, $time_end)
    {
        if ( 
            ($this->_is_rest_day) &&
            ($this->_is_special_holiday) &&
            ($this->_is_nightdiff)
        )
        {
            // do computation
            $get_val = $this->get_ot_nd_val($time_start, $time_end);
            return $get_val['night_diff'];
        }

        return 0;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    function minutes_rest_hday_spcl_ot($time_start, $time_end)
    {
        if ( !($this->_is_nightdiff) ) return 0;
        if ( !($this->_is_regular_holiday) ) return 0;

        if ( 
            ($this->_is_rest_day) &&
            ($this->_is_special_holiday)
            // is_overtime
        )
        {
            // do computation
            $get_val = $this->get_ot_nd_val($time_start, $time_end);
            return $get_val['overtime'];
        }

        return 0;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    function minutes_rest_hday_spcl_ot_nightdiff($time_in, $time_end)
    {
        if( !($this->_is_regular_holiday) ) return 0;

        if ( 
            ($this->_is_rest_day) &&
            ($this->_is_special_holiday) &&
            ($this->_is_nightdiff)
        )
        {
            // do computation
            $get_val = $this->get_ot_nd_val($time_start, $time_end);
            return $get_val['night_diff'];
        }

        return 0;
    }

    /**
     * Other functions
     */
  
    function validate_date($date, $format = 'Y-m-d')
    {
        $d = DateTime::createFromFormat($format, $date);
        // The Y ( 4 digits year ) returns TRUE for any integer with 
        // any number of digits so changing the comparison from == to === fixes the issue.
        return $d && $d->format($format) === $date;
    }

    function get_valid_date($date, $format = 'Y-m-d')
    {
        $sts = FALSE;

        $date = explode('-', $date);
        $date[1] = str_pad($date[1], 2, '0', STR_PAD_LEFT);
        $date[2] = str_pad($date[2], 2, '0', STR_PAD_LEFT);
        $date = implode('-', $date);

        while(!$sts)
        {
            $sts = $this->validate_date($date);
            if(!$sts)
            {
                $date = explode('-', $date);
                $date[2] = $date[2] - 1;
                $date = implode('-', $date);
            }
        }

        return date($format, strtotime($date));
    }

    public function validate_range_of_dates($dates)
    {
        if($this->istesting)
        {
            // TESTING
            $current_date = date('Y') .'-'. 1 .'-'. $dates['start_dayofmonth'];
            $current_date = $this->get_valid_date($current_date);

            $end_date = date('Y') .'-'. 1 .'-'. $dates['end_dayofmonth'];
            $end_date = $this->get_valid_date($end_date);
        }
        else
        {
            $current_date = date('Y') .'-'. date('m') .'-'. $dates['start_dayofmonth'];
            $current_date = $this->get_valid_date($current_date);

            $end_date = date('Y') .'-'. date('m') .'-'. $dates['end_dayofmonth'];
            $end_date = $this->get_valid_date($end_date);
        }
        
        if($current_date > $end_date)
        {
            $temp_date = new DateTime($current_date);
            $temp_date->add(new DateInterval('P'. $dates['end_dayofmonth'] .'D'));
            
            $end_date = $temp_date->format('Y-m') . '-' . $dates['end_dayofmonth'];

            // validate date
            $end_date = $this->get_valid_date($end_date);   
        }

        $ret = array(
            'start_date' => $current_date,
            'end_date' => $end_date
        );

        return $ret;
    } 

    /**
     * Get employee shift schedule function
     * @param $id[int]: employee IDs
     * @param $current_date[Date]: any date 
     * 
     */
    
    function get_shift_schedule_id($id, $current_date)
    {
        $shift_schedule_id = NULL;
        // DateTime Formatting
        $date = date('Y-m-d', strtotime($current_date));
        
        $employee = $this->ci->employee_info_model->get_by(['employee_id' => $id]);

        switch ($employee['shift_type'])
        {
            case 0: // fixed schedule
            case 1: // flexi daily schedule
            case 2: // flexi weekly schedule
            case 4: // exempted schedule
                $shift_schedule_id = $employee['shift_schedule_id'];

                break;
            case 3: // variable schedule
                $shift_schedule = $this->ci->attendance_employee_daily_schedule_model->get_by([
                    'employee_id' => $id,
                    'date' => $date
                ]);

                $shift_schedule_id = $shift_schedule['shift_id'];

                break;
            default:
                // do nothing

                break;
        }
        
        return $shift_schedule_id;
    }

    /**
     * Get employee shift schedule function
     * @param $id[int]: employee IDs
     * @param $current_date[Date]: any date 
     * 
     * @return array(
     *  Int id
     *  DateTime time_start
     *  DateTime time_end
     *  DateTime time_gp
     * )
     */
    function get_shift_schedule($id, $current_date)
    {
        $shift_schedule_id = $this->get_shift_schedule_id($id, $current_date);

        // fail safe guards
        if ( isset($shift_schedule_id))
        { 
            $shift_info = $this->ci->shift_schedule_model->get_by(['id' => $shift_schedule_id]);
        }
        else
        {
            return null;
        }

        if( !isset($shift_info['time_start']) ||
            !isset($shift_info['time_end'])
        )
        {
            return null;
        }  

        // initialization information
        $shift_time_start = NULL;
        $shift_time_end = NULL;
        $grace_period = NULL;

        // get time start and time end scheule
        $diff = datetime_range($shift_info['time_start'], $shift_info['time_end']);
        $shift_time_start = implode(array($current_date, ' ', $shift_info['time_start']));
        $shift_time_end = new DateTime($shift_time_start);
        $shift_time_end->add(new DateInterval('PT' . $diff . 'M'));
        $shift_time_end = $shift_time_end->format('Y-m-d');

        // return datetime
        $shift_time_end = implode(array($shift_time_end, ' ', $shift_info['time_end'])); 

        // get grace period
        if ($shift_info['grace_period'] > 0)
        {
            $grace_period = new DateTime($shift_time_start);
            $grace_period->add(new DateInterval('PT' . $shift_info['grace_period'] . 'M'));
            $grace_period = $grace_period->format('Y-m-d H:i:s');
        }

        // return values
        $ret = array(
            'shift_id'          => $shift_schedule_id,                                                              // shift schedule id
            'time_start'        => $shift_time_start,                                                               // shift schedule time start [DateTime]
            'time_end'          => $shift_time_end,                                                                 // shift schedule time end [DateTime]
            'time_gp'           => $grace_period                                                                    // shift schedule grace period [DateTime]
        );

        return $ret;
    } 

    public function generate_dates_to_dtr()
    {
        if($this->istesting)
        {
            $generate_date = array(
                'start_dayofmonth' => 26,
                'end_dayofmonth' => 10
            );
        }
        else
        {
            $generate_date =  $this->ci->payroll_cutoff_model->get_by([
                'start_dayofmonth' => date('d')
            ]);
        }

        if ( !(isset($generate_date)) ) return;

        $dates = $this->validate_range_of_dates($generate_date);
        $current_date = $dates['start_date'];
        $end_date = $dates['end_date'];

        if($this->istesting) { dump($dates);}

        while($current_date <= $end_date)
        {
            $employees = $this->ci->employee_information_model->get_all();

            foreach ($employees as $employee)
            {
                $data_dtr = array(
                    'employee_id' => $employee['employee_id'],
                    'date' => $current_date,
                    'reports_to' => $employee['reports_to'],
                    'company_id' => $employee['company_id'],
                    'site_id' => $employee['site_id'],
                    'logs_processed' => 0
                );

                if (!($this->_check_logs_exist($this->ci->attendance_daily_time_record_model, $data_dtr)))
                {
                    if($this->istesting) { dump($data_dtr);}
                    $this->ci->attendance_daily_time_record_model->insert($data_dtr);
                }
            }

            $current_date = date('Y-m-d', strtotime($current_date. ' + 1 days'));
        }
    }

    function _check_logs_exist($table, $params = array())
    {
        if ( ! isset($params['date'])) return FALSE;
        if ( ! isset($params['employee_id'])) return FALSE;
        
        $data = array(
            'date' => $params['date'],
            'employee_id' => $params['employee_id'],
        );

        $timelog = $table->get_by($data);

        return (isset($timelog));
    }

    protected function isRestDay($employee_id, $shift_id, $date)
    {
        $schedule = $this->ci->shift_schedule_model->get_by([
            'id' => $shift_id
        ]);

        $status = FALSE;

        switch ($schedule['type'])
        {
            case 0:
            case 1:
                $weekly_schedule = array(
                    $schedule['sunday'],
                    $schedule['monday'],
                    $schedule['tuesday'],
                    $schedule['wednesday'],
                    $schedule['thursday'],
                    $schedule['friday'],
                    $schedule['saturday']
                );

                $dayofweek = date('w', strtotime($date));

                if($weekly_schedule[$dayofweek] == 0)
                {
                    $status = TRUE;
                }
                break;
            case 2:
                // do Flexi weekly requirements
                break;
            case 3:
                $shift_schedule = $this->ci->attendance_employee_daily_schedule_model->get_by([
                    'employee_id' => $employee_id,
                    'date' => $date
                ]);

                if( !(isset($shift_schedule)) )
                {
                    $status = TRUE;
                }

                break;
            case 4:
                // do Exempted requirments
                break;
            defaut:
                break;
        }
        
        return $status;
    }

    protected function isRegHoliday($employee_info, $date)
    {
        $sts =  FALSE;

        $holiday = $this->ci->holiday_model->get_by([
            'holiday_date' => $date,
            'type' => 0,
            'active_status' => 1
        ]);
        
        if($holiday['site_id'] == $employee_info['site_id'])
        {
            $sts =  TRUE;
        }
        else if ($holiday['branch_id'] == $employee_info['branch_id'])
        {
            $sts =  TRUE;
        }
        else if ($holiday['company_id'] == $employee_info['company_id'])
        {
            $sts =  TRUE;
        }
        else
        {
            // do nothing
        }

        return $sts;
    }

    protected function isSpeclHoliday($employee_info, $date)
    {
         $holiday = $this->ci->holiday_model->get_by([
            'holiday_date' => $date,
            'type' => 1,
            'active_status' => 1
        ]);
        
        if($holiday['site_id'] == $employee_info['site_id'])
        {
            $sts =  TRUE;
        }
        else if ($holiday['branch_id'] == $employee_info['branch_id'])
        {
            $sts =  TRUE;
        }
        else if ($holiday['company_id'] == $employee_info['company_id'])
        {
            $sts =  TRUE;
        }
        else
        {
            $sts =  FALSE;
        }

        return $sts;
    }

    /**
     * @param date from DTR
     * 
     */
    function set_night_differential_datetime($current_date)
    {
        $nightdiff_time_start = $this->ci->system_config_model->get_by(array('name' => 'night_differential_time_start'));
        $nightdiff_time_end   = $this->ci->system_config_model->get_by(array('name' => 'night_differential_time_end'));

        $nightdiff_time_start = $nightdiff_time_start['value'];
        $nightdiff_time_end = $nightdiff_time_end['value'];

        $nd_diff = datetime_range($nightdiff_time_start, $nightdiff_time_end);
        $nd_time_start = implode(array($current_date, ' ', $nightdiff_time_start));         // get date/time start from current date and system config time
        $nd_time_end = new DateTime($nd_time_start);
        $nd_time_end->add(new DateInterval('PT' . $nd_diff . 'M'));
        $nd_time_end = $nd_time_end->format('Y-m-d');                                       // get date from result of nd_diff and nd_time_end
        $nd_time_end = implode(array($nd_time_end, ' ', $nightdiff_time_end));              // get date/time end from nd_time_end and system config time

        $ret = array(
            'time_start' => $nd_time_start,
            'time_end' => $nd_time_end
        );

        return $ret;
    }

    protected function isNightDiff()
    {
        $sts = false;
        if ( $this->_nightdiff_time_start < $this->_dtr_time_out )
        {
            $sts = true;
        }

        return $sts;
    }

    /**
     * @return int
     * 
     */
    protected function get_nightdiff_val($time_start, $time_end)
    {
        if ( !($this->_is_nightdiff) ){ return 0;}

        // pre-condition: _nightdiff_time_start < _dtr_time_out
        if (
            ($this->_nightdiff_time_start >= $time_start) &&
            ($this->_nightdiff_time_end >= $time_end)
        )
        {
            // sample: 20:00 - 05:00
            $result = datetime_range($this->_nightdiff_time_start, $time_end);
        }
        else if (
            ($this->_nightdiff_time_start < $time_start) &&
            ($this->_nightdiff_time_end >= $time_end)
        )
        {
            // sample: 23:00 - 5:00
            $result = datetime_range($time_start, $time_end);
        }
        else if( 
            ($this->_nightdiff_time_start >= $time_start) &&
            ($this->_nightdiff_time_end < $time_end)
        )
        {
            // sample: 21:00 - 7:00
            $result = datetime_range($this->_nightdiff_time_start, $this->_nightdiff_time_end);
        }
        else
        {
            // default
            $result = 0;
        }  

        return intval($result);
    }

    /**
     * Gets OT and NIGHTDIFF values
     * 
     * @return array()
     */
    function get_ot_nd_val($time_start, $time_end)
    {
        $nd = $this->get_nightdiff_val($time_start, $time_end);

        $ot = intval(datetime_range($time_start, $time_end));

        $result = array(
            'night_diff' => $nd,
            'overtime' => ($ot - $nd)
        );

        return $result;
    }
}

