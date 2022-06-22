<?php
    class BookingInformation{

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
                echo "
                <script>
                    alert('Error, your stay at $hotelName must be longer than 1 night');
                </script>"
                ;
    
            } else {
    
                $newBooking = new BookingInformation($userName, $userSurname, $userEmail, $hotelName, $hotelImage, $hotelRating, $hotelDescription, $hotelPool,$hotelWifi, $hotelSpa, $hotelRestaurant, $hotelChildFriendly, $checkInDate, $checkOutDate, $hotelRate);

                return $newBooking; 
               
            }
        }

    }
?>