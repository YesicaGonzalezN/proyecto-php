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
        $sentenciaSQL->bindParam(':imagen', $txtImage);
        $sentenciaSQL->execute();
    break;
        case "Editar":
            echo "Presionado boton de editar";
            break;
        case "Cancelar":
            echo "Presionado boton de cancelar";
            break;
        case "Seleccionar":
            echo "Presionado boton de seleccionar";
            break;
        case "Borrar":
            $sentenciaSQL=$conexion->prepare("DELETE FROM productos WHERE id=:id");
            $sentenciaSQL->bindParam(':id', $txtID);
            $sentenciaSQL->execute();
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
                    <input type="text" class="form-control" name="txtID" id="txtID">
                </div>

                <div class="form-group mb-4">
                    <label for="txtName">Nombre</label>
                    <input type="text" class="form-control" name="txtName" id="txtName">
                </div>

                <div class="form-group mb-5">
                    <label for="txtImage">Imagen</label>
                    <input type="file" class="form-control" name="txtImage" id="txtImage">
                </div>

                <button type="submit" name="accion" value="Agregar" class="btn btn-warning">Agregar</button>
                <button type="submit" name="accion" value="Editar" class="btn btn-warning">Editar</button>
                <button type="submit" name="accion" value="Cancelar" class="btn btn-danger">Cancelar</button>
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
                <td><?php echo $producto['imagen'];?></td>
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