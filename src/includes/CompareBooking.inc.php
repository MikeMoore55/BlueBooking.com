<?php
    session_start();

    include ("/MAMP/htdocs/BlueBooking.com/src/includes/HotelInitialization.inc.php");
    include ("/MAMP/htdocs/BlueBooking.com/src/classes/HotelBookingInfoClass.class.php");
    
    /* take json, convert to array */
    $Hotels = hotelOptionsArray();

    $Booking = file_get_contents("bookingInfo.json");
    $BookingArray = json_decode($Booking, TRUE);

    $hotelOptionArray = $_SESSION["simpleHotelArray"];
    $selectedHotelName = $_SESSION["selectedHotel"];

    unset($hotelOptionArray["$selectedHotelName"]);

    $options = $hotelOptionArray;
    $twoOptions = array_slice($options, 0, 2);
?>

<main>
    <?php
        print_r($twoOptions);
    ?>
</main>