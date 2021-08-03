<?php
session_start();
$db_location = "../db/db.php";
include($db_location);
$conn = new dbProcess();
$userTableName = "users";

/* 
    Login Operation
    Android app will send a POST request which called 'login'
*/
if(isset($_POST['login'])){
    if($_POST['login'] == "true"){
        if(isset($_POST['username']) && isset($_POST['password'])){

            $username = $_POST['username'];
            $password = $_POST['password'];
          
            if($conn->logIn($userTableName, $username, $password)){
          
              $db = $conn->connDB();
              $query = $db->query("SELECT * FROM $userTableName WHERE username = '$username' ", PDO::FETCH_ASSOC);
              $user = array();
          
              foreach ($query as $row) {
                $temp = array();
                $temp['loginStatus']  = "success";
                $temp['userId']       = $row['userId'];
                $temp['username']     = $row['username'];
                $temp['mail']         = $row['email'];
                array_push($user, $temp);
              }
          
              echo json_encode($user);
          
            }else{
              $user = array();
              $temp = array();
              $temp['loginStatus'] = "failed";
              $temp['userId'] = null;
              $temp['username'] = null;
              $temp['mail'] = null;
              array_push($user, $temp);
              echo json_encode($user);
            }
          
          }
    }else echo "failed";
}

/*
  Login Operation From Browser
*/
if(isset($_POST['loginWEB'])){
    if($_POST['loginWEB'] == "loginFromWeb"){
      if(isset($_POST['username']) && isset($_POST['password'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        if($conn->logIn($userTableName, $username, $password)){
          $db = $conn->connDB();
          $query = $db->query("SELECT * FROM $userTableName WHERE username = '$username' ", PDO::FETCH_ASSOC);
          foreach ($query as $row) {
            $_SESSION['userId'] = $row['userId'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['email'] = $row['email'];
            
            header( "refresh:0.1; url=../../notes/" );
          }

        }else echo "<br>WEB login failed.";
      }
    }
}



/* 
    Register Operation
    Android app will send a POST request which called 'register'
*/
if(isset($_POST['register'])){
    if($_POST['register'] == "true"){
        if(isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password'])){
            $username = $_POST['username'];
            $password = $_POST['password'];
            $mail = $_POST['email'];
          
            if($conn->signUp($userTableName, $username, $password, $mail)){
              echo "success";
            }else echo "failed";
          
          }
    }else echo "failed";
}
?>