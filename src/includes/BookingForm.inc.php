<?php

    function createBookingFormOption($Hotels)
    {
        foreach ($Hotels as $index => $HotelsArray) {
            $index = $index + 1;
            echo '
                    <option>'.$HotelsArray["name"].'</option>
                ';
        };

    }

?>