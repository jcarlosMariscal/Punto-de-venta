<?php
require ("Delete.php");
$query = new Delete();

$personal = (isset($_GET['personal']) ? $_GET['personal'] : NULL);
if($personal){
  $delete = $query->deletePersonal($personal);
  if($delete){
    header("Location: ../index.php?p=personal");
  }
}