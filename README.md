# Trabajo Espeical Web-2 Tercera Parte

## Integrante:

- Santiago San Martín

---

## Descripción:

API Rest RESTful desarrollada para la tercer entrega del trabajo práctico especial de la materia de WEB 2, está conectada a una base de datos de reservas de un hotel y permite conseguir todas las reservas, una reserva mediante su id, crear una resvera, modificar una reserva mediante el id, eliminar una reserva por id y las funciones de creacion, edicion y eliminación están resguardadas por autenticación

---

## Tabla de Ruteo:

|        URL       |Verbo|       Controlador         |Método    |
|------------------|-----|---------------------------|----------|
|reservations      |GET  |reservationsApiController  |getAll    |
|reservations/:id  |GET  |reservationsApiController  |get       |
|reservations      |POST |reservationsApiController  |create    |
|reservations/:id  |PUT  |reservationsApiController  |update    |
|usuarios/token    |GET  |userApiController          |getToken  |


##GET

Devuelve todas las reservas de la base de datos, se pueden ordenar por distintos atributos 

``` http
GET REST/api/reservations
```
---

## GET/ID

``` http
GET REST/api/reservations
```
---

## POST

Crea una reserva y la inserta en la base de datos con los atributos requeridos en formato JSON enviados mediante el body de la request. 

### Atributos necesarios:

- Date :fecha ("aaaa-mm-dd")
- Room_number :entero
- ID_Client :entero
- Payed :booleano (1 o 0)

### Resultados esperados:

#### Resultado positivo:

Código de status = 201 y retorna la reserva creada

#### Resultado negativo:

En el caso de no completar alguno de los atributos requeridos el resultado es el código de status = 400 y retorna un string "Faltan completar datos"


### Cómo usar:


1. Petición URL 
   ``` http
    POST REST/api/reservations
   ```

2. En el body de la petición deben ir los atributos de las reservas en formato JSON
   ``` json
   {
     "Date": "2024-10-20",
     "Room_number": 2023,
     "ID_Client": 1,
     "Payed": 1
   }
   ```

## PUT

Modifica una reserva seleccionada por un id, de no existir devuelven un error 400 para poder editar la reserva correctamente se debe enviar en el body 4 parametros en formato json, Date : formato fecha, Room_number :int, ID_Client :int, Payed :boolean (1 o 0), 

``` http
PUT REST/api/reservations
```
---

## Autenticación

Se inicia con un verbo GET la autenticación basic con el nombre de usuario y la contraseña, la api devuelve un token que se tendrá que usar para autenticar en las funcionalidades de creación y editado de reservas

para conseguir el token se debe hacer una petición del estilo GET usuarios/token y en la sección de Autenticación se deberá seleccionar el tipo de autenticación llamado Basic y completar con las credenciales correctas, luego la api devuelve un token que se tendrá que usar en las peticiones POST y PUT completando en la sección de autenticación bearer con el token

### Credenciales:

- Usuario: webadmin
- Contraseña: admin

``` http
GET REST/api/usuarios/token
```
