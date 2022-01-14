(function () {
    angular
        .module('prueba')
        .controller('ConiniController', ConiniController);

    function ConiniController($http, $rootScope) {
        var vm = this;
        vm.btnDeshabilitado = true;
        vm.listaTipoDocumentos = null;
        vm.listarPagosCliente = null;
        vm.listarPagosData = {};
        vm.visualizarPagos = false;
        visualizarPagosData = false;
        vm.filtroPago = "";
        vm.seleccion = {
            tipo_documento: '',
            identificacion: '',
        };


        consultarTipoDocumento();

        vm.consultarTipoDocumento = consultarTipoDocumento;
        vm.validarConsultaPagos = validarConsultaPagos;
        vm.consultarPagosCliente = consultarPagosCliente;
        vm.consultarData = consultarData;

        function consultarData() {
            vm.visualizarPagos = false;
            vm.visualizarPagosData = true;
            let json = "http://localhost/prueba/data.json";
            $http.get(json).success(function (response) {
                if(response.data){
                    vm.listarPagosData.nombre = response.nombre;
                    vm.listarPagosData.identificacion = response.identificacion;
                    vm.listarPagosData.tipo_documento = response.tipo_documento;
                    vm.listarPagosData.data = response.data;
                }
            });
            console.log(vm.listarPagosData);
        }

        function consultarTipoDocumento() {
            vm.listaTipoDocumentos = null;

            vm.objeto = {
                accion: 1
            };

            $http({
                url: "logica/conini.php",
                method: "POST",
                data: vm.objeto
            }).then(function (response) {
                var salida = response.data;
                if (salida["resultado"] == false) {
                    console.error(salida["consola"]);
                }
                if (salida["resultado"] == true) {
                    vm.listaTipoDocumentos = salida.data;
                }
            }, function myError(response) {
                console.error(response.data);
            });
        }

        function consultarPagosCliente() {
            if (!validarConsultaPagos(1)) {
                return false;
            }

            console.log('Tipo documento: ' + vm.seleccion.tipo_documento);
            console.log('Identificacion: ' + vm.seleccion.identificacion);

            vm.listarPagosCliente = null;
            vm.visualizarPagos = true;
            vm.visualizarPagosData = false;


            vm.objeto = {
                accion: 2,
                TpCodigo: vm.seleccion.tipo_documento,
                ClIdentificacion: vm.seleccion.identificacion
            };

            $http({
                url: "logica/conini.php",
                method: "POST",
                data: vm.objeto
            }).then(function (response) {
                var salida = response.data;
                if (salida["resultado"] == false) {
                    console.error(salida["consola"]);
                }
                if (salida["resultado"] == true) {
                    vm.listarPagosCliente = salida.data;
                }
            }, function myError(response) {
                console.error(response.data);
            });

        }

        function validarConsultaPagos(pasive) {
            let errores = 0;
            if (vm.seleccion.tipo_documento === '' || !vm.seleccion.tipo_documento) {
                errores++;
                if (pasive == 1) {
                    alert("Por favor seleccione un tipo de documento")
                }
            }

            if (vm.seleccion.identificacion == '' || vm.seleccion.identificacion === null || !vm.seleccion.identificacion) {
                errores++;
                if (pasive == 1) {
                    alert("Por favor ingrese el número de indentificación.")
                }
            }

            if (vm.seleccion.identificacion % 1 != 0) {
                errores++;
                if (pasive == 1) {
                    alert("La indentificación solo puede ser número.")
                }
            }

            if (vm.seleccion.identificacion.toString().length < 5) {
                errores++;
                if (pasive == 1) {
                    alert("La indentificación solo puede ser número con 5 o más digitos.")
                }
            }

            if (vm.seleccion.identificacion.toString().length > 10) {
                errores++;
                if (pasive == 1) {
                    alert("La indentificación solo puede ser número con 10 o menos digitos.")
                }
            }

            if (errores > 0) {
                $("#btnConsulta").prop("disabled", true);
                return false;
            } else {
                $("#btnConsulta").prop("disabled", false);
                return true;
            }
        }
    }

})();
