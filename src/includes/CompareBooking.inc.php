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
    $alternativeOptions = array_slice($options, 0, 2);
?>

<main>
    <div class="compare-info">

        <fieldset class="original-booking">
            <legend>Your Booking</legend>
            <?php
                foreach ($BookingArray as $BookingInfo => $Booking) {
                    echo 
                        '
                            <h2>'.$Booking["hotel"].'</h2>
                            <img class="hotel-img" src="'.$Booking["image"].'"
                            <p><span>Rate :</span>'.$Booking["rate"].'</p>
                            <p>'.$Booking["rating"].'<img class="rating-img" src="./src/public/images/star.png"></p>
                            <h3>Amenities: </h3>
                            <ul>
                                <li>Pool: '.$Booking["pool"].'</li>
                                <li>Spa: '.$Booking["spa"].'</li>
                                <li>Restaurant: '.$Booking["restaurant"].'</li>
                                <li>Child-Friendly: '.$Booking["childFriendly"].'</li>
                            </ul>
                        ';
                }
            ?>
        </fieldset>
        <?php
            foreach ($alternativeOptions as $option => $value) {
                echo '
                    <div class="alternative-booking">
                        <h2>'.$option.'</h2>
                        <p>Rate:'.$value["rate"].'</p>
                        <p>'.$value["rating"].'<img class="rating-img" src="./src/public/images/star.png"></p>
                        <ul>
                            <li>Pool: '.$value["pool"].'</li>
                            <li>Spa: '.$value["spa"].'</li>
                            <li>Restaurant: '.$value["restaurant"].'</li>
                            <li>ChildFriendly: '.$value["childFriendly"].'</li>
                        </ul>
                    </div>
                    ';
            }
        ?>

    </div>
   
</main>