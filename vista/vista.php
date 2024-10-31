<?php 

if (isset($_GET["accion"]) && $_GET["accion"] === 'eliminar') {
    if (isset($_GET["id"]) && $_GET["id"] !== '') {
        $id = $_GET["id"];
        $denuncias = new Denuncias();
        $denuncias->deleteDenuncia($id);
        header("location: ../controlador/controlador.php");
        exit();
    }
}

if (isset($_GET["accion"]) && $_GET["accion"] === 'actualizar') {
    if (!isset($_POST['id'], $_POST['titulo'], $_POST['descripcion'], $_POST['ubicacion'], $_POST['estado'], $_POST['ciudadano'], $_POST['telefono_ciudadano']) || 
        empty($_POST['id']) || empty($_POST['titulo']) || empty($_POST['descripcion']) || empty($_POST['ubicacion']) || empty($_POST['estado']) || empty($_POST['ciudadano']) || empty($_POST['telefono_ciudadano'])) {
        echo "<div class='alert alert-danger'>Por favor, complete todos los campos.</div>";
    } else {
        $denuncias = new Denuncias();
        $denuncias->updateDenuncia($_POST['id'], $_POST['titulo'], $_POST['descripcion'], $_POST['ubicacion'], $_POST['estado'], $_POST['ciudadano'], $_POST['telefono_ciudadano']);
        header("location: ../controlador/controlador.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Denuncias</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
        table {
            margin-top: 20px;
        }
        th, td {
            text-align: center;
        }
        .btn-warning, .btn-danger, .btn-success, .btn-secondary {
            margin: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Listado de Denuncias</h1>
        </header>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Descripción</th>
                    <th>Ubicación</th>
                    <th>Estado</th>
                    <th>Ciudadano</th>
                    <th>Teléfono</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $denuncias = new Denuncias();
                $datos = $denuncias->getDenuncias();
                foreach ($datos as $denuncia) {
                    ?>
                    <tr>
                        <td><?php echo $denuncia["id"]; ?></td>
                        <td><?php echo $denuncia["titulo"]; ?></td>
                        <td><?php echo $denuncia["descripcion"]; ?></td>
                        <td><?php echo $denuncia["ubicacion"]; ?></td>
                        <td><?php echo $denuncia["estado"]; ?></td>
                        <td><?php echo $denuncia["ciudadano"]; ?></td>
                        <td><?php echo $denuncia["telefono_ciudadano"]; ?></td>
                        <td>
                            <a class="btn btn-warning update-btn" href="#" data-toggle="modal" data-target="#actualizar" data-index="<?php echo $denuncia["id"]; ?>">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <a class="btn btn-danger" href="controlador.php?accion=eliminar&id=<?php echo $denuncia["id"]; ?>">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <a href="../index.php" class="btn btn-secondary"> <i class="fa fa-arrow-circle-left"></i> Volver</a>

        <div class="modal" id="actualizar">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Actualizar Denuncia</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form action="controlador.php?accion=actualizar" method="post">
                            <input type="hidden" name="id" id="id"/>
                            <div class="form-group">
                                <label for="titulo">Título:</label>
                                <input type="text" name="titulo" id="titulo" class="form-control" required />
                            </div>
                            <div class="form-group">
                                <label for="descripcion">Descripción:</label>
                                <input type="text" name="descripcion" id="descripcion" class="form-control" required />
                            </div>
                            <div class="form-group">
                                <label for="ubicacion">Ubicación:</label>
                                <input type="text" name="ubicacion" id="ubicacion" class="form-control" required />
                            </div>
                            <div class="form-group">
                                <label for="estado">Estado:</label>
                                <select name="estado" id="estado" class="form-control" required>
                                    <option value="pendiente">Pendiente</option>
                                    <option value="en proceso">En proceso</option>
                                    <option value="resuelto">Resuelto</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="ciudadano">Ciudadano:</label>
                                <input type="text" name="ciudadano" id="ciudadano" class="form-control" required />
                            </div>
                            <div class="form-group">
                                <label for="telefono_ciudadano">Teléfono:</label>
                                <input type="text" name="telefono_ciudadano" id="telefono_ciudadano" class="form-control" required />
                            </div>
                            <button type="submit" class="btn btn-success">Actualizar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.update-btn').click(function() {
                var id = $(this).data('index');
                $.ajax({
                    url: 'controlador.php',
                    method: 'GET',
                    data: { accion: 'obtener', id: id },
                    dataType: 'json',
                    success: function(data) {
                        $('#id').val(data.id);
                        $('#titulo').val(data.titulo);
                        $('#descripcion').val(data.descripcion);
                        $('#ubicacion').val(data.ubicacion);
                        $('#estado').val(data.estado);
                        $('#ciudadano').val(data.ciudadano);
                        $('#telefono_ciudadano').val(data.telefono_ciudadano);
                    }
                });
            });
        });
    </script>
</body>
</html>