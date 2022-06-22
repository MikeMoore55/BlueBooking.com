<?php

    include ("/MAMP/htdocs/BlueBooking.com/src/includes/HotelInitialization.inc.php");
    include ("/MAMP/htdocs/BlueBooking.com/src/classes/HotelBookingInfoClass.class.php");

    /* "fill class", convert to json */
    initialize();
    /* take json, convert to array */
    $Hotels = hotelOptionsArray();

    if (isset($_POST["Book"])) {
        $username = $_POST["firstName"];
        $userSurname = $_POST["lastName"];
        $userEmail = $_POST["email"];
        $selection = $_POST["hotelSelection"];

        $info = 
                '<p>'.$username
            .'<br>'.$userSurname
            .'<br>'.$userEmail
            .'<br>'.$selection.'</p>'
            ;
    }

?>

<main>
    <div class="display-info">
        <?php
            echo $info
        ?>
    </div>
</main>