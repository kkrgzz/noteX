<?php
ob_start();
session_start();
include("../src/config/constants.php");

if(isset($_SESSION['userId']) && isset($_SESSION['username']) && isset($_SESSION['email'])){
    if(!empty($_SESSION['userId']) && !empty($_SESSION['username']) && !empty($_SESSION['email'])){
        include("notes.php");

        if(isset($_POST['logout'])){
            if($_POST['logout'] == "true"){
                header( "refresh:0.1; url=../login/" );
                session_destroy();
            }
        }
    }else {
        session_destroy();
        header( "refresh:4; url=../login/" );
        die(EXITTEXT); 
        
    }
}else {
    session_destroy();
    header( "refresh:4; url=../login/" );
    die(EXITTEXT);
    
}
 ob_end_flush();

?>