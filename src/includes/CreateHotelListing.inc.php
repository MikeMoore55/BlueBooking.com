<?php
function createHotelList($Hotels)
{
    foreach ($Hotels as $index => $HotelsArray) {
        $index = $index + 1;
        echo ' 
            <div class="card">
                <img src="'.$HotelsArray["image"].'" class="hotel-img">
                <h3>'.$HotelsArray["name"].'</h3>
                <p>R' . $HotelsArray["rate"] . ' ZAR night</p>
            </div> 
            ';
    }
}
?>