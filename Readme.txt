Prueba conocimiento.
Desarrollada por Douglas Plazas 
plazasdouglas@gmail.com
3102734668

Herramientas usadas
php 8.1.1
mariadb
angularjs
bootstrap 4
Jquery

ruta para ejecutar el proyecto desde xampp
http://localhost/prueba

==============================================

Explicacion

El boton azul de consulta cuenta con las validaciones especificadas en el documento para que pueda realizar la funcion establecida.
El boton azul consulta por medio de peticiones al backend en php donde se encuentra montada la estructura para obtener en formato json la informacion
de la base de datos "prueba_ingreso" normalizada para el ejemplo, en la carpeta raiz del codigo se encuentra un backup de la base de datos prueba_ingreso.sql.

Usuario Base de datos MYSQL/MARIADB
usuario_bd = 'prueba';
clave_bd = '1234';
db = 'prueba_ingreso';

Importante: Cualquier cambio en estos datos de conexion deberan ser especificados en el archivo conexion/cls_config.php

Informacion para las pruebas de base de datos:
 Tipo de documento: Cedula ciudadania
 Identificacion: 1075256993
 Contiene pagos.

 Tipo de documento: Cedula extranjeria
 Identificacion: 36156364
 No contiene pagos.

==============================================

El boton rojo contiene una funcion para consultar data en formato json a un archivo especifico siguiendo el formato establecido en el documento.
El archivo con la data se encuentra en la raiz del proyecto /data.json. 
Para agilizar las pruebas el boton rojo no contiene validaciones similares al boton azul, solo en caso de que la data este vacia.