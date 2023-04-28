
<?php

require_once("conexion.php");

date_default_timezone_set('Europe/Madrid');

if ($_FILES["imagen"]["error"] != 0) {

  switch ($_FILES["imagen"]["error"]) { //antes de evaluar los casos, HAY QUE EVALUAR LA CONDICION

    case 1: //Error exceso tamaño del archivo respecto del maximo permitido en el PHP(2MB)
      echo "El tamaño del archivo excede el límite máximo permitido por el SERVIDOR de 2MB.";
      break;

    case 2: //Error exceso tamaño del archivo en el formulario(2MB)
      echo "El tamaño del archivo excede el límite máximo del FORMULARIO de 2MB.";
      break;

    case 3: //Archivo subido parcialmente
      echo "Se ha interrumpido la subida del archivo. Inténtelo de nuevo.";
      break;

    case 4: //No se ha subido ningun fichero
      echo "No se ha subido ningún archivo.";
      break;

    case 6: //No hay carpeta temporal
      echo "Ha ocurrido un error interno. Inténtelo más tarde.";
      break;

    case 7: //No se ha podido escribir el fichero en el disco
      echo "Ha ocurrido un error interno. Inténtelo más tarde.";
      break;

    case 8: //La extension no es válida
      echo "Este tipo de extensión no está permitida.";
      break;
  }



//-------------AQUI CONTINUA EL CODIGO SI NO HAY ERROR Y SUBIMOS UNA FOTO-------------
} else {

  if (is_uploaded_file($_FILES["imagen"]["tmp_name"]) && ($_FILES["imagen"]["error"] == UPLOAD_ERR_OK)) {

    $tam_imagen = $_FILES["imagen"]["size"];

    $tipo = $_FILES["imagen"]["type"];
    
    $imagen=$_FILES["imagen"]["name"];

    // $nombre = date("Ymd Gis") . "_" . $imagen;

    if ($tam_imagen < 2000000) {

      if ($tipo == "image/jpeg" || $tipo == "image/jpg" || $tipo == "image/png" || $tipo == "image/gif") {

        $carpeta_destino = $_SERVER["DOCUMENT_ROOT"] . "/0_Subidas/images/";
        move_uploaded_file($_FILES["imagen"]["tmp_name"], $carpeta_destino . $imagen);
      } else {
        echo "<p>Solo se permite subir imagenes con los formatos jpeg, jpg, png y gif";
      }
    } else {
      echo "<p>El tamaño de la imagen es mayor que 2MB</p>";
    }
  }
}


//------------AQUI CONTINUA EL CODIGO SI NO HAY ERROR Y NO HEMOS SUBIDO NINGUNA FOTO----------
if (isset($_POST["subir"])) {

  $imagen = $_FILES["imagen"]["name"] ? $imagen : $imagen="";

  // if ($imagen == "") {
  //   $imagen = "";
  // } else {
  //   $imagen;
  // }
  
  $fecha = date("Y-m-d G:i:s");

  $titulo = $_POST["titulo"];
  $comentario = $_POST["comentario"];

  $consulta = "INSERT INTO blog (TITULO, FECHA, COMENTARIO, IMAGEN) VALUES (?,?,?,?)";
  $resultado = mysqli_prepare($conexion, $consulta);
  mysqli_stmt_bind_param($resultado, "ssss", $titulo, $fecha, $comentario, $imagen);
  mysqli_stmt_execute($resultado);

  if ($resultado) {
    echo "<br>Registro insertado correctamente";
  } else {
    echo "NO se ha insertado el registro";
  }

  mysqli_stmt_close($resultado);
}








?>