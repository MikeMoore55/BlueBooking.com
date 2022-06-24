<?php

    require("/MAMP/htdocs/BlueBooking.com/src/classes/HotelClass.class.php"); 
    /* not in functions folder for various reasons */
    function initialize(){
    /* we create a populated array using the setup from the HotelClass.class.php */ 
        $hotelListArray = [
            /* Based on real hotels in South Africa */
                new Hotel("Alveston Manor Boutique Hotel & Spa","./src/public/images/alveston-mannor.jpg" ,1500, "4", "Cosy rooms with free Wi-Fi & TVs in a sophisticated hotel featuring a spa & a restaurant.", "yes", "yes", "yes", "yes", "yes"),
                new Hotel("12 Apostles Hotel & Spa","./src/public/images/12apostle-hotel.webp" , 7150, "4.6", "Upscale property offering ocean views, a spa & restaurants, as well as a cinema & outdoor pools.", "yes", "yes", "yes", "yes", "yes"),
                new Hotel("The Oyster Box Hotel","./src/public/images/oyster-box-hotel.webp" , 7039, "4.7", "Luxe hotel offering refined rooms & suites, plus breakfast, a spa & an oceanfront pool.", "yes", "yes", "yes", "yes", "yes"),
                new Hotel("Beverly Hills Hotel","./src/public/images/beverly-hotel.jpg" , 4966, "4.6", "Laid-back quarters with ocean views, plus a poolside spa, a cafe/bar and a fine-dining restaurant.", "yes", "yes", "yes", "yes", "yes"),
                new Hotel("Santé Wellness Retreat and Spa", "./src/public/images/sante-wellness-hotel.jpg", 3695, "4.5", "Refined suites & villas in a Spanish Colonial-style hotel, plus a spa, 2 pools & upscale dining.", "yes", "yes", "yes", "yes", "no"),
                new Hotel("Libra Lodge","./src/public/images/libra-lodge.jpg" , 758, "4.6", "Simply furnished rooms in a down-to-earth bed-and-breakfast featuring an outdoor pool & dining.", "yes", "yes", "no", "yes", "yes"),
        ];

        /* take the above array, convert to json file */
        $hotelList = json_encode($hotelListArray);
        file_put_contents("hotelList.json", $hotelList);
    };

    function hotelOptionsArray(){
        /* take the created json and make an array when this function is called */
        $hotelOptionsList = file_get_contents("hotelList.json");
        $hotelOptionsArray = json_decode($hotelOptionsList, TRUE); 
    
        return $hotelOptionsArray;
    }
    

?>