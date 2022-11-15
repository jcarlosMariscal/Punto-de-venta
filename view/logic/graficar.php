<?php
include "../config/Connection.php";
require_once "Read.php";
$query = new Read();
        echo $query->productosMax();          
?>

