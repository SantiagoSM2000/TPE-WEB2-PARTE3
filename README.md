# Trabajo Espeical Web-2 Tercera Parte

## Integrante:

- Santiago San Martín

---

## Descripción:

API Rest RESTful desarrollada para la tercer entrega del trabajo práctico especial de la materia de WEB 2, está conectada a una base de datos de reservas de un hotel y permite conseguir todas las reservas, una reserva mediante su id, crear una resvera, modificar una reserva mediante el id, eliminar una reserva por id y las funciones de creacion, edicion y eliminación están resguardadas por autenticación.

---

Tabla de contenidos

- [GET](#GET)
	- [Descripción](#Descripción)
	- [Cómo usar](#Cómo-usar)
	- [Resultados esperados](#Resultados-esperados)
		- [Variaciones de la petición con query params](#Variaciones-de-la-petición-con-query-params)
  			- [Ordenamiento por atributo](#Ordenamiento-por-atributo)
	    			- [Descripción](#Descripción-1)
	        		- [Cómo usar](#Cómo-usar-1)
	         		- [Resultados esperados](#Resultados-esperados-1)
            		- [Ordenamiento por orden ascendente o descendente](#Ordenamiento-por-orden-ascendente-o-descendente)
	      			- [Descripción](#Descripción-2)
	   			- [Cómo usar](#Cómo-usar-2)
	      			- [Resultados esperados](#Resultados-esperados-2)
           		- [Filtrado de reserva pagada](#Filtrado-de-reserva-pagada)
	           		- [Descripción](#Descripción-3)
	           		- [Cómo usar](#Cómo-usar-3)
	      			- [Resultados esperados](#Resultados-esperados-3)
          		- [Paginado](#Paginado)
	          	  	- [Descripción](#Descripción-4)
	          	  	- [Cómo usar](#Cómo-usar-4)
	          	  	- [Resultados esperados](#Resultados-esperados-4)
          		- [Ejemplo de combinación de las variaciones anteriores](#Ejemplo-de-combinación-de-las-variaciones-anteriores)
- [GET/ID](#GET/ID)
	- [Descripción](#Descripción-5)
	- [Cómo usar](#Cómo-usar-5)
   	- [Resultados esperados](#Resultados-esperados-5)
- [POST](#POST)
  	- [Descripción](#Descripción-6)
	- [Cómo usar](#Cómo-usar-6)
   	- [Resultados esperados](#Resultados-esperados-6)
- [PUT](#PUT)
  	- [Descripción](#Descripción-7)
	- [Cómo usar](#Cómo-usar-7)
   	- [Resultados esperados](#Resultados-esperados-7)
- [DELETE](#DELETE)
  	- [Descripción](#Descripción-8)
	- [Cómo usar](#Cómo-usar-8)
   	- [Resultados esperados](#Resultados-esperados-8)
- [Autenticación](#Autenticación)
  	- [Descripción](#Descripción-9)
	- [Cómo usar](#Cómo-usar-9)
   	- [Resultados esperados](#Resultados-esperados-9)
- [Tabla de Ruteo](#Tabla-de-Ruteo)

---

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

    - Ordena las reservas según el critierio solicitado con el query param "orderBy"
      
  - ### Atributos para usar en el query param "orderBy":

    - ID_Reservation
    - ID_Client
    - Room_Number
    - Date

  - ### Cómo usar:

    - URL de la petición
      ``` http
      GET REST/api/reservations?orderBy=:Atributo_permitido
      ```
    - ### Ejemplo:

      ``` http
      GET REST/api/reservations?orderBy=Room_Number
      ```
  - ### Resultados esperados:

    - #### Resultado positivo:

      - Código de status = 200 y retorna todas las reservas ordenadas por el atributo en el query params

    - #### Resultado negativo:

      - En el caso de haber ingresado mal el query params se devuelven las reservas sin ningún criterio de ordenamiento

  - #### Ordenamiento por orden ascendente o descendente:
    
    - ### Descripción:
  
      - Se puede usar unicamente en conjunto con un ordenamiento por atributo para aplicar un ordenamiento de las reservas por orden ascendente o descendente con el query param "order"
     
      - ### Valores del query param "order":
  
        - Asc
        - Desc
    
    - ### Cómo usar:
  
      - URL de la petición
        ``` http
        GET REST/api/reservations?orderBy=:Atributo_permitido&order=:orden
        ```
        
      - ### Ejemplo:
  
        ``` http
        GET REST/api/reservations?orderBy=Room_Number&order=Desc
        ```
    - ### Resultados esperados:
  
      - #### Resultado positivo:
  
        - Código de status = 200 y retorna todas las reservas ordenadas por atributo y por el orden indicado
  
      - #### Resultado negativo:
  
        - En el caso de haber ingresado mal el query params se devuelven las reservas en orden ascendente por defecto
        - En el caso de haber ingresado solo el ordenamiento ascendente o descendente se devuelve código de status = 400 y retorna un string "Falta ordenar por un atributo"

- #### Filtrado de reserva pagada:

  - ### Descripción:
  
    - Filtra las reservas pagadas y solo devuelve esas, se debe utilizar el query param "Payed"
      
  - ### Valores del query param "Payed":
  
    - True
    - False
      
  - ### Cómo usar:
  
    - URL de la petición
      ``` http
      GET REST/api/reservations?Payed:=Valor
        
    - ### Ejemplo:
  
      ``` http
      GET REST/api/reservations?Payed=True
      ```
      
  - ### Resultados esperados:
  
      - #### Resultado positivo:
  
        - Código de status = 200 y retorna todas las reservas que cumplan con el valor del query param
  
      - #### Resultado negativo:
  
        - En el caso de haber ingresado mal el query params se devuelven las reservas en orden ascendente por defecto
          
- #### Paginado:

  - ### Descripción:

    - Solo devuelve las reservas que se encuentren comprendidas por la página y cantidad de reservas por página que se usen en los query params

  - ### Query params y sus posibles valores:

    - page = entero positivo
    - amount = entero positivo

  - ### Cómo usar:

    - URL de la petición
    ``` http
    GET REST/api/reservations?page:=entero&amount:=entero
    ```
  
    - ### Ejemplo:

    ``` http
    GET REST/api/reservations?page=1&amount=10
    ```

  - ### Resultados esperados:

    - #### Resultado positivo:

      - Código de status = 200 y retorna todas las reservas que cumplan con el rango del paginado

  - #### Resultado negativo:

    - En el caso de haber ingresado mal el query params se devuelven todas las reservas
    - En el caso de haber ingresado valores iguales a 0 o negativos en los query params devuelve código de status = 400 y retorna un string "No es una combinación de paginado válida"

- #### Ejemplo de combinación de las variaciones anteriores:

  - URL de la petición con todos los ordenamientos y filtrados:
    
    ``` http
    GET REST/api/reservations?orderBy=Room_Number&order=Desc&Payed=True&page=1&amount=10
    ```
  

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

   - - En el caso de enviar un ID no válido por query param se devuelve un código de status = 404 y se retorna un string "La reserva con el id=(valor) no existe"
   
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

## DELETE

### Descripción:

Elimina una reserva de la base de datos

### Cómo usar:

- URL de la petición con el ID de la reserva que se desea eliminar
  ``` http
  DELETE REST/api/reservations/:ID
  ```

### Ejemplo:

  ``` http
  DELETE REST/api/reservations/:1
  ```
  
### Resultados esperados:

- #### Resultado positivo:

   - Código de status = 200 y retorna la reserva solicitada por el ID

- #### Resultado negativo:

   - En el caso de enviar un ID no válido por query param se devuelve un código de status = 404 y se retorna un string "La reserva con el id=(valor) no existe"
 
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

---

## Tabla de Ruteo:

|        URL       |Verbo|       Controlador         |Método    |
|------------------|-----|---------------------------|----------|
|reservations      |GET  |reservationsApiController  |getAll    |
|reservations/:id  |GET  |reservationsApiController  |get       |
|reservations      |POST |reservationsApiController  |create    |
|reservations/:id  |PUT  |reservationsApiController  |update    |
|usuarios/token    |GET  |userApiController          |getToken  |

