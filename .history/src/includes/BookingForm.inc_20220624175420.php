<?php
/*  creates the options for select */

    function createBookingFormOption($Hotels)
    {
        foreach ($Hotels as $index => $HotelsArray) {
            echo '
                    <option>'.$HotelsArray["name"].'</option>
                ';
        };

    };

?>