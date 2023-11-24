<?php 

function connection (){
    $servername = 'localhost';
    $username  = 'root';
    $password = ''; //mamp - root
    $database_name = 'minimart_catalog';

    // mysqli (class) - special function to communicate to your database
                //  - translator
                // mysqli has pre defined codes inside .. library
    $conn = new mysqli($servername,$username,$password,$database_name);

    // validate if connection is okay
    if($conn->connect_error){
        die("ERROR: ".$conn->connect_error);
    }else{
        return $conn;
    }
    
} 
