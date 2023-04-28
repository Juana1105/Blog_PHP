<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
body{
  background-color: lightskyblue;
  box-sizing: border-box;
  
}
#contenedor{
  width: 50%;
  display: flex;
  flex-direction: column;
  align-content: center;
  align-items: center;
  background-color: lightseagreen;
  border: 2px solid navy;
  border-radius: 15px;
  margin: 0 auto;
  margin-top: 30px;
  margin-bottom: 25px;
}
h1{
  text-align: center;
  color: navy;
  font-size: 4rem;
  margin: 4rem 6rem;
}
h3{
  text-align: center;
  font-weight: bold;
  font-size: 2rem;
  color: black;
  margin-bottom: -1px;
  padding: 15px
}
h4{
  text-align: center;
  color: white;
  font-weight: normal;
}
#comentario{
  width: 70%;
  background-color: lightskyblue;
  border: 1px solid gray;
  border-radius: 5px;
  padding: 10px;
  text-align: center;
  margin-bottom: 2rem;
}
img{
  margin-bottom:2rem;
  width: 300px;
  height: auto;
  border-radius: 7px;
  border: 2px dotted blue;
}

</style>

</head>
<body>
<h1>BLOG DE JUANA SIERRA</h1>



<?php

require_once("conexion.php");

$buscar=$_GET["buscar"];



    $consulta="SELECT * FROM blog WHERE TITULO LIKE concat('%',?,'%') ORDER BY FECHA DESC";

    $resultados=mysqli_prepare($conexion, $consulta);

    $asociar=mysqli_stmt_bind_param($resultados,"s",$buscar);

    $ejecutar=mysqli_stmt_execute($resultados);

    mysqli_stmt_bind_result($resultados, $id, $titulo, $fecha, $comentario, $imagen);

    if($ejecutar==false){

      echo "Ha ocurrido un error en la consulta";

    } else {

      while(mysqli_stmt_fetch($resultados)){


        ?>
       
        <div id="contenedor">

          <h3><?php echo $titulo ?></h3>
          <h4><?php echo $fecha ?></h4>
          <div id="comentario"><?php echo $comentario ?></div>

          <?php
            if($imagen!=""){

                echo "<img src='../../0_Subidas/images/" . $imagen .  "'/>";
              }
          ?>

        </div>

        <?php
      }
    }
    





?>


</body>
</html>

