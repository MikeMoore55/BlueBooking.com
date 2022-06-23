<?php
    session_start();

    include ("/MAMP/htdocs/BlueBooking.com/src/classes/HotelBookingInfoClass.class.php");
    include ("/MAMP/htdocs/BlueBooking.com/src/classes/NewComparedHotelBookingInfoClass.class.php");
    include ("/MAMP/htdocs/BlueBooking.com/src/functions/calcCost.func.php");
    include ("/MAMP/htdocs/BlueBooking.com/src/functions/calcDays.func.php");

    $hotelOptionArray = $_SESSION["simpleHotelArray"];
    $BookedHotelArray = $_SESSION["BookedHotel"];

    if (isset($_POST["confirmNewBooking"])) {
        $newSelection = $_POST["newHotelSelection"];
        $newSelectedHotelArray = $hotelOptionArray["$newSelection"];
        

        $hotelArray = array();

        foreach ($BookedHotelArray as $Hotel => $value) {
            $checkIn = $value["checkIn"];
            $checkOut = $value["checkOut"];
            $userName = $value["name"];
            $userSurname = $value["surname"];
            $userEmail = $value["email"];
        };

        $newBooking = BookingInformation::createBooking($userName, $userSurname, $userEmail, $newSelection, $newSelectedHotelArray["image"], $newSelectedHotelArray["rating"], $newSelectedHotelArray["desc"], $newSelectedHotelArray["pool"], $newSelectedHotelArray["wifi"], $newSelectedHotelArray["spa"], $newSelectedHotelArray["restaurant"], $newSelectedHotelArray["childFriendly"] ,$checkIn, $checkOut, $newSelectedHotelArray["rate"]);
        
        $newSelectedHotelObject = [];
        array_push($newSelectedHotelObject, $newBooking);

        $newSelectedHotelJson = json_encode($newSelectedHotelObject);
        file_put_contents("bookingInfo.json", $newSelectedHotelJson);

        $newSelectedBooking = file_get_contents("bookingInfo.json");
        $newSelectedBookingArray = json_decode($newSelectedBooking, TRUE);

        $SelectedHotel = $newSelectedBookingArray;
    }

    else if (isset($_POST["confirmBooking"])) {

        $originalBooking = file_get_contents("bookingInfo.json");
        $original = json_decode($originalBooking, TRUE); 

        $SelectedHotel = $original;
    };


    foreach ($SelectedHotel as $Hotel => $Booking) {

        $body .= '  <p>Greetings '.$Booking["name"] .' '.$Booking["surname"].'</p>
                    <p>Your Booking at <b>'.$Booking["hotel"].'/<b> has been Booked.</p>
                    <p>Check In: '.$Booking["checkIn"].'</p>
                    <p>Check Out: '.$Booking["checkOut"].'</p>
                    <p>Your Total: '.$totalCosts.' ZAR</p>
                    <br>
                    <br>
                    <p>Thank you for using BlueBooking.com</p>
                    ';
        $email = $Booking["email"];
        $hotelCheckIn = $Booking["checkIn"];
        $hotelCheckOut = $Booking["checkOut"];
        $hotelRate = $Booking["rate"];

        $totalDays = calcDays($hotelCheckIn, $hotelCheckOut);
        $totalCosts = calcCosts($totalDays, $hotelRate);
    };
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 1;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.mailtrap.io';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = '74850f4b25d8c4';                     //SMTP username
    $mail->Password   = '03aaae6f7b04c4';                               //SMTP password
    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
    $mail->Port       = 2525;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('michaelwillemmoore@gmail.com', 'Mailer');
    $mail->addAddress($email);

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'BlueBooking Booking Confirmation';
    $mail->Body    = $body;
    $mail->AltBody = strip_tags($body);

    $mail->send();
    $confirmationMessage .= '<p>Booking Confirmation Email sent!</p>';
} catch (Exception $e) {
    $confirmationMessage .= '<p>Error! confirmation Email could not be sent '.$mail->ErrorInfo.' </p>';
} 

?>

<main>
    <div class="confirmation">
        <?php
            echo $confirmationMessage;
        ?>
    </div>
    
</main>