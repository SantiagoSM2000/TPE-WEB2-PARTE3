<?php

require_once "Model.php";

class ReservationsModel extends Model{

    public function __construct(){//Constructor de la clase
        parent::__construct();//Se invoca al constructor de la clase padre (Model)
    }

    public function getReservations($filterPayed = false, $orderBy = false){//Función para conseguir un arreglo con todas las reservas
        $query = "SELECT * FROM reservations";

        //Solicito las reservas de la base de datos
        
        //TENGO QUE FILTRAR POR DISTINTAS COSAS Y PASARLE EL VALOR
        if ($filterPayed) {
            $query .= " WHERE Payed = 1";
        }

        if ($orderBy){
            switch($orderBy) {
                case "ID_Reservation":
                    $query .= ' ORDER BY ID_Reservation';
                    break;
                case "ID_Client":
                    $query .= ' ORDER BY ID_Client';
                    break;
                case "Room_number":
                    $query .= ' ORDER BY Room_number';
                    break;
            }
        }
        $query = $this->db->prepare($query);
        $query->execute();
        $reservations = $query->fetchAll(PDO::FETCH_OBJ);
    
        //Devuelvo el arreglo con las reservas
        return $reservations;
    }

    public function getReservationById($id){//Función para devolver una reserva según el id recibido

        //Solicito la reserva que coincida en la base de datos con el id que me pasaron 
        $query = $this->db->prepare("SELECT * FROM reservations WHERE ID_Reservation = ?");
        $query->execute([$id]);
        $reservation = $query->fetch(PDO::FETCH_OBJ);
    
        //Devuelvo la reserva con el ID solicitado
        return $reservation;
    }

    public function deleteReservation($id){//Función que elimina la reserva correspondiente al id

        //Elimino la reserva que coincida en la base de datos con el id que me pasaron
        $query = $this->db->prepare("DELETE FROM reservations  WHERE ID_Reservation = ?");
        $query->execute([$id]);
    }

    public function insertReservation($date, $room_number, $ID_Client, $Payed){//Función que inserta una reserva con los parámetros recibidos
        
        //Inserto la reserva con los datos del usuario 
        $id = NULL;
        $query = $this->db->prepare("INSERT INTO reservations (ID_Reservation, Date, Room_number, Image, ID_Client) VALUES (?, ?, ?, ?, ?)");
        $query->execute([$id, $date, $room_number, $ID_Client, $Payed]);
    
        return $this->db->lastinsertId();
    }

    public function existsReservation($id){//Función que devuelve true o false dependiendo de si existe la reserva con el id recibido

        //Busco la reserva que coincida con el id y si existe retorno true
        $query = $this->db->prepare("SELECT * FROM reservations WHERE ID_Reservation = ?");
        $query->execute([$id]);
        $reservation = $query->fetch(PDO::FETCH_OBJ);
    
        if($reservation){
            return true;
        } 
        return false;
    }

    public function updateReservation($id, $date, $room_number, $image, $ID_Client){//Función para actualizar la reserva con los parámetros recibidos

        //Actualizo la reserva con los datos del usuario 
        $query = $this->db->prepare("UPDATE reservations SET Date=?, Room_number=?, Image=?, ID_Client=? WHERE ID_Reservation=?");
        $query->execute([$date, $room_number, $image, $ID_Client, $id]);
    }
}
