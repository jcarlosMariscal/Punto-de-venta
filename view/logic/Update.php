<?php
  require ("../config/Connection.php");
  class Update{
    public $cnx;
    function __construct(){
      $this -> cnx = Connection::connectDB();
    }
  }