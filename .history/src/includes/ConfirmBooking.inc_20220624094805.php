<?php
    session_start();

    include ("/MAMP/htdocs/BlueBooking.com/src/classes/HotelBookingInfoClass.class.php");
    include ("/MAMP/htdocs/BlueBooking.com/src/classes/NewComparedHotelBookingInfoClass.class.php");
    include ("/MAMP/htdocs/BlueBooking.com/src/functions/calcCost.func.php");
    include ("/MAMP/htdocs/BlueBooking.com/src/functions/calcDays.func.php");


    /* if "Book Alternative Hotel" is clicked then */
    if (isset($_POST["confirmNewBooking"])) {

        $newSelection = $_POST["newHotelSelection"];
        
        /* session variables */
        $BookedHotelArray = $_SESSION["BookedHotel"];
        $hotelOptionArray = $_SESSION["simpleHotelArray"];
       
        $newSelectedHotelArray = $hotelOptionArray["$newSelection"];

        $hotelArray = array();

        /* loop through old booking array to get booking info like user name, surname, email & dates */
        /* i do it this way to avoid "over using sessions" although the overall outcome will be the same */
        foreach ($BookedHotelArray as $Hotel => $value) {
            /* this means user doesn't have to re-enter this info again */
            $checkIn = $value["checkIn"];
            $checkOut = $value["checkOut"];
            $userName = $value["name"];
            $userSurname = $value["surname"];
            $userEmail = $value["email"];
        };

        /* Create a new booking based of the BookingInformation Class */
        $newBooking = BookingInformation::createBooking($userName, $userSurname, $userEmail, $newSelection, $newSelectedHotelArray["image"], $newSelectedHotelArray["rating"], $newSelectedHotelArray["desc"], $newSelectedHotelArray["pool"], $newSelectedHotelArray["wifi"], $newSelectedHotelArray["spa"], $newSelectedHotelArray["restaurant"], $newSelectedHotelArray["childFriendly"] ,$checkIn, $checkOut, $newSelectedHotelArray["rate"]);
        
        /* empty array for storing the new booking info */
        $newSelectedHotelObject = [];
        /* we push the new booking info to the array*/
        array_push($newSelectedHotelObject, $newBooking);

        /* we replace old booking info in Json file with the new Booking */
        $newSelectedHotelJson = json_encode($newSelectedHotelObject);
        file_put_contents("bookingInfo.json", $newSelectedHotelJson);

        $newSelectedBooking = file_get_contents("bookingInfo.json");
        $newSelectedBookingArray = json_decode($newSelectedBooking, TRUE);

        /* the alternative hotel is the selected hotel now */
        $SelectedHotel = $newSelectedBookingArray;
    }
  
    /* if the "confirm booking" btn was clicked */
    else{
        /* we get the original booking info from Json */
        $originalBooking = file_get_contents("bookingInfo.json");
        /* create array from original booking */
        $original = json_decode($originalBooking, TRUE); 
        /* original booking is now the selected hotel */
        $SelectedHotel = $original;
    };

  
    foreach ($SelectedHotel as $Hotel => $Booking) {
        /* how the email should appear */
        
        /* calcDays & calcCost = predefined functions*/ 
        $body .= 
        '
        <html>
        <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <title></title>
        </head>
        <body style="font-family:Arial, Helvetica, sans-serif;">
            <p>Greetings '.$Booking["name"] .' '.$Booking["surname"].'</p>
            <br>
            <p>Your Booking at <b>'.$Booking["hotel"].'</b> has been Booked.</p>
            <h4>Booking Info:</h4>
            <div style="display: grid; grid-template-columns: 50% 50%;">
                <p><b>Check In: </b>'.$Booking["checkIn"].'</p>
                <p><b>Check Out: </b>'.$Booking["checkOut"].'</p>
            </div>
            <p><b>Nightly Rate: </b>'.$Booking["rate"].' ZAR / day</p>
            <p><b>Total Stay: </b>'.$days = calcDays($$Booking["checkIn"], $Booking["checkOut"]).' day/s</p>
            <p><b>Total Amount: </b>'.calcCosts(calcDays($$Booking["checkIn"], $Booking["checkOut"]), $Booking["rate"]).' ZAR</p>
            <br>
            <p>Thank you for using <span style="font-size: 1.2em; font-weight: 700;">BlueBooking.com</span></p>
            <p style="font-size: 0.7em;">2022 BlueBooking.com</p>
        </body>
        </html>
        ';
        
        $email = $Booking["email"];        
    };

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

/* Load Composer's autoloader */
require 'vendor/autoload.php';

/* Create an instance; passing `true` enables exceptions */
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                     
    $mail->isSMTP();                                          
    $mail->Host       = 'smtp.mailtrap.io';            //mailtrap is a free smpt for email testing         
    $mail->SMTPAuth   = true;                          // MARKERS: create a free mailtrap.io account to see emails          
    $mail->Username   = '74850f4b25d8c4';              // MARKERS: use your credentials from mailtrap.io here so you become the "sender" to see emails     
    $mail->Password   = '03aaae6f7b04c4';              // MARKERS: use your credentials from mailtrap.io here so you become the "sender" to see emails                
    $mail->SMTPSecure = 'tls';                         // or ask me to send you a screen shot of your booking email once you have booked
    $mail->Port       = 2525;                                   

    $mail->setFrom('BlueBooking@bluebook.com', 'CONFIRMATION');
    $mail->addAddress($email);


    $mail->isHTML(true);                                 
    $mail->Subject = 'BlueBooking Booking Confirmation';
    $mail->Body    = $body;
    $mail->AltBody = strip_tags($body);               // email format, without html tags

    $mail->send();
    $confirmationMessage .= '<p>Booking Confirmation Email sent!</p>';
} catch (Exception $e) {
    $confirmationMessage .= '<p>Error! confirmation Email could not be sent '.$mail->ErrorInfo.' </p>';
} 

?>

<main>
    <div class="confirmation">
        <?php
            echo $confirmationMessage; ;
              
        ?>
    </div>
</main> 