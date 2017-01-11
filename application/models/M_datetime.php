<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class M_datetime extends CI_Model {

    private $month_th = array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
    private $month_th_MM = array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");

    function DDMMYYYYLineToDBFormat($date) {
        if ($date == NULL) {
            return NULL;
        }
        $temp = explode('/', $date);
        return ($temp[2] - 543) . '-' . $temp[1] . '-' . $temp[0];
    }

    function nowToDBFormat() {
        $format = 'DATE_W3C';
        $time = time();
        return standard_date($format, $time);
    }

    function DBToHuman($DB_date) {
        $temp = explode(' ', $DB_date);
        $temp_date = explode('-', $temp[0]);
        $date = $temp_date[2] . ' ' . $this->month_th[intval($temp_date[1])] . ' ' . $temp_date[0];
        $time = substr($temp[1], 0, 5);
        return $date . ' เวลา ' . $time;
    }

    function DBShortToHuman($DB_date) {
        $temp_date = explode('-', $DB_date);
        if (count($temp_date) == 2) {
            $date = $temp_date[2] . ' ' . $this->month_th[intval($temp_date[1])] . ' ' . $temp_date[0];
            return $date;
        }
        return $DB_date;
    }

    function DBShortToHumanSlash($DB_date) {
        if ($DB_date == NULL) {
            return NULL;
        }
        $temp_date = explode('-', $DB_date);
        $date = $temp_date[2] . '/' . $temp_date[1] . '/' . ($temp_date[0] + 543);
        return $date;
    }

    function DBShortToThMM($DB_date) {
        if ($DB_date == NULL) {
            return NULL;
        }
        $temp_date = explode('-', $DB_date);
        if (substr($temp_date[2], 0, 1) == '0') {
            $temp_date[2] = ' ' . substr($temp_date[2], 1, 1);
        };
        $date = $temp_date[2] . ' ' . $this->month_th_MM[intval($temp_date[1])] . ' ' . ($temp_date[0] + 543);
        return $date;
    }

    function DBToDay() {
        return date('Y-m-d');
    }

    /*
     * CONVERT INPUT DATE TO DATABASE
     */

    public function DateThaiSlashShortToDB($input_date) {
        /*
         * dd/mm/yyyy (th) => yyyy-mm-dd (DB)
         */
        if ($input_date == NULL) {
            return NULL;
        }
        $temp_date = explode('/', $input_date);
        $date = ($temp_date[2] - 543) . '-' . $temp_date[1] . '-' . $temp_date[0];
        return $date;
    }

    /*
     * 
     */

    public function DBToDateThaiSlashShort($DB_date) {
        /*
         * yyyy-mm-dd (DB) => dd/mm/yyyy (th)
         */
        if ($DB_date == NULL) {
            return NULL;
        }
        $temp_date = explode('-', $DB_date);
        $date = $temp_date[2] . '/' . $temp_date[1] . '/' . ($temp_date[0] + 543);
        return $date;
    }

    public function DBToDateThaiFull($DB_date) {
        /*
         * yyyy-mm-dd (DB) => dd MMM yyyy (th)
         */
        if ($DB_date == NULL) {
            return NULL;
        }
        $temp_date = explode('-', $DB_date);
        $date = $temp_date[2] . ' ' . $this->month_th[(int) $temp_date[1]] . ' ' . ($temp_date[0] + 543);
        return $date;
    }

    /*
     * New imprement
     */

    function createDate(&$data) {
        $data['CreateBy'] = $this->session->userdata('user');
        $data['CreateDate'] = $this->nowToDBFormat();
    }

    function updateDate(&$data) {
        $data['UpdateBy'] = $this->session->userdata('user');
        $data['UpdateDate'] = $this->nowToDBFormat();
    }

}
