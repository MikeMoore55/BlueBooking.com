<?php
/* this class is the "setup" of each hotel */

    class Hotel implements JsonSerializable{
        public $name;
        public $image;
        public $rate;
        public $rating;
        public $description;
        public $pool; 
        public $wifi;
        public $spa;
        public $restaurant;
        public $childFriendly;

        public function __construct($name, $image, $rate, $rating, $description, $pool, $wifi, $spa, $restaurant, $childFriendly,)
        {
            $this->name = $name; 
            $this->image = $image;
            $this->rate = $rate;
            $this->rating = $rating;
            $this->description = $description;
            $this->pool = $pool;
            $this->wifi = $wifi;
            $this->spa = $spa;
            $this->restaurant = $restaurant;
            $this->childFriendly = $childFriendly;
        }

        public function jsonSerialize() {
    
            $assocArray = [
                "name" => $this->name,
                "image" => $this-> image,
                "rate" => $this->rate,
                "rating" => $this->rating,
                "description" => $this->description,
                "pool" => $this->pool,
                "wifi" => $this->wifi,
                "spa" => $this->spa,
                "restaurant" => $this->restaurant,
                "childFriendly" => $this->childFriendly,
            ];
    
            return $assocArray;
        }

        /* ---- Getters & Setters ---- */
       public function getName(){
            return $this->name;
        }

        public function setName($name){
            $this->name = $name;

            return $this;
        }  
        
        public function getImage(){
            return $this->image;
        }

        public function setImage($image){
            $this->image = $image;

            return $this;
        }

        public function getRate(){
            return $this->rate;
        }

        public function setRate($rate){
            $this->rate = $rate;

            return $this;
        }

        public function getRating(){
            return $this->rating;
        }

        public function setRating($rating){
            $this->rating = $rating;

            return $this;
        }

        public function getDescription(){
            return $this->description;
        }

        public function setDescription($description){
            $this->description = $description;

            return $this;
        }
  
        public function getPool(){
            return $this->pool;
        }

        public function setPool($pool){
            $this->pool = $pool;

            return $this;
        }
  
        public function getWifi(){
            return $this->wifi;
        }

        public function setWifi($wifi){
            $this->wifi = $wifi;

            return $this;
        }
   
        public function getSpa(){
            return $this->spa;
        }

        public function setSpa($spa){
            $this->spa = $spa;

            return $this;
        }

        public function getRestaurant(){
            return $this->restaurant;
        }

        public function setRestaurant($restaurant){
            $this->restaurant = $restaurant;

            return $this;
        }

        public function getChildFriendly(){
            return $this->childFriendly;
        }

        public function setChildFriendly($childFriendly){
            $this->childFriendly = $childFriendly;

            return $this;
        }
    };

?>