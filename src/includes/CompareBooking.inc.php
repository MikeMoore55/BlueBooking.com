<?php
    session_start();

    include ("/MAMP/htdocs/BlueBooking.com/src/includes/HotelInitialization.inc.php");
    include ("/MAMP/htdocs/BlueBooking.com/src/classes/HotelBookingInfoClass.class.php");
    include ("/MAMP/htdocs/BlueBooking.com/src/functions/calcCost.func.php");
    include ("/MAMP/htdocs/BlueBooking.com/src/functions/calcDays.func.php");
    include ("/MAMP/htdocs/BlueBooking.com/src/includes/BookingForm.inc.php");

    
    /* take json, convert to array */
    $Hotels = hotelOptionsArray();

    $Booking = file_get_contents("bookingInfo.json");
    $BookingArray = json_decode($Booking, TRUE);

    /* loop through the booking Info to get total days, to use in comparison */
    foreach ($BookingArray as $key => $i) {
        $days = calcDays($i["checkIn"], $i["checkOut"]);
    }
    
    
    $hotelOptionArray = $_SESSION["simpleHotelArray"];
    $selectedHotelName = $_SESSION["selectedHotel"];

    unset($hotelOptionArray["$selectedHotelName"]);

    $options = $hotelOptionArray;
    $alternativeOptions = array_slice($options, 0, 2);
?>

<script src="./src/public/js/form.js" defer></script>


<main>
    <div class="compare-info">

        <fieldset class="original-booking">
            <legend>Your Booking</legend>
            <?php
                foreach ($BookingArray as $BookingInfo => $Booking) {

                    $total = calcCosts($days, $Booking["rate"]);

                    echo 
                        '
                            <h2>'.$Booking["hotel"].'</h2>
                            <img class="hotel-img" src="'.$Booking["image"].'">
                            <p>Rate : '.$Booking["rate"].'ZAR / night</p>
                            <p>'.$Booking["rating"].'<img class="rating-img" src="./src/public/images/star.png"></p>
                            <h3>Amenities: </h3>
                            <ol>
                                <li>Pool: '.$Booking["pool"].'</li>
                                <li>Spa: '.$Booking["spa"].'</li>
                                <li>Restaurant: '.$Booking["restaurant"].'</li>                            </ol>
                            <p>Child-Friendly: '.$Booking["childFriendly"].'</p>
                            <p class="total">Total: '.$total.'-00 ZAR</p>
                            <form action="confirm" method="POST" class="confirm">
                                <input type="submit" name="confirm" value="Confirm Booking" class="confirm-btn">
                            </form>
                        ';
                }
            ?>
        </fieldset>

        <?php
            foreach ($alternativeOptions as $option => $value) {
                $selectOption .= '<option>'.$option.'</option>';
                echo '
                    <fieldset class="alternative-booking">
                    <legend>Alternative Option</legend>
                        <h2>'.$option.'</h2>
                        <img class="hotel-img" src="'.$value["image"].'">
                        <p>Rate:'.$value["rate"].'ZAR / night</p>
                        <p>'.$value["rating"].'<img class="rating-img" src="./src/public/images/star.png"></p>
                        <h3>Amenities: </h3>
                        <ol>
                            <li>Pool: '.$value["pool"].'</li>
                            <li>Spa: '.$value["spa"].'</li>
                            <li>Restaurant: '.$value["restaurant"].'</li>
                        </ol>
                        <p>ChildFriendly: '.$value["childFriendly"].'</p>
                        <p class="total">Total: '.$total = calcCosts($days, $value["rate"]).'-00 ZAR</p>
                        <button onclick="newBook()">
                            Book Alternative Hotel
                        </button> 
                    </fieldset>
                    ';
            }
        ?>

    </div>



    <div id="new-book-div" class="new-book-div">
        <form id="new-booking-form" class="new-booking-form" method="POST" action="confirm">
            <span onclick="hideNewBook()">X</span>
            <h4>Book an Alternative Hotel</h4>
            <label for="hotelSelection">Choose the Alternative Hotel:</label>
                <br>
            <select name="hotelSelection">
                <?php
                    echo $selectOption;
                ?>
            </select>
            <input id="book-btn" type="submit" class="book-btn" name="newConfirm" value="confirm">

        </div>
    </div>
   
</main>