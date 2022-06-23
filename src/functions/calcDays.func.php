<?php
    function calcDays($checkOut, $checkIn){
        $dayDifference = date_diff(date_create($checkIn), date_create($checkOut));
        $amountOfDays = $dayDifference->format('%a');

        return $amountOfDays;
    };
?>