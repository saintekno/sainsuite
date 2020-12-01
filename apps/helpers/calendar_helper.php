<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * SainSuite
 *
 * Engine Management System
 *
 * @package     SainSuite
 * @copyright   Copyright (c) 2019-2020 Buddy Winangun, Eracik.
 * @copyright   Copyright (c) 2020 SainTekno, SainSuite.
 * @link        https://github.com/saintekno/sainsuite
 * @filesource
 */

function get_academic_year($datestr)
{
    $year = substr($datestr, 0, 4);
    if(intval(substr($datestr,4,2)) < 8)
        $ayear = ($year - 1).'/'.$year;
    else
        $ayear = ($year).'/'.($year + 1);

    return $ayear;
}

function get_semester($datestr)
{
    if(intval(substr($datestr,5,2)) <= 6)
        $semester = 1;
    else
        $semester = 2;

    return $semester;
}

function get_year($datestr)
{
    return intval(substr($datestr,0,4));
}

function get_range_date($start_date = '', $end_date = '')
{
    $tgl1 = new DateTime($start_date);
    $tgl2 = new DateTime($end_date);
    $d = $tgl2->diff($tgl1)->days + 1;
    $selisi = $d." hari";

    return $selisi;
}