<?php

require_once "controller/ControllerInterface.php";

require_once "view/PetView.class.php";

require_once "model/persist/PetDAO.class.php";
require_once "model/persist/OwnerDAO.class.php";
require_once "model/persist/HistoryDAO.class.php";
require_once "model/Pet.class.php";

require_once "util/PetMessage.class.php";
require_once "util/OwnerMessage.class.php";
require_once "util/HistoryMessage.class.php";

require_once "util/PetFormValidation.class.php";
require_once "util/HistoryFormValidation.class.php";

/**
 * Clase que controla las solicitudes de los usuarios enviadas a la sección relacionada con las mascotas del sitio web.
 */
class PetController implements ControllerInterface
{
    private $view;
    private $model;

    /**
     * Instancia Vista y Modelo.
     */
    public function __construct()
    {
        $this->view = new PetView();
        $this->model = new PetDAO();
    }

    /**
     * Este método es llamado por el Controlador Principal. Procesará la solicitud $_POST o $_GET enviada por el usuario.
     */
    public function processRequest()
    {
        // Comprobar GET y POST
        $request = NULL;
        if (isset($_POST["action"])) $request = $_POST["action"];
        else if (isset($_GET["option"])) $request = $_GET["option"];

        switch ($request) {
            case "list_all":
                $this->listAll();
                break;

            case "form_search_pet_by_id":
                $this->formSearchById();
                break;

            case "search_pet_by_id":
                $this->searchById();
                break;

            case "form_add_history":
                $this->formAddHistory();
                break;

            case "add_history":
                $this->addHistory();
                break;

            case "form_modify_pet":
                $this->formModify();
                break;

            case "update_pet":
                $this->modify();
                break;

            case "delete_pet":
                $this->delete();
                break;

            case "form_add_pet":
                $this->formAddPet();
                break;

            case "add_pet":
                $this->add();
                break;

            default:
                $this->view->display();
        }
    }

    /**
     * Muestra todas las mascotas en una tabla usando la vista. Las mascotas se recuperaron usando el modelo.
     */
    public function listAll()
    {
        $pets = $this->model->listAll();

        if (!empty($pets)) $_SESSION["info"][]  = PetMessage::SELECT_SUCCESS;
        else               $_SESSION["error"][] = PetMessage::SELECT_ERROR;

        $this->view->display("view/form/PetList.php", $pets);
    }

    public function formSearchById()
    {
        $this->view->display("view/form/PetFormSearchById.php");
    }


    /**
     * Muestra una sola mascota por id.
     */
    public function searchById()
    {
        $id = $_POST["id"];

        $pet = null;
        $owner = null;
        $history = array();

        if ($id == null) {
            $_SESSION["error"][] = PetMessage::FORM_EMPTY_ID;
        } else {
            // Buscar mascota en la BD
            $pet = $this->model->searchById($id);

            if (!isset($pet)) $_SESSION["error"][] = PetMessage::SELECT_ERROR;
            else {
                $_SESSION["info"][]  = PetMessage::SELECT_SUCCESS;

                // Buscar propietario de la mascota en la BD
                $ownerModel = new OwnerDAO();
                $owner = $ownerModel->searchById($pet->getIdOwner());
                if (!empty($owner)) $_SESSION["info"][]  = OwnerMessage::SELECT_SUCCESS;
                else                $_SESSION["error"][] = OwnerMessage::SELECT_ERROR;

                // BUuscar historial de la mascota en la BD
                $historyModel = new HistoryDAO();
                $history = $historyModel->searchByPetId($id);
                if (!empty($history)) $_SESSION["info"][]  = HistoryMessage::SELECT_SUCCESS;
                else                  $_SESSION["error"][] = HistoryMessage::SELECT_ERROR;
            }
        }

        $item = array($pet, $owner, $history);

        // Mostrar formulario nuevamente con los parámetros del propietario y mensajes de ÉXITO/ERROR
        $this->view->display("view/form/PetDetail.php", $item);
    }

    /**
     * Muestra el formulario para añadir un nuevo historial, utilizando la vista.
     **/
    public function formAddHistory()
    {
        $this->view->display("view/form/HistoryFormInsert.php");
    }

    /**
     * Añadir nuevo historial.
     * Accede a la entrada del formulario del usuario a través de $_POST y accede a la base de datos a través del DAO de Historial. Luego muestra el resultado utilizando la vista.
     **/
    public function addHistory()
    {
        // Acceso al modelo del historial
        $historyModel = new HistoryDAO();

        // Validar entrada para la inserción (solo requiere idMascota y fecha)
        $historyInput = HistoryFormValidation::checkData(HistoryFormValidation::INSERT);


        if (empty($_SESSION["error"])) // Si la validación no tuvo errores...
        {
            // Comprobar si la mascota existe
            $petFound = $this->model->searchById($historyInput->getIdPet());
            if (!$petFound) $_SESSION["error"][] = PetMessage::ID_DOES_NOT_EXIST;
            else {
                // Añadirhistoriala la BD
                $success = $historyModel->add($historyInput);

                if ($success) $_SESSION["info"][]  = HistoryMessage::INSERT_SUCCESS;
                else          $_SESSION["error"][] = HistoryMessage::INSERT_ERROR;
            }
        }

        // Mostrar formulario nuevamente con los parámetros del propietario y mensajes de ÉXITO/ERROR
        $this->view->display("view/form/HistoryFormInsert.php", $historyInput);
    }

    /**
     * Hacer clic en el botón "modificar" en la lista de mascotas. Mostrar un formulario.
     */
    public function formModify()
    {
        $petInput = PetFormValidation::checkData(PetFormValidation::SELECT);
        $petFinal = $petInput;

        if (empty($_SESSION["error"])) {
            // Seleccionar mascota
            $petFound = $this->model->searchById($petInput->getId());
            if ($petFound == NULL) {
                $_SESSION["error"][] = PetMessage::ID_DOES_NOT_EXIST;
            } else {
                $petFinal = $petFound;
            }
        }

        $this->view->display("view/form/PetFormUpdate.php", $petFinal);
    }

    /**
     * Modificar mascota.
     * Accede a la entrada del formulario del usuario a través de $_POST, y accede a la base de datos a través del DAO. Luego muestra el resultado utilizando la vista.
     */
    public function modify()
    {
        // Validar entrada
        $petInput = PetFormValidation::checkData(PetFormValidation::UPDATE);
        $petFinal = $petInput;

        if (empty($_SESSION["error"])) {
            // Comprobar si la mascota existe
            $petFound = $this->model->searchById($petInput->getId());
            if ($petFound == NULL) {
                $_SESSION["error"][] = PetMessage::ID_DOES_NOT_EXIST;
            } else {
                // Comprobar si el propietario existe
                $ownerModel = new OwnerDAO();
                $ownerFound = $ownerModel->searchById($petInput->getIdOwner());
                if ($ownerFound == NULL) {
                    $_SESSION["error"][] = OwnerMessage::NIF_DOES_NOT_EXIST;
                } else {
                    $petFinal = $petFound;
                    $petFinal->setIdOwner($petInput->getIdOwner());
                    $petFinal->setNames($petInput->getNames());

                    // Actualizar macota en la BD
                    $success = $this->model->modify($petFinal);
                    if ($success) $_SESSION["info"][]  = PetMessage::UPDATE_SUCCESS;
                    else          $_SESSION["error"][] = PetMessage::UPDATE_ERROR;
                }
            }
        }

        // Mostrar formulario nuevamente con los parámetros del propietario y mensajes de ÉXITO/ERROR
        $this->view->display("view/form/PetFormUpdate.php", $petFinal);
    }

    //-----------------------------------------------------------------------------
    // Function ADD
    //-----------------------------------------------------------------------------

    public function formAddPet()
    {
        $this->view->display("view/form/PetFormAdd.php");
    }

    /**
     * Añadir nueva mascota.
     * Accede a la entrada del formulario del usuario a través de $_POST, y accede a la base de datos a través del DAO. Luego muestra el resultado utilizando la vista.
     **/

    public function add()
    {
        $requiredFields = array("nifpropietario", "nom");

        // Validar mascotas
        $item = PetFormValidation::checkData($requiredFields);

        if (empty($_SESSION["error"])) // Si la validación no tuvo errores...
        {
            $success = $this->model->add($item);

            if ($success) {
                // Mascota añadida exitosamente, redirige o muestra un mensaje de éxito
                header('Location: index.php?menu=pet&option=list_all');
                exit();
            } else {
                // Error al añadir mascota, muestra un mensaje de error
                echo "Error al añadir mascota.";
            }
        }

        // Mostrar formulario nuevamente con los parámetros del propietario y mensajes de ÉXITO/ERROR
        $this->view->display("../view/form/PetList.php");
    }

    //-----------------------------------------------------------------------------
    // Function DELETE
    //-----------------------------------------------------------------------------

    /**
     * Eliminar mascota.
     * Accede a la entrada del formulario del usuario a través de $_POST, y accede a la base de datos a través del DAO. Luego muestra el resultado utilizando la vista.
     */
    public function delete()
    {
        // Validar ID
        $id = isset($_POST['id']) ? $_POST['id'] : null;

        if (empty($id)) {
            $_SESSION["error"][] = "Se requiere ID para eliminar.";
        } else {
            // Eliminar mascota de la BD
            $success = $this->model->delete($id);

            if ($success) {
                $_SESSION["info"][] = PetMessage::DELETE_SUCCESS;
            } else {
                $_SESSION["error"][] = PetMessage::DELETE_ERROR;
            }
        }

        // Redirigir a listar todas las mascotas después de eliminar
        $this->listAll();
    }
}
