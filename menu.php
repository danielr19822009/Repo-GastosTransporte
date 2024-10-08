<?php
// Llamamos la conexión
require_once("conexion/conexion.php");

// Iniciamos la sesión
session_start();

// Validamos que la sesión está activa y no esté vacía
if (empty($_SESSION["usuario"])) {
    header("location: ../index.php?msn=Debes iniciar sesión");
    exit();
}

// Query de consulta tabla gastos
$sqlgastos = $conectarbd->prepare("
    SELECT 
        gastos.OrigenGasto,
        gastos.DestinoGasto,
        gastos.ValorGasto,
        gastos.FechaGasto,
        usuarios.NombreUsuario,
        usuarios.DocumentoUsuario,
        gastos.Descripcion
    FROM gastos 
    INNER JOIN usuarios ON gastos.id_usuario = usuarios.id_usuario
");

if (!$sqlgastos->execute()) {
    die("Error en la consulta: " . $sqlgastos->error);
}
$gastos = $sqlgastos->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Menu Transporte</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container"><br>
    <!-- Menú barra de navegación -->
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="menu.php">logo empresa</a><br><br>
            </div>
            <div>
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="menu.php">Gastos Transporte<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="?page=agregar">Agregar Gasto</a></li>
                            <li><a href="menu.php?page=vergasto">Ver Gastos</a></li>
                            <li><a href="menu.php?page=modigasto">Modificar Gasto</a></li>
                            <li><a href="menu.php?page=pruebas">pruebas Gasto</a></li>

                        </ul>
                    </li>
                    <li class="dropdown-submenu closed">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="menu.php">Reportes<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-submenu">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="menu.php">Reporte Usuarios<span class="caret"></span></a>
                                <ul class="dropdown">
                                    <li><a href="menu.php?page=reporteusupdf">Pdf</a></li>
                                    <li><a href="menu.php?page=reporteusucsv">Csv</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="menu.php">Reporte Gastos<span class="glyphicon glyphicon-hourglass"></span></a>
                                <ul class="dropdown">
                                    <li><a href="menu.php?page=reportegastpdf">Pdf</a></li>
                                    <li><a href="menu.php?page=reportegastcsv">Csv</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li><a href="#">Faq</a></li>
                    <li><a href="menu.php?page1=client">Clientes</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <?php echo htmlspecialchars($_SESSION['usuario']); ?>
                            <span class="glyphicon glyphicon-list"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="validar/cerrarsession.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
                            <li><a href="menu.php?page=mail"><span class="glyphicon glyphicon-earphone"></span> Ayuda</a></li>
                            <li><a href="menu.php?page=administracion"><span class="glyphicon glyphicon-cog"></span> Administracion</a></li>
                            <li><a href="menu.php?page=reset"><span class="glyphicon glyphicon-repeat"></span> Password</a></li>
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
                require("./paginas/ingresargastos.php");
                break;

                case 'pruebas':
                    require("./paginas/pruebas.php");
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
                include_once("/admin.php");
                break;
            case 'reset':
                include_once("paginas/resetpass.php");
                break;
            case 'mail':
                include_once("./paginas/mail.php");
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
            include_once("/paginas/clientes.php");
        }
        ?>
    </div>
</div>

</body>
</html>
