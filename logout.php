<?php 
    session_start();
    session_destroy();
    header("location: Booking.php");
    exit(0);

?>