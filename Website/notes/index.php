<?php
session_start();
include("../src/config/constants.php");

if(isset($_SESSION['userId']) && isset($_SESSION['username']) && isset($_SESSION['email'])){
    if(!empty($_SESSION['userId']) && !empty($_SESSION['username']) && !empty($_SESSION['email'])){
        include("notes.html");
    }else die(EXITTEXT);
}else die(EXITTEXT);

?>