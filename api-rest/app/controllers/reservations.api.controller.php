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

    // /api/reservations
    public function getAll($req, $res) {
        
        $payed = false;
        if(isset($req->query->payed)){
            $payed = $req->query->payed;
        }

        $orderBy = false;
        if(isset($req->query->orderBy)){
            $orderBy = $req->query->orderBy;
        }
            

        $order = false;
        if(isset($req->query->order) && isset($req->query->orderBy))
            $order = $req->query->order;
        else if (empty($req->query->orderBy) && !empty($req->query->order)){
            return $this->view->response("Falta ordenar por un atributo", 400);
        }

        $reservations = $this->model->getReservations($payed, $orderBy, $order);

        if (!$reservations){
            return $this->view->response("Valor de query param de orderBy incorrecto", 404);
        }

        $page = false;
        $amount = false;

        // Verifico que estén seteados los dos parametros para la paginacion
        if(isset($req->query->page) && isset($req->query->amount)){

            // Obtengo esos parametros
            $page = $req->query->page;
            $amount = $req->query->amount;
            
            // Si ambos son mayores a cero entonces empiezo con las operaciones matemáticas para conseguir el rango de posiciones del arreglo
            if ($page > 0 && $amount > 0){
                $paginatedReservations = [];
                $finalIndex = $page * $amount;
                $initialIndex = $finalIndex - $amount;

                // Cuento la cantidad de reservas en el arreglo
                $reservationsSize = count($reservations);
                
                // Me aseguro de que el indice final no sea superior a la cantidad de reservas de ser mayor hago que se vuelva la cantidad de reservas
                if ($finalIndex > $reservationsSize){
                    $finalIndex = $reservationsSize;
                }

                // Verifico que el inicio no sea mayor al tamaño del arreglo de reservas, de serlo entonces devuelvo un error en la vista
                if ($initialIndex > $reservationsSize){
                    return $this->view->response("No existen más reservas", 404);
                }
                
                // Recorro el arreglo de reservas desde la posicion inicial hasta la final según los parámetros que me hayan pasado
                for ($index = $initialIndex; $index < $finalIndex; $index++){
                    array_push($paginatedReservations, $reservations[$index]);
                }
                return $this->view->response($paginatedReservations);
            }
            else{
                // Si me envían valores negativos o 0 entonces devuelvo error
                return $this->view->response("No es una combinación de paginado válida", 400);
            }
        }

        // Mando las reservas a la vista
        return $this->view->response($reservations);
    }

    // /api/reservations/:id
    public function get($req, $res) {
        // Obtengo el id de la reserva desde la ruta
        $id = $req->params->id;

        // Obtengo la reserva de la base de datos
        $reservation = $this->model->getReservationById($id);

        if(!$reservation) {
            return $this->view->response("La reserva con el id=$id no existe", 404);
        }

        // Mando la reserva a la vista
        return $this->view->response($reservation);
    }

    // /api/reservations (POST)
    public function create($req, $res) {

        // Verifico que el usuario esté autorizado con el token
        if(!$res->user) {
            return $this->view->response("No autorizado", 401);
        }
        
        if (empty($req->body->Date) || empty($req->body->Room_number) || empty($req->body->ID_Client) || !isset($req->body->Payed)) {
            return $this->view->response('Faltan completar datos', 400);
        }

        // Obtengo los datos
        $Date = $req->body->Date;       
        $Room_number = $req->body->Room_number;
        if (isset($req->body->Image)){
            $Image = $req->body->Image; 
        } else {
            $Image = " ";
        }
        $ID_Client = $req->body->ID_Client;   
        $Payed = $req->body->Payed;     

        // Inserto la reserva
        $id = $this->model->insertReservation($Date, $Room_number, $ID_Client, $Payed, $Image);

        if (!$id) {
            return $this->view->response("Error al insertar reserva", 500);
        }

        // Obtengo la reserva y la devuelvo en la respuesta
        $reservation = $this->model->getReservationById($id);
        return $this->view->response($reservation, 201);
    }

    // /api/reservations/:id (PUT)
    public function update($req, $res) {

        // Verifico que el usuario esté autorizado con el token
        if(!$res->user) {
            return $this->view->response("No autorizado", 401);
        }
        
        // Obtengo el id de la reserva desde la ruta
        $id = $req->params->id;

        // Verifico que exista
        $reservation = $this->model->getReservationById($id);
        if (!$reservation) {
            return $this->view->response("La reserva con el id=$id no existe", 404);
        }

         // Valido los datos
         if (empty($req->body->Date) || empty($req->body->Room_number) || empty($req->body->ID_Client) || !isset($req->body->Payed)) {
            return $this->view->response('Faltan completar datos', 400);
        }

        // Obtengo los datos
        $Date = $req->body->Date;       
        $Room_number = $req->body->Room_number;       
        $ID_Client = $req->body->ID_Client;   
        $Payed = $req->body->Payed;
        if (isset($req->body->Image)){
            $Image = $req->body->Image; 
        } else {
            $Image = " ";
        }

        // Actualiza la reserva
        $this->model->updateReservation($id, $Date, $Room_number, $Image, $ID_Client, $Payed);

        // Obtengo la reserva modificada y la devuelvo en la respuesta
        $reservation = $this->model->getReservationById($id);
        $this->view->response($reservation, 200);
    }

    // api/reservas/:id (DELETE)
    public function delete($req, $res) {

        // Verifico que el usuario esté autorizado con el token
        if(!$res->user) {
            return $this->view->response("No autorizado", 401);
        }
        
        // Obtengo el id de la reserva desde la ruta
        $id = $req->params->id;

        // Verifico que exista
        $reservation = $this->model->getReservationById($id);
        if (!$reservation) {
            return $this->view->response("La reserva con el id=$id no existe", 404);
        }

        // Elimino la reserva y devuelvo que la reserva se borró con éxito
        $this->model->deleteReservation($id);
        $this->view->response("La reserva con el id=$id se eliminó con éxito");
    }



}
