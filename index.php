<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BlueBooking</title>
    <link rel="icon" href="/BlueBooking.com/src/public/images/blue-book.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Chakra+Petch:wght@700&family=Fascinate&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kdam+Thmor+Pro&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="./src/public/css/main.css">
</head>
<body>
    <?php
        /* ----- Header ----- */
        include ("/MAMP/htdocs/BlueBooking.com/src/includes/Header.inc.php");

      /*   $request = $_SERVER['REQUEST_URI'];
    
        $basepath = "php-oop-booking-app/";
        $request = str_replace($basepath, "", $request);
        echo $request;
    
        switch ($request) { 
            case '/home':
            require __DIR__ . '/src/include/Home.inc.php';
            break;
            case '/':
            require __DIR__ . '/src/include/Home.inc.php';
            break;
            case '':
            require __DIR__ . '/src/include/Home.inc.php';
            break;
            case '/bookings':
            require __DIR__ . '/src/include/Hooking.inc.php';
            break;
            case '/book':
            require __DIR__ . '/src/include/Booking.inc.php';
            break;
        
        default:
            http_response_code(404);
            echo "page not found";
            break;
        } */
    ?>
</body>
</html>
<?php
    
?>