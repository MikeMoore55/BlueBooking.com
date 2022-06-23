<?php
/* this creates the cards which info is displayed on */
function createHotelList($Hotels)
{
    foreach ($Hotels as $index => $HotelsArray) {
        $index = $index + 1;
        echo ' 
            <div class="card">
                <img src="'.$HotelsArray["image"].'" class="hotel-img">
                <div class="info">
                    <h3>'.$HotelsArray["name"].'</h3>
                    <p class="rating">'.$HotelsArray["rating"].' <img class="rating-img" src="./src/public/images/star.png"</p>
                    <p class="desc">'.$HotelsArray["description"].'</p>
                    <p class="rate">'.$HotelsArray["rate"].'-00 ZAR / day</p>
                    <button id="booking-btn" class="booking-btn" onclick="appear()">
                        Book
                    </button>
                </div>
            </div> 
            ';
    }
}
?>