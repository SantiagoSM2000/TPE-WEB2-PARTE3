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
        $filtrarFinalizadas = false;
        // obtengo las tareas de la DB
        if(isset($req->query->ID_Cliente) && $req->query->ID_Cliente == 'false')
            $filtrarFinalizadas = true;
        
        $orderBy = false;
        if(isset($req->query->orderBy))
            $orderBy = $req->query->orderBy;

        $reservations = $this->model->getReservations();//$filtrarFinalizadas, $orderBy);
        
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

}
