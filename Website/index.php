<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="Modules/bootstrap/css/bootstrap.min.css">
    <title>Web Site</title>
</head>
<body>

  <?php
  if(isset($_GET['p'])){
    switch ($_GET['p']) {
      case 'login':
        header( "refresh:0.1; url=login/" );
        break;

      case 'signup':
        header( "refresh:0.1; url=signup/" );
        break;

      default:
        header( "refresh:0.1; url=login/" );
        break;
    }
  }else{
    header( "refresh:0.1;url=login/");
  }
   ?>

  <script src="Modules/bootstrap/js/bootstrap.min.js" charset="utf-8"></script>
  <script type="text/javascript" src="Modules/jquery/jquery-3.6.0.min.js"></script>
  <script type="text/javascript" src="src/config/getConstants.js"></script>
</body>
</html>
