<?php
// Check for is user logged in or not.
if(isset($_POST['loginStatus'])){
  if($_POST['loginStatus'] == "success"){
    $db_location = "../db/db.php";
    $notesTableName = "notes";

    include($db_location);
    $conn = new dbProcess();
  }else die("failed");
}else die("failed");


/*
  Add a note
  Android app will send a POST request which called 'addNote'
*/
if(isset($_POST['addNote'])){
  if($_POST['addNote'] == "true"){
    if(isset($_POST['userid']) && isset($_POST['noteTitle']) && isset($_POST['noteText']) && isset($_POST['noteDate'])){

      $userId = $_POST['userid'];
      $noteTitle = $_POST['noteTitle'];
      $noteText = $_POST['noteText'];
      $noteDate = $_POST['noteDate'];
      $noteOwner = $userId;
    
      $conn->countOfRows($notesTableName, "noteOwner", $userId);
      $count = $conn->count;
      $count++;
    
      if($conn->addNewNote($notesTableName, $noteTitle, $noteText, $noteOwner, $noteDate, $count)){
        echo "success";
      }else echo "failed";
    
    }else echo "failed";
  }else echo "failed";
}

/*
  Update a note
  Android app will send a POST request which called 'updateNote'
*/
if(isset($_POST['updateNote'])){
  if($_POST['updateNote'] == "true"){
    if(isset($_POST['noteId']) && isset($_POST['noteTitle']) && isset($_POST['noteText'])){

      $noteId = $_POST["noteId"];
      $noteTitle = $_POST["noteTitle"];
      $noteText = $_POST["noteText"];
      $whichColumnWillChange = "noteId";

      $array = array(
          "noteTitle" => $noteTitle,
          "noteText" => $noteText
      );

      $variables = "
      noteTitle = :noteTitle,
      noteText = :noteText
      ";

      if($conn->updateMultiple($notesTableName, $array, $variables, $whichColumnWillChange, $noteId)){
        echo "success";
      }else echo "failed";

    }else echo "failed";
  }else echo "failed";
}

/*
  Get all the notes
  Android app will send a POST request which called 'getNotes'
*/
if(isset($_POST['getNotes'])){
  if($_POST['getNotes'] == "true"){
    if(isset($_GET['userIdInformation'])){

      $userId = $_GET['userIdInformation'];
  
      $db = $conn->connDB();
      $query = $db->query("SELECT * FROM {$notesTableName} WHERE noteOwner = '$userId' ORDER BY noteId DESC ", PDO::FETCH_ASSOC);
      $notes = array();
  
      foreach ($query as $row) {
        $temp = array();
        $temp['noteId'] = $row['noteId'];
        $temp['noteOwner'] = $row['noteOwner'];
        $temp['noteTitle'] = $row['noteTitle'];
        $temp['noteText'] = $row['noteText'];
        $temp['noteDate'] = $row['noteDate'];
        array_push($notes, $temp);
      }
      echo json_encode($notes);

    }else echo "failed";
  }else echo "failed";
}

/*
  Delete a note
  Android app will send a POST request which called 'deleteNote'
*/
if(isset($_POST['deleteNote'])){
  if($_POST['deleteNote'] == "true"){
    if(isset($_POST['noteId'])){

      $noteId = $_POST['noteId'];
      $columnName = "noteId";

      if($conn->deleteNote($notesTableName, $columnName, $noteId)){
        echo "success";
      }else echo "failed";

    }else echo "failed";
  }else echo "failed";
}
?>