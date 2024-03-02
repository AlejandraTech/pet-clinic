<?php

require_once "controller/ControllerInterface.php";

require_once "view/OwnerView.class.php";

require_once "model/persist/OwnerDAO.class.php";
require_once "model/persist/PetDAO.class.php";
require_once "model/Owner.class.php";

require_once "util/OwnerMessage.class.php";
require_once "util/OwnerFormValidation.class.php";

/**
 * Clase que controla las solicitudes de los usuarios enviadas a la sección relacionada con los propietarios en el sitio web.
 */
class OwnerController implements ControllerInterface
{
    private $view;
    private $model;
    private $petModel;

    /**
     * Instancia Vista y Modelo.
     */
    public function __construct()
    {
        $this->view = new OwnerView();
        $this->model = new OwnerDAO();
        $this->petModel = new PetDAO();
    }

    /**
     * Este método es llamado por el Controlador Principal. Procesará la solicitud $_POST o $_GET enviada por el usuario.
     */
    public function processRequest()
    {
        // Establecer $request dependiendo de las variables $_POST o $_GET (acción de botón de envío de formulario / parámetro de opción de URL):
        if (isset($_POST["action"])) $request = $_POST["action"];
        else if (isset($_GET["option"])) $request = $_GET["option"];
        else $request = NULL;

        // Procesar la $request llamando a un método en esta clase:
        switch ($request) {
                // Solicitudes $_GET:
            case "list_all":
                $this->listAll();
                break;

            case "form_search_pet_by_owner":
                $this->formSearchPetByOwner();
                break;

            case "form_find_owner_to_update":
                $this->formFindOwnerToUpdate();
                break;

                // Solicitudes $_POST:
            case "find_owner_to_update":
                $this->findOwnerToUpdate();
                break;

            case "update_owner":
                $this->modify();
                break;

            case "delete_owner":
                $this->delete();
                break;

            case "search_pet_by_owner":
                $this->searchPetByOwner();
                break;

            case "form_add_owner":
                $this->formAddOwner();
                break;

            case "add_owner":
                $this->add();
                break;

            default:
                // Mostrar vista predeterminada para la sección de propietarios del sitio web:
                $this->view->display();
        }
    }

    /**
     * Muestra todos los propietarios en una tabla, utilizando la vista. Los propietarios fueron recuperados utilizando el modelo.
     */
    public function listAll()
    {
        $owners = $this->model->listAll();

        if (!empty($owners)) $_SESSION["info"][]  = OwnerMessage::SELECT_SUCCESS;
        else                 $_SESSION["error"][] = OwnerMessage::SELECT_ERROR;

        $this->view->display("view/form/OwnerList.php", $owners);
    }

    /**
     * Muestra el formulario para buscar mascotas por el NIF del propietario, utilizando la vista.
     **/
    public function formSearchPetByOwner()
    {
        $this->view->display("view/form/PetFormSearchByOwner.php");
    }

    /**
     * Muestra el formulario para modificar un propietario, utilizando la vista.
     **/
    public function formFindOwnerToUpdate()
    {
        $this->view->display("view/form/OwnerFormSelect.php");
    }

    /**
     * Busca propietario para modificar.
     * Accede a la entrada del formulario del usuario a través de $_POST y accede a la base de datos a través del DAO. Luego muestra el resultado utilizando la vista.
     */
    public function findOwnerToUpdate()
    {
        // Validar NIF del propietario
        $owner = OwnerFormValidation::checkData(OwnerFormValidation::SELECT);

        if (empty($_SESSION["error"])) // Si la validación no tuvo errores...
        {
            // Comprovar si el propietario ya existe
            $ownerFound = $this->model->searchById($owner->getNif());
            if ($ownerFound == NULL) {
                $_SESSION["error"][] = OwnerMessage::NIF_DOES_NOT_EXIST;
            } else {
                // Actualizar el propietarion en la BD
                $success = $this->model->modify($owner);
                if ($success) $_SESSION["info"][]  = OwnerMessage::UPDATE_SUCCESS;
                else          $_SESSION["error"][] = OwnerMessage::UPDATE_ERROR;
            }
        }

        // Mostrar formulario nuevamente con los parámetros del propietario y mensajes de ÉXITO/ERROR
        if (empty($_SESSION["error"])) $this->view->display("view/form/OwnerFormUpdate.php", $ownerFound);
        else $this->view->display("view/form/OwnerFormSelect.php", $owner);
    }

    /**
     * Modifica propietario.
     * Accede a la entrada del formulario del usuario a través de $_POST y accede a la base de datos a través del DAO. Luego muestra el resultado utilizando la vista.
     */
    public function modify()
    {
        // Validar entrada
        $ownerInput = OwnerFormValidation::checkData(OwnerFormValidation::UPDATE);
        $ownerFinal = $ownerInput;

        if (empty($_SESSION["error"])) // Si la validación no tuvo errores...
        {
            // Comprovar si el propietario ya existe
            $ownerFound = $this->model->searchById($ownerInput->getNif());
            if ($ownerFound == NULL) {
                $_SESSION["error"][] = OwnerMessage::NIF_DOES_NOT_EXIST;
            } else {
                $ownerFinal = $ownerFound;
                $ownerFinal->setEmail($ownerInput->getEmail());
                $ownerFinal->setPhone($ownerInput->getPhone());

                // Actualizar el propietarion en la BD
                $success = $this->model->modify($ownerFinal);
                if ($success) $_SESSION["info"][]  = OwnerMessage::UPDATE_SUCCESS;
                else          $_SESSION["error"][] = OwnerMessage::UPDATE_ERROR;
            }
        }

        // Mostrar formulario nuevamente con los parámetros del propietario y mensajes de ÉXITO/ERROR
        $this->view->display("view/form/OwnerFormUpdate.php", $ownerFinal);
    }

    public function searchPetByOwner()
    {
        $nif = $_POST["nif"];

        $item = null;
        if ($nif == null) {
            $_SESSION["error"][] = OwnerMessage::FORM_EMPTY_NIF;
        } else {
            // Buscar item en la BD
            $modelPet = new PetDAO();
            $item = $modelPet->searchByOwnerNif($nif);

            if (isset($item[0])) $_SESSION["info"][]  = OwnerMessage::SELECT_SUCCESS;
            else                 $_SESSION["error"][] = OwnerMessage::SELECT_ERROR;
        }

        // Mostrar formulario nuevamente con los parámetros del propietario y mensajes de ÉXITO/ERROR
        $this->view->display("view/form/PetList.php", $item);
    }

    //-----------------------------------------------------------------------------
    // Function ADD
    //-----------------------------------------------------------------------------

    public function formAddOwner()
    {
        $this->view->display("view/form/OwnerFormAdd.php");
    }

    /**
     * Agrega nuevo propietario.
     * Accede a la entrada del formulario del usuario a través de $_POST y accede a la base de datos a través del DAO. Luego muestra el resultado utilizando la vista.
     **/
    public function add()
    {
        $requiredFields = array("nif", "name", "email", "phone");

        // Validar item
        $item = OwnerFormValidation::checkData($requiredFields);

        if (empty($_SESSION["error"])) // Validación sin error
        {
            $success = $this->model->add($item);

            if ($success) {
                // Redirigir a listar todos los los propietarios
                header('Location: index.php?menu=owner&option=list_all');
                exit();
            } else {
                // Error al añadir propietario, muestra un mensaje de error
                echo "Error al añadir propietario.";
            }
        }

        // Mostrar formulario nuevamente con los parámetros del propietario y mensajes de ÉXITO/ERROR
        $this->view->display("view/form/OwnerFormAdd.php");
    }

    //-----------------------------------------------------------------------------
    // Function DELETE
    //-----------------------------------------------------------------------------
    /**
     * Elimina propietario.
     * Accede a la entrada del formulario del usuario a través de $_POST y accede a la base de datos a través del DAO. Luego muestra el resultado utilizando la vista.
     */
    public function delete()
    {
        // Validar NIF
        $nif = isset($_POST['nif']) ? $_POST['nif'] : null;

        if (empty($nif)) {
            $_SESSION["error"][] = "NIF is required for deletion.";
        } else {
            // Antes de eliminar al propietario, eliminar las mascotas relacionadas
            $this->deletePetsByOwner($nif);

            // Eliminar el propietario de la BD
            $success = $this->model->delete($nif);

            if ($success) {
                $_SESSION["info"][] = OwnerMessage::DELETE_SUCCESS;
            } else {
                $_SESSION["error"][] = OwnerMessage::DELETE_ERROR;
            }
        }

        // Redirigir a listar todos los los propietarios depués de eliminar
        $this->listAll();
    }

    // Función auxiliar para eliminar mascotas asociadas con el propietario
    private function deletePetsByOwner($nif)
    {
        // Suponiendo que $this->model es una instancia de OwnerDAO
        $ownerDAO = $this->model;

        // Recuperar mascotas asociadas con el propietario
        $petsToDelete = $ownerDAO->getPetsByOwner($nif);

        // Eliminar cada mascota
        foreach ($petsToDelete as $pet) {
            $this->deletePet($pet->getId());
        }
    }

    // Función auxiliar para eliminar una mascota por su ID
    private function deletePet($id)
    {
        // Suponiendo que $this->petModel es una instancia de PetDAO
        $petDAO = $this->petModel;

        // Eliminar la mascota
        $petDAO->delete($id);
    }

    //-----------------------------------------------------------------------------
    // Métodos no implementados
    //-----------------------------------------------------------------------------

    public function searchById()
    {
    }
}
