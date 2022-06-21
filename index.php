<?php
    $request = $_SERVER['REQUEST_URI'];
  
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
    }
?>