<?php

/**

 * Db Connection

 */

class dbProcess

{

  public $db;
  public $data;
  public $login;


  public function __construct(){

    $this->db = null;
    $this->data = null;
    $this->login = null;

  }


  function connDB(){
      $host       = "localhost";
      $dbname     = "notex";
      $username   = "root";
      $password   = "";

      try {
          $this->db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
          return $this->db;
      } catch ( PDOException $e ){
          print $e->getMessage();
      }

  }

  function prepareData($data){

    return htmlspecialchars($data);

  }

  function countOfRows($tableName, $columnName, $value){

    $db = $this->connDB();
    $query = $db->query("SELECT * FROM {$tableName} WHERE {$columnName} = '$value' ");
    $this->count = $query->rowCount();

  }



  function logIn($table, $username, $password){

    $username = $this->prepareData($username);
    $password = $this->prepareData($password);
    $password = md5($password);

    $db = $this->connDB();
    $query = $db->query("SELECT * FROM {$table} WHERE username = '$username' AND password = '$password' ", PDO::FETCH_ASSOC);

    $this->fetch = array();

    foreach ($query as $row) {

        $this->fetch = $row;

    }

    if(!empty($this->fetch)){

      $login = true;

    }else $login = false;

    return $login;

  }



  function insert($tableName, $columnNames, $values){

    $db = $this->connDB();

    $query = $db->prepare("INSERT INTO {$tableName} SET {$columnNames}");
    $insert = $query->execute($values);

    if($insert){

      $insertQuery = true;

    }else $insertQuery = false;

    return $insertQuery;

  }



  function selectSingleData($tableName, $columnName, $value){

    $value = $this->prepareData($value);

    $db = $this->connDB();
    $query = $db->query("SELECT * FROM {$tableName} WHERE {$columnName} = '$value' ", PDO::FETCH_ASSOC);
    $this->fetch = array();

    foreach ($query as $row) {

        $this->fetch = $row;

    }

    return $this->fetch;

  }



  function signUp($table, $username, $password, $mail){

    $username = $this->prepareData($username);
    $password = $this->prepareData($password);
    $mail = $this->prepareData($mail);
    $password = md5($password);

    //Check for is username already taken?
    $this->selectSingleData($table, "username", $username);

    if(empty($this->fetch)){

      //Check for is mail address already taken?
      $this->selectSingleData($table, "email", $mail);

      if(empty($this->fetch)){

        $columnNames = "
          username = ?,
          password = ?,
          email = ?
        ";

        $values = array($username, $password, $mail);

        if($this->insert($table, $columnNames, $values)){

          $signUpProcess = true;

        }else $signUpProcess = false;

      } else $signUpProcess = false;

    } else $signUpProcess = false;

    return $signUpProcess;

  }



  function addNewNote($tableName, $title, $content, $owner, $date){
    
    $title = $this->prepareData($title);
    $content = $this->prepareData($content);

    $columnNames = "
      noteTitle = ?,
      noteContent = ?,
      noteOwner = ?,
      noteDate = ?
    ";
    
    $values = array($title, $content, $owner, $date);
    
    if($this->insert($tableName, $columnNames, $values)){

      return true;

    }else return false;

  }



  function deleteNote($tableName, $columnName, $value){

    $db = $this->connDB();

    $query = $db->prepare("DELETE FROM {$tableName} WHERE {$columnName} = :columnValue");
    $delete = $query->execute(array(
    'columnValue' => $value
    ));

    if($delete){

      return true;

    }else return false;

  }



  public function updateMultiple($table_name, $array, $columnNames, $whereColumn, $whereColumnValue){

      $db = $this->connDB();

      $query = $db->prepare("UPDATE {$table_name} SET
      {$columnNames}
      WHERE {$whereColumn} = {$whereColumnValue} ");
      
      $update = $query->execute($array);

      if($update){

        return true;

      } else return false;

  }

}

?>