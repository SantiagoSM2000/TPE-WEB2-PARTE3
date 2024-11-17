# Trabajo Espeical Web-2 Tercera Parte

## Integrante:

- Santiago San Martín

---

## Descripción

API Rest RESTful desarrollada para la tercer entrega del trabajo práctico especial de la materia de WEB 2, está conectada a una base de datos de reservas de un hotel y permite conseguir todas las reservas, una reserva mediante su id, crear una resvera, modificar una reserva mediante el id, eliminar una reserva por id y las funciones de creacion, edicion y eliminación están resguardadas por autenticación.
---

## Tabla de Ruteo:

|        URL       |Verbo|       Controlador         |Método    |
|------------------|-----|---------------------------|----------|
|reservations      |GET  |reservationsApiController  |getAll    |
|reservations/:id  |GET  |reservationsApiController  |get       |
|reservations      |POST |reservationsApiController  |create    |
|reservations/:id  |PUT  |reservationsApiController  |update    |
|usuarios/token    |GET  |userApiController          |getToken  |


GET

Devuelve todas las reservas de la base de datos, se pueden ordenar por distintos atributos 

``` http
GET REST/api/reservations
```
---

GET/ID

``` http
GET REST/api/reservations
```
---

POST

Crea una reserva al enviarse en el body de la peticion 4 parametros en formato json, Date : formato fecha, Room_number :int, ID_Client :int, Payed :boolean (1 o 0) en el caso de faltar alguno de los parametros la api respondera con el codigo de error 400

``` http
POST REST/api/reservations
```
---

PUT

Modifica una reserva seleccionada por un id, de no existir devuelven un error 400 para poder editar la reserva correctamente se debe enviar en el body 4 parametros en formato json, Date : formato fecha, Room_number :int, ID_Client :int, Payed :boolean (1 o 0), 

``` http
PUT REST/api/reservations
```
---

Autenticación

Se inicia con un verbo GET la autenticación basic con el nombre de usuario y la contraseña, la api devuelve un token que se tendrá que usar para autenticar en las funcionalidades de creación y editado de reservas

para conseguir el token se debe hacer una petición del estilo GET usuarios/token y en la sección de Autenticación se deberá seleccionar el tipo de autenticación llamado Basic y completar con las credenciales correctas, luego la api devuelve un token que se tendrá que usar en las peticiones POST y PUT completando en la sección de autenticación bearer con el token

las credenciales por defecto son Usuario: webadmin y Contraseña: admin

``` http
GET REST/api/usuarios/token
```
