<?php
  header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
  header("Cache-Control: post-check=0, pre-check=0", false);
  header("Pragma: no-cache");
?>
<!DOCTYPE html>
<html lang="es" ng-app="prueba">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="dist/css/bootstrap.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700,700i" rel="stylesheet">
    <title>Axa</title>
  </head>
  <body data-ng-controller="AppController as app">
    <div class="container">
      <div class="row justify-content-md-center">
          <div class="col-md-12">
            <ng-viewport></ng-viewport>
          </div>
        </div>
      </div>
    </div>
  </body>
  <script src="dist/js/Popper.js"></script>
  <script src="dist/js/jquery.js" charset="utf-8"></script>
  <script src="dist/js/bootstrap.js" charset="utf-8"></script>
  <script src="dist/js/angular.min.js"></script>
  <script src="dist/js/router.es5.min.js"></script>
  <script src="dist/js/angular-resource.min.js"></script>
  <script src="dist/js/sha1-min.js" type="text/javascript"></script>
  <script src="dist/js/prueba.js?v=<?php echo(rand()); ?>"></script>
  <script src="dist/js/toArray.js?v=<?php echo(rand()); ?>"></script>
  <script src="components/conini/conini.js?v=<?php echo(rand()); ?>"></script>
</html>
