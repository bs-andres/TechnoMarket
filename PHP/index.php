<?php
require_once "conexion.php";

// Obtener productos
$sql = $pdo->query("SELECT * FROM productos ORDER BY id_producto ASC");
$productos = $sql->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Listado de Productos</title>
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-sm bg-success navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Gestor de Productos</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="menu">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="añadir_prod.php">Añadir Producto</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- CONTENIDO -->
    <div class="container mt-4">
        <h2 class="mb-4">Listado de Productos</h2>
        <div class="table-responsive">
            <table class="table align-middle">
                <thead class="bg-success text-white">
                    <tr>
                        <th>Nombre</th>
                        <th>Categoría</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th width="160">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($productos as $p): ?>
                        <tr>
                            <td><?= htmlspecialchars($p['producto']) ?></td>
                            <td><?= htmlspecialchars($p['categoria']) ?></td>
                            <td>$<?= number_format($p['precio'], 2) ?></td>
                            <td><?= $p['stock'] ?></td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="editar.php?id=<?= $p['id_producto'] ?>" 
                                    class="btn btn-sm btn-info text-white">Modificar</a>

                                    <a href="eliminar.php?id=<?= $p['id_producto'] ?>" 
                                    class="btn btn-sm btn-danger"
                                    onclick="return confirm('¿Seguro que deseas eliminar este producto?');">
                                    Eliminar
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
        </div>
    </div>

</body>
</html>