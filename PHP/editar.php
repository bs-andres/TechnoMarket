<?php
require_once "conexion.php";

if (!isset($_GET['id'])) {
    die("ID inválido.");
}

$id = $_GET['id'];

//datos a modificar
$stmt = $pdo->prepare("SELECT * FROM productos WHERE id_producto = ?");
$stmt->execute([$id]);
$producto = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$producto) {
    die("Producto no encontrado.");
}

$error = "";

//si llego el form
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nombre    = trim($_POST["producto"]);
    $categoria = trim($_POST["categoria"]);
    $precio    = trim($_POST["precio"]);
    $stock     = trim($_POST["stock"]);

    if ($nombre === "" || $categoria === "" || $precio === "" || $stock === "") {
        $error = "Todos los campos son obligatorios.";
    } else {
        //actualiza datos
        $update = $pdo->prepare(" UPDATE productos SET producto = ?, categoria = ?, precio = ?, stock = ? WHERE id_producto = ?");

        $update->execute([$nombre, $categoria, $precio, $stock, $id]);

        header("Location: index.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../css/estilos.css">
    <title>Modificar Producto</title>
</head>
<body>
    <nav class="navbar bg-success navbar-dark">
        <div class="container-fluid d-flex justify-content-start">
            <img src="../logo_trans.png" alt="TechnoMarket" class="img-fluid me-3" style="max-height: 80px;">
        </div>
    </nav>

    <div class="container mt-4">
        <h2 class="mb-4 text-center">Modificar Producto</h2>
        <?php if ($error): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>
        <div class="card border-success col-md-6 mx-auto">
            <div class="card-body">
                <form action="" method="POST">
                    <div class="mb-2">
                        <label class="form-label">Producto</label>
                        <input type="text" name="producto" class="form-control" value="<?= ($producto['producto']) ?>" required>
                    </div>

                    <div class="mb-2">
                        <label class="form-label">Categoría</label>
                        <input type="text" name="categoria" class="form-control" value="<?= ($producto['categoria']) ?>" required>
                    </div>

                    <div class="mb-2">
                        <label class="form-label">Precio</label>
                        <input type="number" name="precio" min="1" class="form-control" value="<?= $producto['precio'] ?>" required>
                    </div>

                    <div class="mb-2">
                        <label class="form-label">Stock</label>
                        <input type="number" name="stock" min="0" class="form-control" value="<?= $producto['stock'] ?>" required>
                    </div>

                    <button class="btn btn-success" type="submit">Actualizar</button>
                    <a href="index.php" class="btn btn-info text-white">Volver</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>