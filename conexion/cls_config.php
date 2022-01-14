<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Content-Type:application/json");
header('Content-type: text/html; charset=UTF-8');
header('Content-type: text/html; charset=ISO-8859-1');

class cls_config
{

  //Variables que vienen de usuario
  var $usuario_bd; //Usuario BD
  var $clave_bd; //Clave BD
  var $db; //Nombre base de datos

  //Variables locales
  var $conexion; //Conexión de BD
  var $jsonData = array();
  var $json;
  var $resultado; //Resultado de consulta
  var $registros; //Cantidad de registros encontrados en consulta
  var $id; //Último id agregado a la tabla
  var $count;
  var $error;



  //Cargamos las variables globales de la función
  public function __construct()
  {
    error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
    $this->usuario_bd = 'prueba';
    $this->clave_bd = '1234';
    $this->db = 'prueba_ingreso';
  } //fin constructor



  //metodo para crear una conexion a la bd
  public function Conectar()
  {
    try {
      error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
      //error_reporting( E_ALL );
      // $this->conexion = new PDO("odbc:" . $this->acceso_datos, "$this->usuario_bd", "$this->clave_bd");
      $this->conexion = new mysqli("localhost", $this->usuario_bd, $this->clave_bd, $this->db);;
      return true;
    } catch (\Exception $e) {
      echo "Error al conectar a la base de datos {$this->db}::{$e}";
      return false;
    }
  }




  //metodo para ejecutar una consulta (select) en la bd
  function consultar($sql)
  {

    error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
    //error_reporting( E_ALL );
    $this->jsonData = null;
    $this->id = 0; //Blanqueamos el último id
    $this->resultado = $this->conexion->query($sql);
    if (!$this->resultado || $this->resultado == null) {
      //return "{\"resultado\": false, \"respuesta\": \"$resultado\", \"sql\": \"$sql\", \"conexion\": \"$conexion\"}";
      return false;
    }
    $i = 0;
    while ($this->registros = $this->resultado->fetch_array()) {
      $this->jsonData[$i] = array_map('utf8_encode', $this->registros);
      $i++;
    }
    $this->json = $this->jsonData;
    return true;
  }

  //Cerrar conexión a BD
  function Desconectar()
  {
    //error_reporting( E_ALL );
    error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
    $this->conexion = null;
  }
}
