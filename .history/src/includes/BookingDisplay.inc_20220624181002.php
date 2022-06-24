<?php
session_start();

include("/MAMP/htdocs/BlueBooking.com/src/includes/HotelInitialization.inc.php");
include("/MAMP/htdocs/BlueBooking.com/src/classes/HotelBookingInfoClass.class.php");
include("/MAMP/htdocs/BlueBooking.com/src/classes/BookingInfoDisplay.inc.php");


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

            <?php BookingInfoDisplay($selectedHotelObject); ?>

        </div>

    </main>