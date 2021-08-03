<?php

define("EXITTEXT", "

<html lang='en'>
<head>
    <title>Login Failed</title>
    <meta charset='UTF-8'>
	<meta name='viewport' content='width=device-width, initial-scale=1'>
</head>
<body>
<style>


    * {
        margin: 0px;
        padding: 0px;
        box-sizing: border-box;
    }

    body, html {
        height: 100%;
        font-family: sans-serif;
    }

    .exitPage{
        width: 100%;
        min-height: 100vh;
        display: -webkit-box;
        display: -webkit-flex;
        display: -moz-box;
        display: -ms-flexbox;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
        padding: 15px;
      
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
        position: relative;
        z-index: 1;

        background-image: url('images/bg-pattern.png');
    }

    .exitPageDialogBox{
        width: 390px;
        border-radius: 10px;
        overflow: hidden;
      
        padding: 30px 15px 30px 15px;

        border-radius: 10px;
        background-color: #fff;
    }

    .exitPageDialog{
        width: 100%;
    }

    .exitPageTitle{
        color: #555555;
    }

    .loginPageRedirection{
        border-style: solid;
        border-width: 5px;
        border-radius: 15px;
        width: auto;
        height: 40px;
        line-height: 30px;
        
        padding: 5px 30px 5px 30px;

        color: #444444;
        text-decoration: none;
        font-size: 20px;
        user-select: none;
      
        -webkit-transition: all 0.5s;
        -o-transition: all 0.5s;
        -moz-transition: all 0.5s;
        transition: all 0.5s;
    }

    .loginPageRedirection:hover{
        text-decoration: none;
      
        color: #fff15f;
      
        -webkit-transition: all 0.5s;
        -o-transition: all 0.5s;
        -moz-transition: all 0.5s;
        transition: all 0.5s;
      }

</style>

<div class='exitPage'>
    <div class='exitPageDialogBox'>
        <div class='exitPageDialog'>
            <center>
                <h2 class='exitPageTitle'>Login failed.</h2>
            </center>
            <br>
            Please check your information and try login again! 
            <br>
            <center>
                <b>Redirecting in 4 seconds.</b>
            </center>
            <br><br>
            <center>
                <a href='../login/' class='loginPageRedirection'>Login</a>
            </center>
            
        </div>
    </div>
</div>
</body>
</html>


");


?>