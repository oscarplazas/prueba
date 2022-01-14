<?php

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
  $salida =  array("success" => false, "message" => "Solo peticiones POST");
  echo json_encode($salida);
  die;
}

$entrada = file_get_contents('php://input');
$obj = json_decode($entrada, false);
header("Content-Type:application/json");


if ($obj == null) {
  $salida =  array("success" => false, "message" => "No se han enviado datos", "console" => "No hay datos en la petición");
  echo json_encode($salida);
  die;
}

require_once('../clases/Conini.php');

switch ($obj->accion) {

  //Consulta los tipos de documentos
  case 1:
    $ad = new Conini();
    $salida = $ad->consultarTipoDocumento();
    echo json_encode($salida);
    break;
  
  //Consulta los pagos pendientes del cliente
  case 2:
    $ad = new Conini();
    $salida = $ad->consultarPagosCliente($obj);
    echo json_encode($salida);
    break;
}//fin switch
