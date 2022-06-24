<?php
session_start();

include("/MAMP/htdocs/BlueBooking.com/src/includes/HotelInitialization.inc.php");
include("/MAMP/htdocs/BlueBooking.com/src/classes/HotelBookingInfoClass.class.php");

/* take json, convert to array */
$Hotels = hotelOptionsArray();

if (isset($_POST["Book"])) {
    /* data from booking form */
    $userName = $_POST["firstName"];
    $userSurname = $_POST["lastName"];
    $userEmail = $_POST["email"];
    $selection = $_POST["hotelSelection"];
    $checkIn = $_POST["checkIn"];
    $checkOut = $_POST["checkOut"];
    
    $_SESSION["selectedHotel"] = $selection;

   /* empty array */
    $hotelArray = array();

    /* loop through the original array, and make the hotel name, the key of the array, to make matching the selection to the appropriate info accurate */
    /* should have used ID's to make matching hotel selection to info easier (didn't think of that at first [ lol ]) */
    foreach ($Hotels as $Hotel => $value) {
        $hotelArray[$value['name']] = array("rate" => $value["rate"], "image" => $value["image"], "desc" => $value["description"], "rating" => $value["rating"], "pool" => $value["pool"], "spa" => $value["spa"], "wifi" => $value["wifi"], "restaurant" => $value["restaurant"], "childFriendly" => $value["childFriendly"]);
    };

    $_SESSION["simpleHotelArray"] = $hotelArray;
    /* taking the selection and creating a seperate array with its matching info */
    /* again could have used ids for matching purposes but its to late now (why did i not think of such a simple solution) */
    $selectedHotel = $hotelArray["$selection"];
    /* take selection info and populate class with it */
    $newBooking = BookingInformation::createBooking($userName, $userSurname, $userEmail, $selection, $selectedHotel["image"], $selectedHotel["rating"], $selectedHotel["desc"], $selectedHotel["pool"], $selectedHotel["wifi"], $selectedHotel["spa"], $selectedHotel["restaurant"], $selectedHotel["childFriendly"], $checkIn, $checkOut, $selectedHotel["rate"]);
    /* empty array for storing booking object */
    $selectedHotelObject = [];
    /* store the booking object i an array */
    array_push($selectedHotelObject, $newBooking);
    /* save the array to a json folder */
    $selectedHotelJson = json_encode($selectedHotelObject);
    file_put_contents("bookingInfo.json", $selectedHotelJson);
    
}

?>
    <main>

        <div class="display-info">

            <?php

            foreach ($selectedHotelObject as $index => $booking) {
                echo '
                        <fieldset>
                            <legend>Your Booking</legend>
                            <div class="user">
                                <div class="name">
                                    <h3>User: </h3>
                                    <p>' . $booking->fullName() . '</p>
                                </div>
                                <div class="email">
                                    <h3>Email: </h3>
                                    <p>' . $booking->email . '</p>
                                </div>
                            </div>
                            <div class="hotel-info">
                                <div class="hotel">
                                    <div class="hotel-name">
                                        <h3>Hotel: </h3>
                                        <p>' . $booking->hotel . '</p>
                                    </div> 
                                    <img class="hotel-img" src="' . $booking->image . '">
                                </div>    
                            </div>   
                            <div class="check-in-out">
                                <div class="in">
                                    <h3>Check-In: </h3>
                                    <p>' . $booking->checkIn . '</p>
                                </div>
                                <div class="out">
                                    <h3>Check-Out: </h3>
                                    <p>' . $booking->checkOut . '</p>
                                </div>
                                <div class="total-days">
                                    <h3>Days: </h3><p>' . $booking->calcDays() . '</p>
                                </div>        
                            </div>
                            <div class="costs">
                                <div class=amount>
                                    <h3 class="total">Total: </h3>
                                    <p>' . $booking->calcCosts() . '-00 ZAR</p>
                                </div>
                                <div class="hotel-rate">            
                                    <h3>Hotel Rate: </h3>
                                    <p>' . $booking->rate . '-00 ZAR/day</p>
                                </div>
                            </div>   
                            <div class="btns">
                                <form action="compare" method="POST" class="compare">
                                    <input type="submit" name="compare" value="Compare Booking" class="compare-btn">
                                </form>
                                <form action="confirm" method="POST" class="confirm">
                                <input type="submit" name="confirmBooking" value="Confirm Booking" class="confirm-btn">
                                </form>
                            </div>
                        </fieldset>
                    ';
            };
            
            ?>

        </div>

    </main>