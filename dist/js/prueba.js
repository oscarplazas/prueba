(function(){
  'use strict'
  var app = angular
    .module('prueba', ['ngNewRouter','ngResource'])
    .directive('datepicker', [function() {
      return {
        require: 'ngModel',
        restrict: 'A',
        scope: {
          format: "=?datepicker"
        },
        link: function(scope, element, attrs, ngModel){
            if(typeof(scope.format) == "undefined"){ scope.format = "yyyy-mm-dd" }
            $(element).fdatepicker({format: scope.format,language: "es"}).on('changeDate', function(ev){
                scope.$apply(function(){
                    ngModel.$setViewValue(ev.date);
                });
            })
        }
      };
    }]);
  app.controller('AppController', AppController);
    function AppController($rootScope, $router, $http) {
      $router.config([
        { path: '/consulta-inicial', component: 'conini' },
      ]);
    }

    app.filter('cortarTexto', function(){
        return function(input, limit){
          return (input.length > limit) ? input.substr(0, limit)+'...' : input;
        };
    })

 })();
