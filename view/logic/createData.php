<?php
require ("Create.php");
$query = new Create();
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
