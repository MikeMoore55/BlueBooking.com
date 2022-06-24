<?php
/*  creates the options for select based of the hotel options array */

    function createBookingFormOption($Hotels)
    {
        foreach ($Hotels as $index => $HotelsArray) {
            echo '
                    <option>'.$HotelsArray["name"].'</option>
                ';
        };

    };

?>