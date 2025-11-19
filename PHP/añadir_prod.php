<?php
require_once "conexion.php";

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $producto  = trim($_POST["producto"] ?? "");
    $precio    = trim($_POST["precio"] ?? "");
    $categoria = trim($_POST["categoria"] ?? "");
    $stock     = trim($_POST["stock"] ?? "");

    if ($producto === "" || $precio === "" || $categoria === "" || $stock === "") {
        $mensaje = "Todos los campos son obligatorios.";
    } else {

        $sql = "INSERT INTO productos (producto, precio, categoria, stock) 
                VALUES (:producto, :precio, :categoria, :stock)";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":producto", $producto);
        $stmt->bindParam(":precio", $precio);
        $stmt->bindParam(":categoria", $categoria);
        $stmt->bindParam(":stock", $stock);

        if ($stmt->execute()) {
            header("Location: index.php?mensaje=creado");
            exit;
        } else {
            $mensaje = "Error al guardar el producto.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Añadir Producto</title>
</head>

<body>

    <nav class="navbar navbar-expand-sm bg-success navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Gestor de Productos</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="menu">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="añadir_prod.php">Añadir Producto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Listar Productos</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <div class="container mt-4">
        
        <h2 class="mb-4">Añadir Nuevo Producto</h2>

        <?= $mensaje ?>

        <div class="card shadow-sm">
            <div class="card-body">

                <form action="" method="POST">

                    <div class="mb-3">
                        <label class="form-label">Nombre del producto</label>
                        <input type="text" name="producto" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Categoría</label>
                        <input type="text" name="categoria" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Precio</label>
                        <input type="number" step="0.01" name="precio" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Stock</label>
                        <input type="number" name="stock" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-success">Guardar</button>
                    <a href="index.php" class="btn btn-info">Volver</a>

                </form>

            </div>
        </div>
    </div>
</body>
</html>