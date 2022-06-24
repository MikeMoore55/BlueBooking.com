<?php

/* this takes the users booking infomation, and saves it to a json folder, for future use  */
    class BookingInformation{

         /* seems alot, but i wanted to originally, list the following out in the email, but don,t have enough time */

        public $name;
        public $surname;
        public $email;
        public $hotel;
        public $image;
        public $rating;
        public $description;
        public $pool; 
        public $wifi;
        public $spa;
        public $restaurant;
        public $childFriendly;
        public $checkIn;
        public $checkOut;
        public $rate;
       

        public function __construct($userName, $userSurname, $userEmail, $hotelName, $hotelImage, $hotelRating, $hotelDescription, $hotelPool,$hotelWifi, $hotelSpa, $hotelRestaurant, $hotelChildFriendly, $checkInDate, $checkOutDate, $hotelRate)
        {
            $this->name = $userName;
            $this->surname = $userSurname;
            $this->email = $userEmail; 
            $this->hotel = $hotelName;
            $this->image = $hotelImage;
            $this->rating = $hotelRating;
            $this->description = $hotelDescription;
            $this->pool = $hotelPool;
            $this->wifi = $hotelWifi;
            $this->spa = $hotelSpa;
            $this->restaurant = $hotelRestaurant;
            $this->childFriendly = $hotelChildFriendly;
            $this->checkIn = $checkInDate;
            $this->checkOut = $checkOutDate;
            $this->rate = $hotelRate;     
        }

    
    /* methods */
        public function calcDays(){
            $dayDifference = date_diff(date_create($this->checkIn), date_create($this->checkOut));
            $amountOfDays = $dayDifference->format('%a');
    
            return $amountOfDays;
        }
        
        public function calcCosts(){
            $days = $this->calcDays();

            $totalCosts =  $days * $this->rate;
            
            return $totalCosts;
        }
    
        public function fullName(){
            $fullName = $this->name." ".$this->surname;
    
            return $fullName;
        }
            
        public static function createBooking($userName, $userSurname, $userEmail, $hotelName, $hotelImage, $hotelRating, $hotelDescription, $hotelPool,$hotelWifi, $hotelSpa, $hotelRestaurant, $hotelChildFriendly, $checkInDate, $checkOutDate, $hotelRate){
            if ($checkInDate >= $checkOutDate) {
                echo '<script>alert("Your Stay cannot be less than 1 day, please go back and correct you booking")</script>';
    
            }
            elseif($userName == null && $userSurname == null){
                echo '<script>alert("Why did you leave your name or surname blank, please go back and correct you booking")</script>';
            }
            else {
    
                $newBooking = new BookingInformation($userName, $userSurname, $userEmail, $hotelName, $hotelImage, $hotelRating, $hotelDescription, $hotelPool,$hotelWifi, $hotelSpa, $hotelRestaurant, $hotelChildFriendly, $checkInDate, $checkOutDate, $hotelRate);

                return $newBooking; 
               
            }
        }

    }
?>