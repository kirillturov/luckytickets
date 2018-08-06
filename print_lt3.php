<?php
/**
 * Created by PhpStorm.
 * User: kiryan
 * Date: 06.08.18
 * Time: 23:31
 * @param $nulls
 * @param $pluses
 * @param $capacity
 * @return int
 */

function count_decompositions($nulls, $pluses, $capacity) {

    if ($pluses == 0) {
        return ($capacity <= 9) ? 1 : 0;
    }

    if ($pluses == $capacity) {
        return 1;
    }

    if ($nulls > 0) {
        return count_decompositions($nulls-1, $pluses, $capacity-1) +
            count_decompositions(9, $pluses-1, $capacity-1);
    }
    else {
        return count_decompositions(9, $pluses-1, $capacity-1);
    }
}

function generate_decomposition(&$vector, $index, $nulls, $pluses, $capacity) {

    if ($pluses == 0) {
        if ($capacity > 9) {
            return;
        }
        /** @noinspection PhpUnusedLocalVariableInspection */
        foreach (range(1, $capacity) as $iteration) {
            $vector[] = 0;
        }
        return;
    }

    if ($pluses == $capacity) {
        /** @noinspection PhpUnusedLocalVariableInspection */
        foreach (range(1, $capacity) as $iteration) {
            $vector[] = 1;
        }
        return;
    }
    $b = count_decompositions($nulls-1, $pluses, $capacity-1);
    if ($index <= $b && $nulls > 0) {
        $vector[] = 0;
        generate_decomposition($vector, $index, $nulls-1, $pluses, $capacity-1);
    }
    else {
        $vector[] = 1;
        if ($nulls == 0) {
            generate_decomposition($vector, $index, $nulls, $pluses-1, $capacity-1);
        }
        else {
            generate_decomposition($vector, $index-$b, 9, $pluses-1, $capacity-1);
            return;
        }
    }
}

function calculate_num($vector){
    $count = 0;
    $num = array();
    foreach (array_reverse($vector) as $i) {
        if ($i == 0) {
            ++$count;
        } else {
            $num[] = $count;
            $count = 0;
        }
    }
    $num[] = $count;
    return implode('', $num);
}

function generate_lt($index, $digits_count) {

    $digits_half = (int) ($digits_count/2);
    $b = 1;
    foreach (range(0, 9 * $digits_half) as $sum) {
        $b = count_decompositions(9, $digits_half-1, $sum+$digits_half-1);
        if (($index - pow($b,2)) < 0) {
            break;
        }
        $index -= pow($b, 2);
    }

    $left_index = (int) ($index/$b);
    $right_index = $index % $b;
    $left_num = array();
    generate_decomposition($left_num, $left_index+1, 9,$digits_half-1, $sum+$digits_half-1);
    $right_num = array();
    generate_decomposition($right_num, $right_index+1, 9,$digits_half-1, $sum+$digits_half-1);

    return sprintf("%0".(string) $digits_half."d", calculate_num($left_num)).
        sprintf("%0".(string) $digits_half."d", calculate_num($right_num));
}

function count_lt($digits_count) {

    $count = 0;
    $digits_half = (int) ($digits_count/2);

    foreach (range(0, 9 * $digits_half) as $sum) {
        $count += pow(count_decompositions(9, $digits_half-1, $sum+$digits_half-1), 2);
    }

    return $count;
}

function print_lucky_tickets3($digits_count) {

    $count = count_lt($digits_count);
    for ($index = 0; $index < $count; ++$index) {
        echo generate_lt($index, $digits_count)."\n";
    }
    echo 'count tickets: '.$count;
}