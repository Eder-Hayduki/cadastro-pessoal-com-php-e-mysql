<?php
// id 
$txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
// nombre 
$txtNombre = (isset($_POST['txtNombre'])) ? $_POST['txtNombre'] : "";
// imagen 
$txtImagen = (isset($_FILES['txtImagen']['name'])) ? $_FILES['txtImagen']['name'] : "imagen vazio";
// accion 
$accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";



switch ($accion) {

  case 'agregar':
    //  sentencia a ejecutar
    $sentenciaSQL = $conexion->prepare("INSERT INTO libros (nombre,imgen) VALUES (:nombre, :imagen); ");
    // parametros a pasar 
    $sentenciaSQL->bindParam(':nombre', $txtNombre);

    // subida de imagenes a la carpeta 
    $fecha = new DateTime();
    $nombreArchivo = ($txtImagen != "") ? $fecha->getTimestamp() . "_" . $_FILES["txtImagen"]["name"] : "imagen.jpg";

    $tmpImagen = $_FILES["txtImagen"]["tmp_name"];

    if ($tmpImagen != "") {
      move_uploaded_file($tmpImagen, "../../img/" . $nombreArchivo);
    }

    $sentenciaSQL->bindParam(':imagen', $nombreArchivo);
    // ejecucion 
    $sentenciaSQL->execute();
    header("Location:productos.php");
    break;

  case 'modificar':
    $sentenciaSQL = $conexion->prepare("UPDATE libros SET nombre=:nombre WHERE id=:id");
    $sentenciaSQL->bindParam(':nombre', $txtNombre);
    $sentenciaSQL->bindParam(':id', $txtID);
    $sentenciaSQL->execute();


    if ($txtImagen != "") {

      // asignar nombre y mover a la carpeta en el servidor
      $fecha = new DateTime();
      $nombreArchivo = ($txtImagen != "") ? $fecha->getTimestamp() . "_" . $_FILES["txtImagen"]["name"] : "imagen.jpg";
      $tmpImagen = $_FILES["txtImagen"]["tmp_name"];

      move_uploaded_file($tmpImagen, "../../img/" . $nombreArchivo);


      // borrar imagen anterior de la carpeta del servidor 
      $sentenciaSQL = $conexion->prepare("SELECT imgen FROM libros WHERE id=:id");
      $sentenciaSQL->bindParam(':id', $txtID);
      $sentenciaSQL->execute();
      $libro = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

      if (isset($libro["imgen"]) && ($libro["imgen"] != "imagen.jpg")) {


        if (file_exists("../../img/" . $libro["imgen"])) {
          unlink("../../img/" . $libro["imgen"]);
        }
      }
      // para la imagen actualizar
      $sentenciaSQL = $conexion->prepare("UPDATE libros SET imgen=:imgen WHERE id=:id");
      $sentenciaSQL->bindParam(':imgen', $nombreArchivo);
      $sentenciaSQL->bindParam(':id', $txtID);
      $sentenciaSQL->execute();
      header("Location:productos.php");
    }

    break;
  case 'cancelar':
    header("Location:productos.php");
    break;
  case 'seleccionar':
    $sentenciaSQL = $conexion->prepare("SELECT * FROM libros WHERE id=:id");
    $sentenciaSQL->bindParam(':id', $txtID);
    $sentenciaSQL->execute();
    $libro = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

    $txtNombre = $libro['nombre'];
    $txtImagen = $libro['imgen'];
    break;
  case 'borrar':
    // borrar de la carpeta del servidor 
    $sentenciaSQL = $conexion->prepare("SELECT imgen FROM libros WHERE id=:id");
    $sentenciaSQL->bindParam(':id', $txtID);
    $sentenciaSQL->execute();
    $libro = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

    if (isset($libro["imgen"]) && ($libro["imgen"] != "imagen.jpg")) {


      if (file_exists("../../img/" . $libro["imgen"])) {
        unlink("../../img/" . $libro["imgen"]);
      }
    }
    // borrar del banco de dados 
    $sentenciaSQL = $conexion->prepare("DELETE FROM libros WHERE id=:id");
    $sentenciaSQL->bindParam(':id', $txtID);
    $sentenciaSQL->execute();
    header("Location:productos.php");

    break;

  default:

    break;
}

$sentenciaSQL = $conexion->prepare("SELECT * FROM libros");
$sentenciaSQL->execute();
$listaLibros = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);



?>


<div class="col-md-5">

  <div class="card">

    <div class="card-header">
      Datos del Libro
    </div>

    <div class="card-body">
      <form method="POST" enctype="multipart/form-data">

        <div class="form-group">
          <label for="txtID">ID</label>
          <input type="text" required readonly class="form-control" value="<?php echo $txtID; ?>" name="txtID" id="txtId" placeholder="ID">
        </div>

        <div class="form-group">
          <label for="txtNombre">Nombre:</label>
          <input type="text" required class="form-control" value="<?php echo $txtNombre; ?>" name="txtNombre" id="txtNombre" placeholder="Nombre del libro">
        </div>

        <div class="form-group">
          <label for="txtImagen">Imagen:</label>

          <br />

          <?php if ($txtImagen != "") {  ?>

            <img class="img-thumbnail rounded" src="../../img/<?php echo $txtImagen; ?>" width="200" alt="imgenLibro">


          <?php } ?>
          <input type="file" class="form-control" name="txtImagen" id="txtImagen">
        </div>

        <br />

        <div class="btn-group" role="group" aria-label="">
          <button type="submit" name="accion" <?php echo ($accion == "seleccionar") ? "disabled" : ""; ?> value="agregar" class="btn btn-success">Agregar</button>
          <button type="submit" name="accion" <?php echo ($accion !== "seleccionar") ? "disabled" : ""; ?> value="modificar" class="btn btn-warning">Modificar</button>
          <button type="submit" name="accion" <?php echo ($accion !== "seleccionar") ? "disabled" : ""; ?> value="cancelar" class="btn btn-info">Cancelar</button>
        </div>
      </form>
    </div>


  </div>

</div>


<div class="col-md-7">
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nombre </th>
        <th>Imagem</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>

      <?php foreach ($listaLibros as  $libro) { ?>
        <tr>
          <td><?php echo $libro['id']; ?></td>
          <td><?php echo $libro['nombre']; ?></td>
          <td>
            <img src="../../img/<?php echo $libro['imgen']; ?>" width="200" alt="imgenLibro">
          </td>

          <td>
            <form method="post">
              <input type="hidden" name="txtID" id="txtID" value="<?php echo $libro['id']; ?>" />
              <input type="submit" name="accion" value="seleccionar" class="btn btn-primary">
              <input type="submit" name="accion" value="borrar" class="btn btn-danger">
            </form>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>