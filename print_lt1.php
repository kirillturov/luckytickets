<?php
/**
 * Created by PhpStorm.
 * User: kiryan
 * Date: 06.08.18
 * Time: 15:50
 * @param $digits_count
 */

function print_lucky_tickets1($digits_count) {

    $digits_half = (int) ($digits_count / 2);
    $num_count = pow(10, $digits_half);
    $max_sum = 9 * $digits_half;

    $tmp = array_fill(0, $max_sum, array());
    $tmp[0][] = 0;
    for($i = 1; $i < $num_count; ++$i) {
        $sum = array_sum(str_split((string) $i));
        $tmp[$sum][] = $i;
    }

    $count = 0;
    foreach ($tmp as $sum) {
        foreach ($sum as $left_num) {
            foreach ($sum as $right_num) {
                echo sprintf("%0".(string) $digits_count."d", $left_num * $num_count + $right_num)."\n";
                ++$count;
            }
        }
    }

    echo 'count tickets: '.$count;
}
