<?php

session_start();

include ("/MAMP/htdocs/BlueBooking.com/src/includes/HotelInitialization.inc.php");
include ("/MAMP/htdocs/BlueBooking.com/src/includes/CreateHotelListing.inc.php");
include ("/MAMP/htdocs/BlueBooking.com/src/includes/BookingFormOption.inc.php");
/* "fill class", convert to json */
initialize();
/* take json, convert to array */
$Hotels = hotelOptionsArray();

?>
<!-- display info on cards -->
<main>
    

    <div class="hotel-cards">
        <?php
            createHotelList($Hotels);
        ?>
    <!-- form that appears to make a booking -->
    </div>

    <div id="form-div" class="form-div">

        

    </div>

</main>