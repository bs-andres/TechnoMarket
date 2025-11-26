<?php
require_once "conexion.php";

//selecciona productos
$sql = $pdo->query("SELECT * FROM productos ORDER BY producto");
$productos = $sql->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../css/estilos.css">
    <title>TechnoMarket</title>
</head>

<body>

    <!-- navbar -->
    <nav class="navbar bg-success navbar-dark">
        <div class="container-fluid d-flex justify-content-start">
            <img src="../logo_trans.png" alt="TechnoMarket" class="img-fluid me-3">
            <a class="btn btn-outline-info text-white me-3" href="crear.php">Añadir Producto</a>
            <a class="btn btn-outline-info text-white" href="index.php">Ver Productos</a>
        </div>
    </nav>
    
    <div class="container mt-4">
        <div class="card border-success col-md-8 mx-auto" >
            
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">Catálogo de productos</h5>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped text-center">
                        <thead class="table-success">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Categoría</th>
                                <th>Precio</th>
                                <th>Stock</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($productos as $producto): ?>
                            <tr>
                                <td><?= htmlspecialchars($producto['id_producto']) ?></td>
                                <td><?= htmlspecialchars($producto['producto']) ?></td>
                                <td><?= htmlspecialchars($producto['categoria']) ?></td>
                                <td>$<?= number_format($producto['precio']) ?></td>
                                <td><?= $producto['stock'] ?></td>
                                <td><a href="editar.php?id=<?= $producto['id_producto'] ?>" class="btn btn-sm btn-info text-white">Modificar</a></td>
                                <td><a href="eliminar.php?id=<?= $producto['id_producto'] ?>" class="btn btn-sm btn-danger"onclick="return confirm('¿Está seguro que quiere eliminar este producto?');">Eliminar</a></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>