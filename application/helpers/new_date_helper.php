<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('new_date')) {
    function new_date()
    {
        // $ci = &get_instance();

        // $query = $ci->db->query(" SELECT nilai
        //                             FROM tb_setting
        //                             WHERE kode = 'TIMEZONE'");
        // $result = $query->row_array();

        // $timezone = $result['nilai'];

        $timezone = new DateTimeZone("Asia/Makassar");
        $dt = new DateTime();
        $dt->setTimeZone($timezone);
        $date = $dt->format('Y-m-d H:i:s');

        return $date;
    }
}
