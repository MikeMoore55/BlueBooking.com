<?php
    /* calculate the amount of days user is staying */
    function calcDays($checkOut, $checkIn){
        $dayDifference = date_diff(date_create($checkIn), date_create($checkOut));
        $amountOfDays = $dayDifference->format('%a');

        return $amountOfDays;
    };// future update - make it calculate nights instead of days
?>