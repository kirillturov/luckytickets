<?php
/**
 * Created by PhpStorm.
 * User: kiryan
 * Date: 06.08.18
 * Time: 15:50
 */

function get_lucky_tickets1($digits_count) {

    $lucky_nums = array();
    $digits_half = (int) ($digits_count / 2);
    $num_count = pow(10, $digits_half);
    $max_sum = 9 * $digits_half;

    $tmp = array_fill(0, $max_sum, array());
    $tmp[0][] = 0;
    for($i = 1; $i < $num_count; ++$i) {
        $sum = array_sum(str_split((string) $i));
        $tmp[$sum][] = $i;
    }


    foreach ($tmp as $sum) {
        foreach ($sum as $left_num) {
            foreach ($sum as $right_num) {
                $lucky_nums[] = $left_num * $num_count + $right_num;
            }
        }
    }

    return $lucky_nums;
}
