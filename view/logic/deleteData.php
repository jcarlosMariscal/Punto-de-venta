<?php
require ("Delete.php");
$query = new Delete();
$table = (isset($_POST['table']) ? $_POST['table'] : NULL);
if(!empty($_POST)){
  switch ($table) {
    case '':
      break;
    
    default:
      # code...
      break;
  }
}
