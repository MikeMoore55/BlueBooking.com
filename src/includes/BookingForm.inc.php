<?php

    function createBookingFormOption($Hotels)
    {
        foreach ($Hotels as $index => $HotelsArray) {
            echo '
                    <option>'.$HotelsArray["name"].'</option>
                ';
        };

    }

?>