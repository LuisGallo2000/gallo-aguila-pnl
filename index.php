<!DOCTYPE html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['titulo'], $_POST['descripcion'], $_POST['ubicacion'], $_POST['estado'], $_POST['ciudadano'], $_POST['telefono_ciudadano']) || 
        empty($_POST['titulo']) || empty($_POST['descripcion']) || empty($_POST['ubicacion']) || empty($_POST['estado']) || empty($_POST['ciudadano']) || empty($_POST['telefono_ciudadano'])) {
        echo "<div class='alert alert-danger'>Por favor, complete todos los campos.</div>";
    } else {
        $titulo = $_POST["titulo"];
        $descripcion = $_POST["descripcion"];
        $ubicacion = $_POST["ubicacion"];
        $estado = $_POST["estado"];
        $ciudadano = $_POST["ciudadano"];
        $telefono_ciudadano = $_POST["telefono_ciudadano"];
        include "modelo/modelo.php";
        $nuevo = new Denuncias();
        $resultado = $nuevo->setDenuncia($titulo, $descripcion, $ubicacion, $estado, $ciudadano, $telefono_ciudadano);
        if ($resultado) {
            echo "<div class='alert alert-success'>Denuncia registrada exitosamente.</div>";
        } else {
            echo "<div class='alert alert-danger'>Error al registrar la denuncia.</div>";
        }
    }
}
?>

<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Denuncias</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f8ff;
        }
        .container {
            margin-top: 20px;
            background: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h1, h3 {
            color: #0056b3;
        }
        .lead {
            color: #6c757d;
        }
        .btn-success {
            background-color: #28a745;
        }
        .btn-danger {
            background-color: #dc3545;
        }
        .btn-warning {
            background-color: #ffc107;
        }
        .btn-secondary {
            background-color: #6c757d;
        }
    </style>
</head>
<body>
    <div class="container">
        <header class="text-center">
            <h1>Gestión de Denuncias</h1>
            <p class="lead">Sistema de registro y gestión de denuncias</p>
        </header>
        <div class="row">
            <div class="col-lg-6">
                <form action="#" method="post">
                    <h3>Nueva Denuncia</h3>                
                    <div class="form-group">
                        <label for="titulo">Título:</label>
                        <input type="text" name="titulo" class="form-control" required />    
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripción:</label>
                        <input type="text" name="descripcion" class="form-control" required />    
                    </div>
                    <div class="form-group">
                        <label for="ubicacion">Ubicación:</label>
                        <input type="text" name="ubicacion" class="form-control" required />    
                    </div>
                    <div class="form-group">
                        <label for="estado">Estado:</label>
                        <select name="estado" class="form-control" required>
                            <option value="pendiente">Pendiente</option>
                            <option value="en proceso">En proceso</option>
                            <option value="resuelto">Resuelto</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="ciudadano">Ciudadano:</label>
                        <input type="text" name="ciudadano" class="form-control" required />    
                    </div>
                    <div class="form-group">
                        <label for="telefono_ciudadano">Teléfono del Ciudadano:</label>
                        <input type="text" name="telefono_ciudadano" class="form-control" required />    
                    </div>
                    <input type="submit" value="Registrar" class="btn btn-success"/>
                </form>
            </div>
            <div class="col-lg-6 text-center">
                <h3>Listado de Denuncias</h3>
                <a href="controlador/controlador.php" class="btn btn-info"><i class="fa fa-align-justify"></i> Acceder al listado de denuncias</a>
            </div> 
        </div>
        <footer class="text-center">
            <p>Desarrollado por Luis Piero Gallo Aguila - <?php echo date("Y"); ?></p>
        </footer>
    </div>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>