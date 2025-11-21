<?php
require_once "conexion.php";//

if (!isset($_GET['id'])) {//recibe el id
    die("ID de producto no especificado.");
}

$id = intval($_GET['id']);//variable con id

$stmt = $pdo->prepare("DELETE FROM productos WHERE id_producto = ?");//borra
$stmt->execute([$id]);

//redirige de vuelta al listado
header("Location: index.php");
exit;
?>