<?php 
require_once("../modelo/modelo.php");
$denuncias = new Denuncias();

if (isset($_GET["accion"])) {
    if ($_GET["accion"] === 'obtener' && isset($_GET["id"])) {
        $id = $_GET["id"];
        $denuncia = $denuncias->getDenunciaById($id);
        echo json_encode($denuncia);
        exit();
    } elseif ($_GET["accion"] === 'eliminar' && isset($_GET["id"])) {
        $id = $_GET["id"];
        $denuncias->deleteDenuncia($id);
        header("location: ../controlador/controlador.php");
        exit();
    }
}

$datos = $denuncias->getDenuncias();
require_once("../vista/vista.php");