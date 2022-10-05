<?php
require ("Delete.php");
$query = new Delete();

$personal = (isset($_GET['personal']) ? $_GET['personal'] : NULL);
$proveedor = (isset($_GET['proveedor']) ? $_GET['proveedor'] : NULL);
if($personal){
  $delete = $query->deletePersonal($personal);
  if($delete){
    ?>
    <script>
        localStorage.setItem("deletPer", "true");
     window.location.href = "../index.php?p=personal";
    </script>
  <?php  

  }
}
if($proveedor){
  $delete = $query->deleteProveedor($proveedor);
  if($delete){
    ?>
        <script>
            localStorage.setItem("deleteProv", "true");
         window.location.href = "../index.php?p=proveedor";
        </script>
      <?php  

  }
}