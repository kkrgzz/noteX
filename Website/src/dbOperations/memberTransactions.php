<?php
$db_location = "../../db.php";
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
          
            if($conn->logIn($tablename, $username, $password)){
          
              $db = $conn->connDB();
              $query = $db->query("SELECT * FROM $userTableName WHERE username = '$username' ", PDO::FETCH_ASSOC);
              $user = array();
          
              foreach ($query as $row) {
                $temp = array();
                $temp['loginStatus'] = "success";
                $temp['userId'] = $row['userid'];
                $temp['username'] = $row['username'];
                $temp['mail'] = $row['mail'];
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
    Register Operation
    Android app will send a POST request which called 'register'
*/
if(isset($_POST['register'])){
    if($_POST['register'] == "true"){
        if(isset($_POST['mail']) && isset($_POST['username']) && isset($_POST['password'])){
            $username = $_POST['username'];
            $password = $_POST['password'];
            $mail = $_POST['mail'];
          
            if($conn->signUp($userTableName, $username, $password, $mail)){
              echo "success";
            }else echo "failed";
          
          }
    }else echo "failed";
}
?>