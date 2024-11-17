<?php
// Start the session to access session variables
session_start();

// Destroy all session variables
session_unset(); 

// Destroy the session
session_destroy(); 

// Redirect to the login page or home page
header("Location: ../home"); // Replace with your desired redirect location
exit();
?>
