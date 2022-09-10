<?php
  require ("../config/Connection.php");
  class Delete{
    public $cnx;
    function __construct(){
      $this -> cnx = Connection::connectDB();
    }
  }