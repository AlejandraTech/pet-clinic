<?php
ob_start();
require_once "controller/ControllerInterface.php";

require_once "view/HistoryView.class.php";

require_once "model/persist/HistoryDAO.class.php";
require_once "model/persist/OwnerDAO.class.php";
require_once "model/persist/PetDAO.class.php";
require_once "model/History.class.php";

/**
 * Clase que controla las solicitudes de los usuarios enviadas a la sección relacionada con las mascotas del sitio web.
 */
class HistoryController implements ControllerInterface
{
    private $view;
    private $model;

    /**
     * Instancia la Vista y el Modelo.
     */
    public function __construct()
    {
        $this->view = new HistoryView();
        $this->model = new HistoryDAO();
    }

    /**
     * Este método es llamado por el Controlador Principal. Procesará la solicitud $_POST o $_GET enviada por el usuario.
     */
    public function processRequest()
    {
        // Comprobamos $_GET y $_POST
        $request = NULL;
        if (isset($_POST["action"])) $request = $_POST["action"]; // Existe el parámetro POST "action" (se hizo clic en un botón de envío) --> Asignamos el valor a $request
        else if (isset($_GET["option"])) $request = $_GET["option"]; // Existe el parámetro URL "option" --> Asignamos el valor a $request (el usuario está en una subpágina específica)

        switch ($request) {

            case "list_all":
                $this->listAll();
                break;

                // Por defecto
            default:
                $this->view->display();
        }
    }

    /**
     * Lista todas las historias clínicas de mascotas.
     */
    public function listAll()
    {
        $history = $this->model->listAll(); // Recopilamos los datos del DAO de historias clínicas.

        if (!empty($history)) $_SESSION["info"][]  = HistoryMessage::SELECT_SUCCESS; // Si hay historias clínicas, agregamos un mensaje de éxito a la sesión.
        else               $_SESSION["error"][] = HistoryMessage::SELECT_ERROR; // Si no hay historias clínicas, agregamos un mensaje de error a la sesión.

        $this->view->display("view/form/HistoryPet.php", $history); // Mostramos los datos.
    }

    //-----------------------------------------------------------------------------
    // Métodos no implementados
    //-----------------------------------------------------------------------------

    public function searchById()
    {
    }

    public function modify()
    {
    }

    public function add()
    {
    }

    public function delete()
    {
    }
}
