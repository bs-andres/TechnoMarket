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
    <link rel="stylesheet" href="../css/estilo.css">
    <title>Listado de Productos</title>
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar bg-success navbar-dark">
        <div class="container-fluid d-flex align-items-center justify-content-start">
            
            <img src="../logo.png" alt="TechnoMarket"
                class="img-fluid me-3"
                style="max-height: 67px;">
            
            <a class="btn btn-success text-white fw-bold" href="añadir_prod.php">
                Añadir Producto
            </a>

        </div>
    </nav>



    <!-- CONTENIDO -->
    <div class="container mt-4">
        <h2 class="mb-4">Listado de Productos</h2>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Categoría</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($productos as $producto): ?>
                    <tr>
                        <td><?= htmlspecialchars($producto['producto']) ?></td>
                        <td><?= htmlspecialchars($producto['categoria']) ?></td>
                        <td>$<?= number_format($producto['precio']) ?></td>
                        <td><?= $producto['stock'] ?></td>
                        <td>
                            <a href="editar.php?id=<?= $producto['id_producto'] ?>" class="btn btn-sm btn-info text-white">Modificar</a>
                            <a href="eliminar_prod.php?id=<?= $producto['id_producto'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que desea eliminar este producto?');">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>