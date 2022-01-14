<?php

class Conini
{

    private $cnx = null;

    private $errorConectarBd = array(
        "resultado" => false,
        "mensaje" => "Error al conectar con la base de datos",
        "consola" => "Metodo conectar() en bd",
    );
    private $errorConsultarBd = array(
        "resultado" => false,
        "mensaje" => "Error al consultar la base de datos",
        "consola" => "",
    );
    private $errorSentenciaBd = array(
        "resultado" => false,
        "mensaje" => "",
        "consola" => "",
    );

    public function __construct()
    {
        //Verificamos que se encuentr el archivo de conexion a la base de datos.
        // if (!file_exists("../conexion/cls_config.php")) {
        //     echo "Archivo de conexion no encontrado";die;
        // }
        require_once "../conexion/cls_config.php";
        $this->cnx = new cls_config();

        if (!$this->cnx->conectar()) {
            return $this->errorConectarBd;
        }
    }

    public function consultarPagosCliente($obj)
    {
        if (!isset($obj->TpCodigo) || !is_numeric($obj->TpCodigo)) {
            return array(
                "resultado" => false,
                "mensaje" => "No se envio el tipo de documento",
                "consola" => "El codigo del tipo de documento no viene o no es numerico, " . $obj->TpCodigo,
            );
        }
        if (!isset($obj->ClIdentificacion) || !is_numeric($obj->ClIdentificacion)) {
            return array(
                "resultado" => false,
                "mensaje" => "No se envio el número de identificación del cliente",
                "consola" => "El codigo del cliente no viene o no es numerico, " . $obj->ClIdentificacion,
            );
        }

        $sql = "SELECT
            cli.cl_identificacion ClIdentificacion,
            cli.cl_nombre ClNombre,
            cli.cl_estado ClEstado,
            tp.tp_codigo TpCodigo,
            tp.tp_nombre TpNombre
        FROM 
            cliente cli 
        INNER JOIN tipo_documento tp ON tp.tp_codigo = cli.tp_codigo AND tp.tp_codigo = {$obj->TpCodigo}
        WHERE
            cli.cl_identificacion = {$obj->ClIdentificacion}
        ";

        if (!$this->cnx->consultar($sql)) {
            $this->errorConsultarBd["consola"] = "Error al consultar los datos del cliente.";
            return $this->errorConsultarBd;
        }

        $r_cliente = $this->cnx->json;

        if ($r_cliente != '') {
            $array_resultado = array();

            $array_resultado = [
                "nombre" => $r_cliente[0]['ClNombre'],
                "tipo_documento" => $r_cliente[0]['TpNombre'],
                "identificacion" => $r_cliente[0]['ClIdentificacion'],
                "data" => null
            ];

            $sql = "SELECT
                pa.pa_codigo PaCodigo,
                pa.pa_num_plan PaNumPlan,
                pa.pa_valor PaValor,
                pa.pa_vencimiento PaVencimiento,
                pa.pa_vigencia PaVigencia
            FROM
                pagos pa
            WHERE
                pa.cl_identificacion = {$obj->ClIdentificacion}
            ORDER BY
                pa.pa_vencimiento ASC
            ";

            if (!$this->cnx->consultar($sql)) {
                $this->errorConsultarBd["consola"] = "Error al los pagos del cliente {$obj->ClIdentificacion}.";
                return $this->errorConsultarBd;
            }

            $r_pagos = $this->cnx->json;
            
            if($r_pagos != ''){
                $count = 0;
                foreach($r_pagos as $pagos){
                    $array = [ //Organizamos un array con los datos de la facultad
                        "PaCodigo" => utf8_decode($pagos['PaCodigo']),
                        "PaNumPlan" => utf8_decode($pagos['PaNumPlan']),
                        "PaValor" => utf8_decode($pagos['PaValor']),
                        "PaVencimiento" => utf8_decode($pagos['PaVencimiento']),
                        "PaVigencia" => utf8_decode($pagos['PaVigencia'])
                    ];
                    //Almacenamos en el array final la facultad
                    $array_resultado['data'][$count] = array_map('utf8_encode', $array);
                    $count++;
                }
                return array(
                    "resultado" => true,
                    "mensaje" => "Pagos consultados correctamente.",
                    "data" => $array_resultado
                );
            }else{
                return array(
                    "resultado" => true,
                    "mensaje" => "No se encontraron pagos referentes al cliente {$obj->ClIdentificacion}.",
                    "data" => $array_resultado
                );
            }
        } else {
            return array(
                "resultado" => true,
                "mensaje" => "No existe un cliente referente a la identificación {$obj->ClIdentificacion}.",
                "data" => null
            );
        }
    }

    public function consultarTipoDocumento()
    {
        $sql = "SELECT
            tp_codigo TpCodigo,
            tp_nombre TpNombre,
            tp_estado TpEstado
        FROM 
            tipo_documento 
        WHERE tp_estado = 1";

        if (!$this->cnx->consultar($sql)) {
            $this->errorConsultarBd["consola"] = "Error al consultar los tipos de documento.";
            return $this->errorConsultarBd;
        }

        return array(
            "resultado" => true,
            "mensaje" => "Tipos de documento consultados correctamente.",
            "data" => $this->cnx->json
        );
    }
}
