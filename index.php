<?php
session_start(); // Iniciamos la sesión. Es importante destacar que SESSION START solo debe ser llamado en el índice de la aplicación. Aunque en esta práctica no se requiere un sistema de inicio de sesión, utilizaremos $_SESSION para mostrar mensajes de errores e información relevante durante la ejecución.

define("PATH_CSS", "view/css/"); // Definimos una constante para la ruta de los archivos CSS.
define("PATH_IMG", "view/img/"); // Definimos una constante para la ruta de las imágenes.
define("PATH_JS", "view/js/"); // Definimos una constante para la ruta de los archivos JavaScript.

require_once "controller/MainController.class.php"; // Incluimos el archivo del controlador principal, ya que es necesario para el funcionamiento del índice.
?>

<!DOCTYPE html>
<html lang="es">

<head>
	<title>Clínica Veterinaria</title> <!-- Establecemos el título de la página que aparecerá en la pestaña del navegador. -->

	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" /> <!-- Utilizamos etiquetas meta para asegurar una correcta visualización en dispositivos móviles. -->

	<!-- Archivos CSS de librerías externas -->
	<link rel="stylesheet" href="vendors/bootstrap-4.0.0-dist/css/bootstrap.min.css">

	<!-- Archivos JS de librerías externas -->
	<script src="vendors/jquery-3.5.1/jquery-3.5.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="vendors/bootstrap-4.0.0-dist/js/bootstrap.min.js"></script>

	<!-- Archivos CSS y JS de nuestras propiedades -->
	<link rel="stylesheet" href="<?= PATH_CSS ?>header.css"> <!-- Importamos nuestro archivo de estilos para el encabezado de la página. -->
	<link rel="stylesheet" href="<?= PATH_CSS ?>body.css"> <!-- Importamos nuestro archivo de estilos para el cuerpo de la página. -->
	<script src="<?= PATH_JS ?>general-fn.js"></script> <!-- Importamos nuestro archivo de funciones JavaScript generales. -->

</head>

<body>
	<div class="container">
		<header>
			<a><img src="<?= PATH_IMG ?>vet.png" alt="vet.png"></a> <!-- Mostramos el logotipo de la clínica veterinaria. -->
			<h1>Clínica Veterinaria</h1> <!-- Mostramos el título de la página. -->
		</header>
		<?php
		$controlMain = new MainController();
		$controlMain->processRequest(); // Instanciamos el controlador principal y llamamos al método processRequest para gestionar las solicitudes del usuario.
		?>
	</div>
</body>

</html>