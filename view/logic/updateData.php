<?php
require ("Update.php");
$query = new Update();
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
