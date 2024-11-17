# Trabajo Espeical Web-2 Tercera Parte

## Integrante:

- Santiago San Martín

---

## Descripción:

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


## GET

### Descripción:

Devuelve todas las reservas de la base de datos, se pueden ordenar por distintos atributos 

### Cómo usar:

- URL de la petición
  ``` http
  GET REST/api/reservations/
  ```

### Resultados esperados:

- #### Resultado positivo:

   - Código de status = 200 y retorna todas las reservas

- #### Resultado negativo:

   - En condiciones normales no se esperan resultados negativos
 
### Variaciones de la petición con query params:

- #### Ordenamiento por atributo:
  
  - ### Descripción:

    - Ordena las reservas con el critierio solicitado con orderBY
      
  - ### Atributos para usar en el ordenamiento:

    - ID_Reservation
    - ID_Client
    - Room_Number

  - ### Cómo usar:

    - URL de la petición
      ``` http
      GET REST/api/reservations?orderBy=:Atributo_permitido
      ```
  - ### Ejemplo:

    ``` http
    GET REST/api/reservations/:29
    ```

- #### Ordenamiento por orden ascendente o descendente:

- #### Filtrado de reserva pagada:

- #### Ejemplos de combinaciones de lo anterior:

---

## GET/ID

### Descripción:

Devuelve una reserva de la base de datos según el ID

### Cómo usar:

- URL de la petición con el ID de la reserva que se desea solicitar
  ``` http
  GET REST/api/reservations/:ID
  ```

### Ejemplo:

  ``` http
  GET REST/api/reservations/:29
  ```
  
### Resultados esperados:

- #### Resultado positivo:

   - Código de status = 200 y retorna la reserva solicitada por el ID

- #### Resultado negativo:

   - En condiciones normales no se esperan resultados negativos
   
---

## POST

### Descripción:

Crea una reserva, la inserta en la base de datos con los atributos requeridos en formato JSON enviados mediante el body de la request y la devuelve

### Atributos necesarios:

- Date :fecha ("aaaa-mm-dd")
- Room_number :entero
- ID_Client :entero
- Payed :booleano (1 o 0)

### Cómo usar:

1. URL de la petición:
   ``` http
   POST REST/api/reservations
   ```

2. En el body de la petición deben ir los atributos de las reservas en formato JSON por ejemplo:
   ``` json
   {
     "Date": "2024-11-17",
     "Room_number": 100,
     "ID_Client": 1,
     "Payed": 1
   }
   ```
3. En la sección de autenticación Bearer usar el [token](#Autenticación) previamente conseguido
   
### Resultados esperados:

- #### Resultado positivo:

  - Código de status = 201 y retorna la reserva creada

- #### Resultado negativo:

  - En el caso de no completar alguno de los atributos requeridos el resultado es el código de status = 400 y retorna un string "Faltan completar datos"
  - En el caso de no estar autenticado el resultado es el código de status = 401 y retorna un string "No autorizado"

## PUT

### Descripción:

Modifica una reserva seleccionada por un id, de no existir devuelven un error 400 para poder editar la reserva correctamente se debe enviar en el body 4 parametros en formato json, Date : formato fecha, Room_number :int, ID_Client :int, Payed :boolean (1 o 0), 

### Atributos necesarios:

- Date :fecha ("aaaa-mm-dd")
- Room_number :entero
- ID_Client :entero
- Payed :booleano (1 o 0)

### Cómo usar:

1. URL de la petición con el ID de la reserva que se desea modificar
   ``` http
   PUT REST/api/reservations/:ID
   ```

2. En el body de la petición deben ir los atributos de las reservas en formato JSON por ejemplo:
   ``` json
   {
     "Date": "2024-11-17",
     "Room_number": 100,
     "ID_Client": 1,
     "Payed": 1
   }
   ```
3. En la sección de autenticación Bearer usar el [token](#Autenticación) previamente conseguido 
   
### Resultados esperados:

- #### Resultado positivo:

  - Código de status = 200 y retorna la reserva modificada

- #### Resultado negativo:

  - En el caso de no completar alguno de los atributos requeridos el resultado es el código de status = 400 y retorna un string "Faltan completar datos"
  - En el caso de no estar autenticado el resultado es el código de status = 401 y retorna un string "No autorizado"


---

## Autenticación

### Descripción:

Su función es limitar el uso de ciertas funcionalidades (PUT y POST) para que sólo puedan ser usadas por usuarios autorizados. Para conseguir el token de autenticación se deben seguir los siguientes pasos.

### Cómo usar:

1. URL de la petición para conseguir el token de autenticación
   ``` http
   GET REST/api/usuarios/token
   ```

2. En la sección de autenticación Basic usar las siguientes credenciales:
   #### Credenciales:

   - Usuario: webadmin
   - Contraseña: admin

3. Copiar el token de autenticación de la respuesta y utilizarlo en las peticiones POST y PUT escribiéndolo en la sección de de autenticación Bearer


