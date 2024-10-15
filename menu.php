<?php
// Llamamos la conexión
require_once("./conexion/conexion.php");

session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['usuario'])) {
    header("Location: index.html");
    exit();
}

// Query de consulta tabla gastos
$sqlgastos = $conectarbd->prepare("
    SELECT 
        transporte.origen,
        transporte.destino,
        transporte.valor,
        transporte.fecha,
        usuarios.nomb_usuario,
        usuarios.doc_usuario,
        transporte.descripcion
    FROM transporte 
    INNER JOIN usuarios ON transporte.cod_usuario = usuarios.cod_usuario
");

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Menu Transporte</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container"><br>
        <!-- Menú barra de navegación -->
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="menu.php">Logo Empresa</a>
                </div>
                <div>
                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Gastos Transporte <span
                                    class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="?page=agregar">Agregar Gasto</a></li>
                                <li><a href="?page=vergasto">Ver Gastos</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Reportes <span
                                    class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-submenu">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Reporte Usuarios <span
                                            class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="?page=reporteusupdf">PDF</a></li>
                                        <li><a href="?page=reporteusucsv">CSV</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Reporte Gastos <span
                                            class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="?page=reportegastpdf">PDF</a></li>
                                        <li><a href="?page=reportegastcsv">CSV</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="?page1=client">Clientes</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-haspopup="true" aria-expanded="false">
            <span class="glyphicon glyphicon-user"></span>
            <span><?php echo htmlspecialchars($_SESSION['usuario']); ?></span>
            <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
            <li>
                <a href="validar/cerrarsession.php">
                    <span class="glyphicon glyphicon-log-out"></span> Cerrar sesión
                </a>
            </li>
            <li role="separator" class="divider"></li>
            <li>
                <a href="?page=mail">
                    <span class="glyphicon glyphicon-earphone"></span> Ayuda
                </a>
            </li>
            <li>
                <a href="?page=administracion">
                    <span class="glyphicon glyphicon-cog"></span> Administración
                </a>
            </li>
            <li>
                <a href="?page=reset">
                    <span class="glyphicon glyphicon-repeat"></span> Cambiar Contraseña
                </a>
            </li>
        </ul>
    </li>
</ul>


                </div>
            </div>
        </nav><br><br>

        <!-- Contenedor de hojas -->
        <div class="jumbotron">
            <?php
            $pagina = $_REQUEST["page"] ?? '';

            switch ($pagina) {
                case 'agregar':
                    require("./paginas/addgasto.php");
                    break;
                case 'modigasto':
                    include_once("./paginas/buscargasto.php");
                    break;
                case 'vergasto':
                    include_once("./paginas/vergastos.php");
                    break;
                case 'reporteusupdf':
                    include_once('./paginas/repusupdf.php');
                    break;
                case 'reportegastpdf':
                    include_once('./paginas/repgaspdf.php');
                    break;
                case 'reportegastcsv':
                    include_once('./paginas/repgascsv.php');
                    break;
                case 'administracion':

                    break;
                case 'reset':
                    include_once("paginas/resetpass.php");
                    break;
                case 'mail':
                    include_once("./paginas/admin.php");
                    break;
                default:
                    include_once("./paginas/slader.php");
                    break;
            }
            ?>
        </div>

        <div id="clientes" style="margin: auto 40%;">
            <?php
            $pag = $_REQUEST["page1"] ?? '';

            if (!empty($pag)) {
                include_once("./paginas/clientes.php");
            }
            ?>
        </div>
    </div>

</body>

</html>