<?php
/**
 * Created by PhpStorm.
 * User: kiryan
 * Date: 06.08.18
 * Time: 15:21
 */

    include 'getluckytickets1.php';
    include 'getluckytickets2.php';

    $digits = 6;
    $tickets = get_lucky_tickets1($digits);

    if ($digits % 2 == 0) {
        foreach($tickets as $ticket) {
            echo sprintf("%0".(string) $digits."d", $ticket)."\n";
        }
        echo 'count tickets: '.count($tickets);
    }
