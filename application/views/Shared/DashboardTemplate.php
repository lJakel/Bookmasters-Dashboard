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

      <!--<link href="css/application.min.css" rel="stylesheet">-->
      <!--Core CSS -->
      <link href="http://www.bookmasters.com/CDN/css/bootstrap-sass/assets/stylesheets/_bootstrap.css" rel="stylesheet">
      <link href="http://www.bookmasters.com/CDN/css/bootstrap-reset/bootstrap-reset.css" rel="stylesheet">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

      <!-- Custom styles for this Dashboard -->
      <link href="http://www.bookmasters.com/CDN/css/dashboard-sass2/assets/stylesheets/_dashboard.css" rel="stylesheet">

      <!--HTML5 Related Downgrade-->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
      <![endif]-->



   </head>
   <!-- sn-demo directive enables all functions which are used for demo. e.g. animating notifications count, chat unread messages.
        to be removed in real app-->
   <body data-ng-controller="BMAppController" data-ng-class="{'login - page': loginPage, 'error - page': errorPage}">
      <!--App Bootstrap-->
      <div data-ui-view>

      </div>

      <!-- common libraries. required for every page-->
      <!-- include jquery BEFORE angular so $(el).html() may resolve scripts. see http://stackoverflow.com/a/12200540/1298418 -->
      <script src="http://www.bookmasters.com/CDN/js/jquery/dist/jquery.min.js"></script>

      <script src="http://www.bookmasters.com/CDN/js/angular/angular.min.js"></script>
      <script src="http://www.bookmasters.com/CDN/js/angular-ui-router/release/angular-ui-router.min.js"></script>
      <script src="http://www.bookmasters.com/CDN/js/ngstorage/ngStorage.min.js"></script>
      <script src="http://www.bookmasters.com/CDN/js/angular-1.4.7/angular-resource.min.js"></script>
      <script src="http://www.bookmasters.com/CDN/js/angular-ui-event/dist/event.min.js"></script>
      <script src="http://www.bookmasters.com/CDN/js/angular-1.4.7/angular-animate.min.js"></script>

      <!-- common libs. previous bootstrap-sass version was used, but due to a need to have single compiled file using bootstrap's version -->
      <script src="<?php echo site_url('assets/vendor/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
      <script src="http://www.bookmasters.com/CDN/js/pace/pace.min.js" data-pace-options='{ "target": "#main-content", "ghostTime": 1000 }'></script>

      <!-- common app js -->
      <script src="<?php echo site_url('assets/js/ng/app.js?cache=' . rand(1000, 9000)); ?>"></script>
      <script src="<?php echo site_url('assets/js/ng/controllers.js?cache=' . rand(1000, 9000)); ?>"></script>
      <script src="<?php echo site_url('assets/js/ng/services.js?cache=' . rand(1000, 9000)); ?>"></script>
      <script src="<?php echo site_url('assets/js/ng/directives.js?cache=' . rand(1000, 9000)); ?>"></script>

      <!-- page specific libs -->

   </body>
</html>
