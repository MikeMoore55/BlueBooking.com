<?php

include ("/MAMP/htdocs/BlueBooking.com/src/includes/HotelInitialization.inc.php");
include ("/MAMP/htdocs/BlueBooking.com/src/includes/CreateHotelListing.inc.php");

initialize();
$Hotels = hotelOptionsArray();

?>

<main>
    <div class="hotel-cards">
        <?php
            createHotelList($Hotels);
        ?>
    </div>
</main>