<?php

include ("/MAMP/htdocs/BlueBooking.com/src/includes/HotelInitialization.inc.php");
include ("/MAMP/htdocs/BlueBooking.com/src/includes/CreateHotelListing.inc.php");
include ("/MAMP/htdocs/BlueBooking.com/src/includes/BookingForm.inc.php");
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
    <div id="form-div" class="form-div">
        <form id="form" method="GET" action="">
            <h2>Make Your Booking</h2>
            <div class="user">
                <div class="name">
                    <label for="firstName">Name:</label>
                    <input type="text" class="name-input" name="firstName"> 
                </div>
                <div class="surname">
                    <label for="lastName">Surname:</label>
                    <input type="text" class="surname-input" name="lastName"> 
                </div>
            </div>
            <div class="email">
                    <label for="email">E-mail:</label>
                    <input type="email" class="email-input" name="email">
            </div>
            <div class="hotel-selection">
                <label for="hotelSelection">Where would you like to stay:</label>
                <select name="hotelSelection">
                    <?php
                        createBookingFormOption($Hotels)
                    ?>
                </select>
            </div>
            <div class="date">
            <div class="check-in">
                <label for="checkIn">Check-In:</label>
                    <input type="date" name="checkIn" class="checkIn-input">
                </div>
                <div class="check-out">
                    <label for="checkOut">Check-Out:</label>
                    <input type="date" name="checkOut" class="checkOut-input">
                </div>
            </div>
            <input class="book-btn" type="submit" name="Book" value="Make Booking">
        </form> 
    </div>
</main>