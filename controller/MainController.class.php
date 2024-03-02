<?php

require_once "controller/OwnerController.class.php";
require_once "controller/PetController.class.php";
require_once "controller/HistoryController.class.php";

/**
 * Clase que controla las solicitudes de los usuarios enviadas a la sección principal del sitio web.
 */
class MainController
{
	/**
	 * Este método es llamado por index.php y es el primer método llamado en la aplicación.
	 * Muestra el Menú Principal y llama al método processRequest() de un controlador dependiendo de la variable $_GET (parámetro de menú de la URL).
	 */
	public function processRequest()
	{
		// Siempre mostrar el Menú Principal:
		include("view/menu/MainMenu.html");

		// Establecer $request dependiendo de la variable $_GET (parámetro de menú de la URL):

		if (isset($_GET["menu"])) $request = $_GET["menu"];
		else $request = NULL;

		// Procesar la $request llamando al método processRequest() de un controlador:

		switch ($request) {
			case "owner": // URL: [...]/index.php?menu=owner
				$ownerController = new OwnerController();
				$ownerController->processRequest();
				break;

			case "pet": // URL: [...]/index.php?menu=pet
				$petController = new PetController();
				$petController->processRequest();
				break;

			case "history": // URL: [...]/index.php?menu=history
				$historyController = new HistoryController();
				$historyController->processRequest();
				break;
		}
	}
}
