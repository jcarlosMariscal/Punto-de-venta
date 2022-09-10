<?php
  require ("../config/Connection.php");
  class Create{
    public $cnx;
    function __construct(){
      $this -> cnx = Connection::connectDB();
    }
  }