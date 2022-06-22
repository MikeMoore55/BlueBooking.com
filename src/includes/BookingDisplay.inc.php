<?php
    session_start();

    include ("/MAMP/htdocs/BlueBooking.com/src/includes/HotelInitialization.inc.php");
    include ("/MAMP/htdocs/BlueBooking.com/src/classes/HotelBookingInfoClass.class.php");

    /* take json, convert to array */
    $Hotels = hotelOptionsArray();

    if (isset($_POST["Book"])) {
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
        foreach ($Hotels as $Hotel => $value) {
            $hotelArray[$value['name']] = array("rate" => $value["rate"],"image" => $value["image"], "desc" => $value["description"], "rating" => $value["rating"], "pool" => $value["pool"], "spa" => $value["spa"], "wifi" => $value["wifi"], "restaurant" => $value["restaurant"], "childFriendly" => $value["childFriendly"] );
        };

        $_SESSION["simpleHotelArray"] = $hotelArray;

        $selectedHotel = $hotelArray["$selection"];

        $newBooking = BookingInformation::createBooking($userName, $userSurname, $userEmail, $selection, $selectedHotel["image"], $selectedHotel["rating"], $selectedHotel["desc"], $selectedHotel["pool"], $selectedHotel["wifi"], $selectedHotel["spa"], $selectedHotel["restaurant"], $selectedHotel["childFriendly"] ,$checkIn, $checkOut, $selectedHotel["rate"]);
        
        $selectedHotelObject = [];
        array_push($selectedHotelObject, $newBooking);

        $selectedHotelJson = json_encode($selectedHotelObject);
        file_put_contents("bookingInfo.json", $selectedHotelJson);
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
                foreach ($selectedHotelObject as $index => $booking) {
                    echo'
                            <fieldset>
                                <legend>Your Booking</legend>
                                <div class="user">
                                    <div class="name">
                                        <h3>User: </h3>
                                        <p>'.$booking ->fullName().'</p>
                                    </div>
                                    <div class="email">
                                        <h3>Email: </h3>
                                        <p>'.$booking-> email.'</p>
                                    </div>
                                </div>
                                <div class="hotel-info">
                                    <div class="hotel">
                                        <div class="hotel-name">
                                            <h3>Hotel: </h3>
                                            <p>'.$booking->hotel.'</p>
                                        </div> 
                                        <img class="hotel-img" src="'.$booking->image.'">
                                        <div class="hotel-rate">            
                                            <h3>Hotel Rate: </h3>
                                            <p>R'.$booking->rate.'-00/day</p>
                                        </div> 
                                    </div>    
                                    
                                </div>   
                                <div class="check-in-out">
                                    <div class="in">
                                        <h3>Check-In: </h3>
                                        <p>'.$booking->checkIn.'</p>
                                    </div>
                                    <div class="out">
                                        <h3>Check-Out: </h3>
                                        <p>'.$booking->checkOut.'</p>
                                    </div>
                                    <div class="total-days">
                                        <h3>Days: </h3><p>'.$booking->calcDays().'</p>
                                    </div>        
                                </div>
                                <h3 class="total">Total: </h3><p>R'.$booking->calcCosts().'-00</p>  
                                <div class="btns">
                                    <form action="compare" method="POST" class="compare">
                                        <input type="submit" name="compare" value="Compare Booking" class="compare-btn">
                                    </form>
                                    <form action="confirm" method="POST" class="confirm">
                                        <input type="submit" name="confirm" value="Confirm Booking" class="confirm-btn">
                                    </form>
                                </div>
                                
                            </fieldset>
                            ';
                }; 
        ?>
    </div>
</main>
</body>
</html>

