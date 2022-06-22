<?php

    include ("/MAMP/htdocs/BlueBooking.com/src/includes/HotelInitialization.inc.php");
    include ("/MAMP/htdocs/BlueBooking.com/src/classes/HotelBookingInfoClass.class.php");

    /* take json, convert to array */
    $Hotels = hotelOptionsArray();

    if (isset($_POST["Book"])) {
        $username = $_POST["firstName"];
        $userSurname = $_POST["lastName"];
        $userEmail = $_POST["email"];
        $selection = $_POST["hotelSelection"];
        $checkIn = $_POST["checkIn"];
        $checkOut = $_POST["checkOut"];
        
        /* empty array */
        $hotelArray = array();

        /* loop through the original array, and make the hotel name, the key of the array, to make matching the selection to the appropriate info accurate */
        foreach ($Hotels as $Hotel => $value) {
            $hotelArray[$value['name']] = array("rate" => $value["rate"],"image" => $value["image"], "desc" => $value["description"], "rating" => $value["rating"], "pool" => $value["pool"], "spa" => $value["spa"], "wifi" => $value["wifi"], "restaurant" => $value["restaurant"], "childFriendly" => $value["childFriendly"] );
        };

        $selectedHotel = $hotelArray["$selection"];

        $newBooking = BookingInformation::createBooking($userName, $userSurname, $userEmail, $selection, $selectedHotel["image"], $selectedHotel["rating"], $selectedHotel["desc"], $selectedHotel["pool"], $selectedHotel["wifi"], $selectedHotel["spa"], $selectedHotel["restaurant"], $selectedHotel["childFriendly"] ,$checkIn, $checkOut, $selectedHotel["rate"]);
        
        $selectedHotelObject = [];
        array_push($selectedHotelObject, $newBooking);
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/public/css/BookingDisplay.css">
</head>
<body>
    <main>
    <div class="display-info">
        <?php
         print_r($selectedHotelObject)
        ?>
    </div>
</main>
</body>
</html>

