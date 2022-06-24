<?php
    session_start();

    include ("/MAMP/htdocs/BlueBooking.com/src/includes/HotelInitialization.inc.php");
    include ("/MAMP/htdocs/BlueBooking.com/src/classes/HotelBookingInfoClass.class.php");
    include ("/MAMP/htdocs/BlueBooking.com/src/functions/calcCost.func.php");
    include ("/MAMP/htdocs/BlueBooking.com/src/functions/calcDays.func.php");
    include ("/MAMP/htdocs/BlueBooking.com/src/includes/BookingForm.inc.php");

    /* session variables */
    $hotelOptionArray = $_SESSION["simpleHotelArray"];
    $selectedHotelName = $_SESSION["selectedHotel"];

    /* initial array with all hotels in */
    $Hotels = hotelOptionsArray();

    /* take json, convert to array */
    $Booking = file_get_contents("bookingInfo.json");
    $BookingArray = json_decode($Booking, TRUE);
    /* create new session variable */
    $_SESSION["BookedHotel"] = $BookingArray;
    /* loop through the booking Info to get total days, to use in comparison */
    foreach ($BookingArray as $key => $i) {
        $days = calcDays($i["checkIn"], $i["checkOut"]);
    }
    
    /* "remove" selected hotel from hotel array to get comparative options */
    unset($hotelOptionArray["$selectedHotelName"]);

    $options = $hotelOptionArray;
    /* only have to options appear */
    $alternativeOptions = array_slice($options, 0, 2);
    /* future update - filter through and get options in similar locations/price range/rating (should have done it but i did not have enough time) */
?>

<main>
    <div class="compare-info">
        <!-- original booking display -->
        <fieldset class="original-booking">
            <legend>Your Booking</legend>
            <?php
                foreach ($BookingArray as $BookingInfo => $Booking) {

                    $total = calcCosts($days, $Booking["rate"]);

                    echo 
                        '
                            <h2>'.$Booking["hotel"].'</h2>
                            <img class="hotel-img" src="'.$Booking["image"].'">
                            <p>Rate : '.$Booking["rate"].'-00 ZAR / day</p>
                            <p>'.$Booking["rating"].'<img class="rating-img" src="./src/public/images/star.png"></p>
                            <h3>Amenities: </h3>
                            <ol>
                                <li>Pool: '.$Booking["pool"].'</li>
                                <li>Spa: '.$Booking["spa"].'</li>
                                <li>Restaurant: '.$Booking["restaurant"].'</li>
                            </ol>
                            <p>Child-Friendly: '.$Booking["childFriendly"].'</p>
                            <p class="total">Total: '.$total.'-00 ZAR</p>
                            <form action="confirm" method="POST" >
                                <input class="confirm-original" type="submit" name="confirm" value="Confirm Booking" class="confirm-btn">
                            </form>
                        ';
                }
            ?>
        </fieldset>

        <?php
            /* 2 alternatives display */
            /* can be made 3+ if wanted, i prefer 2 */
            foreach ($alternativeOptions as $option => $value) {
                $selectOption .= '<option>'.$option.'</option>';
                echo '
                    <fieldset class="alternative-booking">
                    <legend>Alternative Option</legend>
                        <h2>'.$option.'</h2>
                        <img class="hotel-img" src="'.$value["image"].'">
                        <p>Rate:'.$value["rate"].'-00 ZAR / night</p>
                        <p>'.$value["rating"].'<img class="rating-img" src="./src/public/images/star.png"></p>
                        <h3>Amenities: </h3>
                        <ol>
                            <li>Pool: '.$value["pool"].'</li>
                            <li>Spa: '.$value["spa"].'</li>
                            <li>Restaurant: '.$value["restaurant"].'</li>
                        </ol>
                        <p>Child-Friendly: '.$value["childFriendly"].'</p>
                        <p class="total">Total: '.$total = calcCosts($days, $value["rate"]).'-00 ZAR</p>
                        <button class="confirm-alternative" onclick="newBook()">
                            Book Alternative Hotel
                        </button> 
                    </fieldset>
                    ';
            };
        ?>
    </div>

    <!-- form that appears to book either one of the alternatives -->
    <div id="new-book-div" class="new-book-div">
        <form action="confirmNew" method="POST" >
            <span onclick="hideNewBook()">X</span>
            <h4>Book an Alternative Hotel</h4>
            <label for="newHotelSelection">Choose the Alternative Hotel:</label>
                <br>
            <select name="newHotelSelection">
                <?php
                    echo $selectOption;
                ?>
            </select>
            <input type="submit" class="book-btn" name="confirmNewBooking" value="confirm">
        </div>
    </div>
   
</main>