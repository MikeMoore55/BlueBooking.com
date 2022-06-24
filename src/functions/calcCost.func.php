<?php
    /* calculate total costs for the stay */
    function calcCosts($days, $rate){
        $totalCosts =  $days * $rate;
        
        return $totalCosts;
    } // future update - make it calculate with different rates depending on the dates in season ie. winter rates < summer rates
?>