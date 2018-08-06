<?php
/**
 * Created by PhpStorm.
 * User: kiryan
 * Date: 06.08.18
 * Time: 19:58
 */

function print_lucky_tickets2($digits_count) {

    $digits_half = (int) ($digits_count / 2);
    $half_count = pow(10, $digits_half);
    $num_count = pow(10, $digits_count);

    echo sprintf("%0".(string) $digits_count."d", 0)."\n";
    $count = 1;

    $left = 1;
    $right = 1;
    while ($count < $num_count && $left < $half_count) {
        $left_sum = array_sum(str_split((string) $left));
        while ($count < $num_count && $right < $half_count) {
            $right_sum = array_sum(str_split((string) $right));
            if ($left_sum == $right_sum) {
                echo sprintf("%0".(string) $digits_count."d", $left * $half_count + $right)."\n";
                ++$count;
            }
            ++$right;
        }
        ++$left;
        $right = 1;
    }
    echo 'count tickets: '.$count;
}
