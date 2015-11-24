<!DOCTYPE html>
<html lang="en" ng-app="BMApp">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height">
      <meta name="description" content="">
      <meta name="author" content="Jake Ihasz">
      <meta name="robots" content="noindex">

      <title>Bookmasters - Dashboard</title>
      <!--<link rel="dns-prefetch" href="//api.bookmasters.com">-->
      <!--[if IE]><link href="http://www.bookmasters.com/CDN/resources/brand/favicon/favicon.ico" rel="icon" /><![endif]-->
      <link rel="icon" href="http://www.bookmasters.com/CDN/resources/brand/favicon/favicon.png">
      <link rel="apple-touch-icon-precomposed" href="http://www.bookmasters.com/CDN/resources/brand/favicon/apple-touch-icon-57x57-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="57x57" href="http://www.bookmasters.com/CDN/resources/brand/favicon/apple-touch-icon-57x57-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="http://www.bookmasters.com/CDN/resources/brand/favicon/apple-touch-icon-72x72-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="114x114" href="http://www.bookmasters.com/CDN/resources/brand/favicon/apple-touch-icon-114x114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="144x144" href="http://www.bookmasters.com/CDN/resources/brand/favicon/apple-touch-icon-144x144-precomposed.png">

      <!--Core CSS -->
      <link href="http://www.bookmasters.com/CDN/css/bootstrap-sass/assets/stylesheets/_bootstrap.css" rel="stylesheet">
      <link href="http://www.bookmasters.com/CDN/css/bootstrap-reset/bootstrap-reset.css" rel="stylesheet">

      <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">-->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">


      <!-- Custom styles for this Dashboard -->
      <link href="http://www.bookmasters.com/CDN/css/dashboard-sass2/assets/stylesheets/_dashboard.css" rel="stylesheet">


   </head>

   <body data-ng-controller="BMAppController">
      <!--[if lt IE 10]><div class="lt-ie10-bg"><p class="browsehappy">You are using an <strong>outdated</strong> browser.</p><p>Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p</div><![endif]-->

      <!--App Bootstrap-->
      <div data-ui-view></div>

      <!-- common libraries. required for every page-->
      <script src="http://www.bookmasters.com/CDN/js/jquery/dist/jquery.min.js"></script>
      <script src="http://www.bookmasters.com/CDN/js/angular/angular.min.js"></script>
      <script src="http://www.bookmasters.com/CDN/js/angular-ui-router/release/angular-ui-router.min.js"></script>
      <script src="http://www.bookmasters.com/CDN/js/ngstorage/ngStorage.min.js"></script>
      <script src="http://www.bookmasters.com/CDN/js/angular-1.4.7/angular-resource.min.js"></script>
      <script src="http://www.bookmasters.com/CDN/js/angular-ui-event/dist/event.min.js"></script>
      <script src="http://www.bookmasters.com/CDN/js/angular-1.4.7/angular-animate.min.js"></script>

      <script src="http://www.bookmasters.com/CDN/js/ng-file-upload-bower-10.0.2/ng-file-upload-shim.min.js"></script>
      <script src="http://www.bookmasters.com/CDN/js/ng-file-upload-bower-10.0.2/ng-file-upload.min.js"></script>
      
      <script src="http://www.bookmasters.com/CDN/js/nya-bootstrap-select-2.1.2/js/nya-bs-select.min.js"></script>
      

      <!-- common libs. previous bootstrap-sass version was used, but due to a need to have single compiled file using bootstrap's version -->
      <script src="<?php echo site_url('assets/vendor/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>

      <!-- common app js -->
      <script src="<?php echo site_url('assets/js/ng/app.js?cache=' . rand(1000, 9000)); ?>"></script>
      <script src="<?php echo site_url('assets/js/ng/controllers.js?cache=' . rand(1000, 9000)); ?>"></script>
      <script src="<?php echo site_url('assets/js/ng/services.js?cache=' . rand(1000, 9000)); ?>"></script>
      <script src="<?php echo site_url('assets/js/ng/directives.js?cache=' . rand(1000, 9000)); ?>"></script>
      <script src="<?php echo site_url('assets/js/ng/validators.js?cache=' . rand(1000, 9000)); ?>"></script>

      <!-- page specific libs -->

   </body>
</html>
