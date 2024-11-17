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

        if(isset($req->query->Payed) && $req->query->Payed == 'True'){
            $filterPayed = true;
        }
        $orderBy = false;
        if(isset($req->query->orderBy))
            $orderBy = $req->query->orderBy;

        $order = false;
        if(isset($req->query->order))
            $order = $req->query->order;

        $reservations = $this->model->getReservations($filterPayed, $orderBy, $order);
        
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
            return $this->view->response("La reserva con el id=$id no existe", 404);
        }

        // mando la tarea a la vista
        return $this->view->response($task);
    }

    public function create($req, $res) {

        //var_dump($req->body);
        // valido los datos
        if(!$res->user) {
            return $this->view->response("No autorizado", 401);
        }
        
        if (empty($req->body->Date) || empty($req->body->Room_number) || empty($req->body->ID_Client) || !isset($req->body->Payed)) {
            return $this->view->response('Faltan completar datos', 400);
        }

        // obtengo los datos
        $Date = $req->body->Date;       
        $Room_number = $req->body->Room_number;
        if (isset($req->body->Image)){
            $Image = $req->body->Image; 
        } else {
            $Image = " ";
        }
        $ID_Client = $req->body->ID_Client;   
        $Payed = $req->body->Payed;     

        // inserto los datos
        $id = $this->model->insertReservation($Date, $Room_number, $ID_Client, $Payed, $Image);

        if (!$id) {
            return $this->view->response("Error al insertar reserva", 500);
        }

        // buena práctica es devolver el recurso insertado
        $reservation = $this->model->getReservationById($id);
        return $this->view->response($reservation, 201);
    }

    public function update($req, $res) {

        if(!$res->user) {
            return $this->view->response("No autorizado", 401);
        }
        
        $id = $req->params->id;

        // verifico que exista
        $reservation = $this->model->getReservationById($id);
        if (!$reservation) {
            return $this->view->response("La reserva con el id=$id no existe", 404);
        }

         // valido los datos
         if (empty($req->body->Date) || empty($req->body->Room_number) || empty($req->body->ID_Client) || empty($req->body->Payed)) {
            return $this->view->response('Faltan completar datos', 400);
        }

        // obtengo los datos
        $Date = $req->body->Date;       
        $Room_number = $req->body->Room_number;       
        $ID_Client = $req->body->ID_Client;   
        $Payed = $req->body->Payed;
        $Image = " "; 

        // actualiza la tarea
        $this->model->updateReservation($id, $Date, $Room_number, $Image, $ID_Client, $Payed);

        // obtengo la tarea modificada y la devuelvo en la respuesta
        $reservation = $this->model->getReservationById($id);
        $this->view->response($reservation, 200);
    }




}
