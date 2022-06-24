<?php
    function displayBookingInfo($selectedHotelObject){
            foreach ($selectedHotelObject as $index => $booking) {
                echo '
                        <fieldset>
                            <legend>Your Booking</legend>
                            <div class="user">
                                <div class="name">
                                    <h3>User: </h3>
                                    <p>' . $booking->fullName() . '</p>
                                </div>
                                <div class="email">
                                    <h3>Email: </h3>
                                    <p>' . $booking->email . '</p>
                                </div>
                            </div>
                            <div class="hotel-info">
                                <div class="hotel">
                                    <div class="hotel-name">
                                        <h3>Hotel: </h3>
                                        <p>' . $booking->hotel . '</p>
                                    </div> 
                                    <img class="hotel-img" src="' . $booking->image . '">
                                </div>    
                            </div>   
                            <div class="check-in-out">
                                <div class="in">
                                    <h3>Check-In: </h3>
                                    <p>' . $booking->checkIn . '</p>
                                </div>
                                <div class="out">
                                    <h3>Check-Out: </h3>
                                    <p>' . $booking->checkOut . '</p>
                                </div>
                                <div class="total-days">
                                    <h3>Days: </h3><p>' . $booking->calcDays() . '</p>
                                </div>        
                            </div>
                            <div class="costs">
                                <div class=amount>
                                    <h3 class="total">Total: </h3>
                                    <p>' . $booking->calcCosts() . '-00 ZAR</p>
                                </div>
                                <div class="hotel-rate">            
                                    <h3>Hotel Rate: </h3>
                                    <p>' . $booking->rate . '-00 ZAR/day</p>
                                </div>
                            </div>   
                            <div class="btns">
                                <form action="compare" method="POST" class="compare">
                                    <input type="submit" name="compare" value="Compare Booking" class="compare-btn">
                                </form>
                                <form action="confirm" method="POST" class="confirm">
                                <input type="submit" name="confirmBooking" value="Confirm Booking" class="confirm-btn">
                                </form>
                            </div>
                        </fieldset>
                    ';
            };
        }
            ?>