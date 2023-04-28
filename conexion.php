
<?php

  $conexion=mysqli_connect("localhost","root","iusenma","pruebas");

  if(mysqli_connect_errno()){
    echo "No se ha podido establecer la conexión con la BBDD";
    exit();
  }
  // else{
  //   echo "CONEXION OK";
  // }
  mysqli_set_charset($conexion, "utf8");

?>