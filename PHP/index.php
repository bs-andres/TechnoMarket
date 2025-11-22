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
            <a class="btn btn-outline-info text-white" href="añadir_prod.php">Añadir Producto</a>
        </div>
    </nav>
    
    <div class="container mt-4">
        <h2 class="mb-4">Catalogo de Productos</h2>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Categoría</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($productos as $producto): //recorre los productos ?>
                    <tr>
                        <td><?= htmlspecialchars($producto['id_producto']) //lo muestra en la tabla?></td>
                        <td><?= htmlspecialchars($producto['producto'])?></td>
                        <td><?= htmlspecialchars($producto['categoria']) ?></td>
                        <td>$<?= number_format($producto['precio']) ?></td>
                        <td><?= $producto['stock'] ?></td>
                        <td>
                            <a href="modificar_prod.php?id=<?= $producto['id_producto'] ?>"class="btn btn-sm btn-info text-white d-block d-sm-inline-block mb-2 mb-sm-0 me-sm-2">Modificar</a>
                            <a href="eliminar_prod.php?id=<?= $producto['id_producto'] ?>" class="btn btn-sm btn-danger d-block d-sm-inline-block" onclick="return confirm('¿Esta seguro que quiere eliminar este producto?');">Eliminar</a>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>