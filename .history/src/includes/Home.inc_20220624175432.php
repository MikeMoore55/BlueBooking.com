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

        <form id="form" class="booking-form" method="POST" action="booking">

            <span onclick="disAppear()">X</span>

            <h2>Make Your Booking</h2>

            <div class="user">
                <div class="name">
                    <label for="firstName">Name:</label><?php echo $nameErr ?>
                    <br>
                    <input type="text" class="name-input" name="firstName" require> 
                </div>

                <div class="surname">
                    <label for="lastName">Surname:</label>
                    <br>
                    <input type="text" class="surname-input" name="lastName" require> 
                </div>
            </div>
            
            <div class="email">
                    <label for="email">E-mail:</label>
                    <br>
                    <input type="email" class="email-input" name="email" require>
            </div>

            <div class="hotel-selection">
                <label for="hotelSelection">Where would you like to stay:</label>
                <br>
                <select name="hotelSelection">
                    <?php
                        createBookingFormOption($Hotels)    // future update, make selection appear as the hotel that is clicked
                    ?>
                </select>
            </div>

            <div class="date">
                <!-- check in check out dates are selected with calender -->
                <div class="check-in">

                    <label for="checkIn">Check-In:</label>
                    <br>
                    <input id="checkIn-input" type="date" name="checkIn" class="checkIn-input" require>

                </div>

                <div class="check-out">

                    <label for="checkOut">Check-Out:</label>
                    <br>
                    <input checkIn-input type="date" name="checkOut" class="checkOut-input" require>

                </div>
            </div>

            <input class="book-btn" type="submit" name="Book" value="Make Booking">

        </form> 

    </div>

</main>