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

        $sql = "INSERT INTO productos (producto, precio, categoria, stock) VALUES (:producto, :precio, :categoria, :stock)";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":producto", $producto);
        $stmt->bindParam(":precio", $precio);
        $stmt->bindParam(":categoria", $categoria);
        $stmt->bindParam(":stock", $stock);

        if ($stmt->execute()) {
            header("Location: index.php");
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

    <style>
        .form-container {
            max-width: 300px;
            margin: auto;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-sm bg-success navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Gestor de Productos</a>
        </div>
    </nav>

    <div class="container mt-4">

        <h2 class="mb-4 text-center">Añadir Nuevo Producto</h2>

        <?= $mensaje ?>

        <div class="card shadow-sm form-container">
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