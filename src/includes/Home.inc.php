<?php

include ("/MAMP/htdocs/BlueBooking.com/src/includes/HotelInitialization.inc.php");
include ("/MAMP/htdocs/BlueBooking.com/src/includes/CreateHotelListing.inc.php");
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
    </div>
</main>