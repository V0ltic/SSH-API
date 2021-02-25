<?php
    // Usage: https://server_ip/API.php?pass=yourpassword
   

    // Print out any errors that occurs

    error_reporting(E_ALL);




    // SSH Info

    $ip = "";

    $port = "22";

    $ssh_pass = "";

    $ssh_username = "root";




    // Encode special characters

    function EncodeString($string)
    {
        return htmlspecialchars($string, ENT_QUOTES, "UTF-8");
    }
 
    


    // Check if password has been submitted

    $pass = array("password");
 
    if (!isset($_GET["pass"]))
    {
        die("Please submit a password!");
    }
 


    // Variables
 
    $ssh = ""; // Your command goes here

    $password = EncodeString($_GET["pass"]); // Getting the password in the GET request
 
 
 

    // Check if given password is right
 
    if (!in_array($password, $pass)){
        die("Invalid Password!");
    }
 


 
    // Connect to the server
 
    $socket = fsockopen($ip, $port);
 
    ($socket ? null : die("Failed to connect!"));
 
    fwrite($socket, " \r\n");
   
    sleep(3);
   
    fwrite($socket, $ssh_username . "\r\n");
   
    sleep(3);
   
    fwrite($socket, $ssh_pass . "\r\n");
 
 


    // Send command
 
    sleep(9);
 
    fwrite($socket, $ssh);
 


    // Close connection
 
    fclose($socket);
 

    // Notify the command went through
 
    echo "Your command has been successfully sent to the server!";
 
   
?>