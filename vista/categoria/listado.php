<?php
include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/vista/layout/header.php";
include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/vista/layout/navbar.php";

include $_SERVER['DOCUMENT_ROOT']."/sisventas/controlador/categoriaController.php";

$categoria = new CategoriaController();
$datos = $categoria->obtener_listado();

?>
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Listado de Categorías</h5>
                    <a class="btn btn-primary" href="crear.php" role="button">Nueva Categoría</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID Categoría</th>
                                    <th>Nombre</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                if ($datos && count($datos) > 0) {
                                    foreach ($datos as $fila) {
                                        ?>
                                        <tr>
                                            <td><?php echo $fila['idcategoria']; ?></td>
                                            <td><?php echo $fila['nomcategoria']; ?></td>
                                            <td>
                                                <a href="editar.php?id=<?php echo $fila['idcategoria']; ?>" class="btn btn-sm btn-warning">Editar</a>
                                                <a href="eliminar.php?id=<?php echo $fila['idcategoria']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Está seguro de eliminar esta categoría?')">Eliminar</a>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="3" class="text-center">No hay categorías registradas</td>
                                    </tr>
                                <?php
                                }
                            ?>  
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/vista/layout/footer.php"; ?> 