<?php
    session_start();

    include ("/MAMP/htdocs/BlueBooking.com/src/classes/HotelBookingInfoClass.class.php");
    include ("/MAMP/htdocs/BlueBooking.com/src/classes/NewComparedHotelBookingInfoClass.class.php");

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

/* //Import PHPMailer classes into the global namespace
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
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.example.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'user@example.com';                     //SMTP username
    $mail->Password   = 'secret';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('from@example.com', 'Mailer');
    $mail->addAddress('joe@example.net', 'Joe User');     //Add a recipient
    $mail->addAddress('ellen@example.com');               //Name is optional
    $mail->addReplyTo('info@example.com', 'Information');
    $mail->addCC('cc@example.com');
    $mail->addBCC('bcc@example.com');

    //Attachments
    $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
} */
?>

<main>
    <?php
        print_r($SelectedHotel);
    ?>
</main>