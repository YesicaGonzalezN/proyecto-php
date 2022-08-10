<?php include("../template/header.php"); ?>
<?php
$txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
$txtName=(isset($_POST['txtName']))?$_POST['txtName']:"";
$txtImage=(isset($_FILES['txtImage']['name']))?$_FILES['txtImage']['name']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";

include("../config/bd.php");

switch ($accion) {
    case "Agregar":
        $sentenciaSQL=$conexion->prepare("INSERT INTO productos (nombre, imagen) VALUES (:nombre, :imagen);");
        $sentenciaSQL->bindParam(':nombre', $txtName);

        $fecha= new DateTime();
        $nombreArchivo=($txtImage!="")?$fecha->getTimestamp()."_".$_FILES["txtImage"]["name"]:"imagen.jpg";

        $tmpImage=$_FILES["txtImage"]["tmp_name"];

        if($tmpImage!="") {
            move_uploaded_file($tmpImage,"../../img/".$nombreArchivo);
        }

        $sentenciaSQL->bindParam(':imagen', $nombreArchivo);
        $sentenciaSQL->execute();
        header("Location:products.php");
    break;

    case "Editar":
        $sentenciaSQL=$conexion->prepare("UPDATE productos SET nombre=:nombre WHERE id=:id");
        $sentenciaSQL->bindParam(':nombre', $txtName);
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->execute();

        if($txtImage!="") {
            $fecha= new DateTime();
            $nombreArchivo=($txtImage!="")?$fecha->getTimestamp()."_".$_FILES["txtImage"]["name"]:"imagen.jpg";
    
            $tmpImage=$_FILES["txtImage"]["tmp_name"];
            move_uploaded_file($tmpImage,"../../img/".$nombreArchivo);

            $sentenciaSQL=$conexion->prepare("SELECT imagen FROM productos WHERE id=:id");
            $sentenciaSQL->bindParam(':id', $txtID);
            $sentenciaSQL->execute();
            $producto=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

            if(isset($producto["imagen"]) && ($producto["imagen"]!="imagen.jpg")) {
                if(file_exists("../../img/".$producto["imagen"])){
                unlink("../../img/".$producto["imagen"]);
                }
            }

            $sentenciaSQL=$conexion->prepare("UPDATE productos SET imagen=:imagen WHERE id=:id");
            $sentenciaSQL->bindParam(':imagen', $nombreArchivo);
            $sentenciaSQL->bindParam(':id', $txtID);
            $sentenciaSQL->execute();
        }
        header("Location:products.php");
        break;

    case "Cancelar":
        header("Location:products.php");
        break;

    case "Seleccionar":
        $sentenciaSQL=$conexion->prepare("SELECT * FROM productos WHERE id=:id");
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->execute();
        $producto=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
        $txtName=$producto['nombre'];
        $txtImage=$producto['imagen'];
        break;

    case "Borrar":
        $sentenciaSQL=$conexion->prepare("SELECT imagen FROM productos WHERE id=:id");
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->execute();
        $producto=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

        if(isset($producto["imagen"]) && ($producto["imagen"]!="imagen.jpg")) {
            if(file_exists("../../img/".$producto["imagen"])){
                unlink("../../img/".$producto["imagen"]);
            }
        }

        $sentenciaSQL=$conexion->prepare("DELETE FROM productos WHERE id=:id");
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->execute();
        header("Location:products.php");
         break;
}

$sentenciaSQL=$conexion->prepare("SELECT * FROM productos");
$sentenciaSQL->execute();
$listaDeProductos=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC)

?>

<div class="col-md-5">
    <div class="card">
        <div class="card-header">
            <h5 class="text-warning">Datos de Producto</h5>
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group mb-4">
                    <label for="txtID">ID</label>
                    <input type="text" required readonly value="<?php echo $txtID; ?>" class="form-control" name="txtID" id="txtID">
                </div>

                <div class="form-group mb-4">
                    <label for="txtName">Nombre</label>
                    <input type="text" required value="<?php echo $txtName; ?>" class="form-control" name="txtName" id="txtName">
                </div>

                <div class="form-group mb-5">
                    <label for="txtImage"></label>
        
                    <?php if($txtImage!="") { ?>
                        <img class="img-thumbnail" src="../../img/<?php echo $txtImage;?>" width="50" alt="" srcset="">
                    <?php } ?>

                    <input type="file" class="form-control" name="txtImage" id="txtImage">
                </div>

                <button type="submit" name="accion" value="Agregar" <?php echo($accion=="Seleccionar")?"disabled":""; ?> class="btn btn-warning">Agregar</button>
                <button type="submit" name="accion" value="Editar" <?php echo($accion!="Seleccionar")?"disabled":""; ?> class="btn btn-warning">Editar</button>
                <button type="submit" name="accion" value="Cancelar" <?php echo($accion!="Seleccionar")?"disabled":""; ?> class="btn btn-danger">Cancelar</button>
            </form>
        </div>
    </div>

</div>

<div class="col-md-7">
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($listaDeProductos as $producto) { ?>
            <tr>
                <td><?php echo $producto['id'];?></td>
                <td><?php echo $producto['nombre'];?></td>
                <td>
                    <img class="img-thumbnail" src="../../img/<?php echo $producto['imagen'];?>" width="50" alt="" srcset="">
                
                </td>
                <td>             
                    <form method="post">
                        <input type="hidden" name="txtID" id="txtID" value="<?php echo $producto['id'];?>">
                        <input type="submit" name="accion" value="Seleccionar" class="btn btn-warning">
                        <input type="submit" name="accion" value="Borrar" class="btn btn-danger">
                    </form>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

</div>

<?php include("../template/footer.php"); ?>