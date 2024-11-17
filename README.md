# Trabajo Espeical Web-2 Tercera Parte

## Integrante:

- Santiago San Martín

## Tabla de Rutero:

|        URL       |Verbo|       Controlador         |Método    |
|------------------|-----|---------------------------|----------|
|reservations      |GET  |reservationsApiController  |getAll    |
|reservations/:id  |GET  |reservationsApiController  |get       |
|reservations      |POST |reservationsApiController  |create    |
|reservations/:id  |PUT  |reservationsApiController  |update    |
|usuarios/token    |GET  |userApiController          |getToken  |


GET


POST


PUT



Autenticación

Se inicia con un verbo GET la autenticación basic con el nombre de usuario y la contraseña, la api devuelve un token que se tendrá que usar para autenticar en las funcionalidades de creación y editado de reservas

para conseguir el token se debe hacer una petición del estilo GET usuarios/token y en la sección de Autenticación se deberá seleccionar el tipo de autenticación llamado Basic y completar con las credenciales correctas, luego la api devuelve un token que se tendrá que usar en las peticiones POST y PUT completando en la sección de autenticación bearer con el token

las credenciales por defecto son Usuario: webadmin y Contraseña: admin
