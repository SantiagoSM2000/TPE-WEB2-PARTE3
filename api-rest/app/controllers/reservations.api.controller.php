<?php
require_once 'app\models\reservations.model.php';
require_once 'app\views\json.view.php';

class ReservationsApiController {
    private $model;
    private $view;

    public function __construct() {
        $this->model = new ReservationsModel();
        $this->view = new JSONView();
    }

    // /api/tareas
    public function getAll($req, $res) {
        // obtengo las tareas de la DB
        $filterPayed = false;

        if(isset($req->query->Payed) && $req->query->Payed == 'true'){
            $filterPayed = true;
        }
        $orderBy = false;
        if(isset($req->query->orderBy))
            $orderBy = $req->query->orderBy;

        $reservations = $this->model->getReservations($filterPayed, $orderBy);
        
        // mando las tareas a la vista
        return $this->view->response($reservations);
    }

    // /api/tareas/:id
    public function get($req, $res) {
        // obtengo el id de la tarea desde la ruta
        $id = $req->params->id;

        // obtengo la tarea de la DB
        $task = $this->model->getReservationById($id);

        if(!$task) {
            return $this->view->response("La tarea con el id=$id no existe", 404);
        }

        // mando la tarea a la vista
        return $this->view->response($task);
    }

    public function create($req, $res) {

        //var_dump($req->body);
        // valido los datos
        //REVISAR CON LAS CLASES DE NICO O HACERLO ARREGLO
        if (empty($req->body["Date"]) || empty($req->body["Room"]) || empty($req->body->ID_Client) || empty($req->body->Payed)) {
            return $this->view->response('Faltan completar datos', 400);
        }

        // obtengo los datos
        $Date = $req->body->Date;       
        $Room_number = $req->body->Room_number;       
        $ID_Client = $req->body->ID_Client;   
        $Payed = $req->body->Payed;     

        // inserto los datos
        $id = $this->model->insertarReservation($Date, $Room_number, $ID_Client, $Payed);

        if (!$id) {
            return $this->view->response("Error al insertar tarea", 500);
        }

        // buena práctica es devolver el recurso insertado
        $reservation = $this->model->getReservationById($id);
        return $this->view->response($reservation, 201);
    }


}
