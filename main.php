<?php
/**
 * Created by PhpStorm.
 * User: kiryan
 * Date: 06.08.18
 * Time: 15:21
 */

include 'print_lt1.php';
include 'print_lt2.php';
include 'print_lt3.php';

$digits = 6;

if ($digits % 2 == 0) {
    print_lucky_tickets1($digits);
}
