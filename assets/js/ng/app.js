'use strict';

var BMApp = angular.module('BMApp', [
   // common essential modules
   'ngAnimate',
   'ngStorage',
   'ngResource',
   'ui.router',
   'ui.router.util',
   'ui.jq',
   'ui.event',
   // page-specific and demo. may be removed
   // application libs
   'app.controllers',
   'app.services',
   'app.directives'
]);

BMApp.config(function ($stateProvider, $urlRouterProvider, $controllerProvider, $compileProvider, $filterProvider, $provide, $httpProvider) {

   BMApp.register = {
      controller: $controllerProvider.register,
      directive: $compileProvider.directive,
      filter: $filterProvider.register,
      factory: $provide.factory,
      service: $provide.service
   };

   $httpProvider.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';

   var param = function (obj) {
      var query = '', name, value, fullSubName, subName, subValue, innerObj, i;

      for (name in obj) {
         value = obj[name];

         if (value instanceof Array) {
            for (i = 0; i < value.length; ++i) {
               subValue = value[i];
               fullSubName = name + '[' + i + ']';
               innerObj = {};
               innerObj[fullSubName] = subValue;
               query += param(innerObj) + '&';
            }
         }
         else if (value instanceof Object) {
            for (subName in value) {
               subValue = value[subName];
               fullSubName = name + '[' + subName + ']';
               innerObj = {};
               innerObj[fullSubName] = subValue;
               query += param(innerObj) + '&';
            }
         }
         else if (value !== undefined && value !== null)
            query += encodeURIComponent(name) + '=' + encodeURIComponent(value) + '&';
      }

      return query.length ? query.substr(0, query.length - 1) : query;
   };

   // Override $http service's default transformRequest
   $httpProvider.defaults.transformRequest = [function (data) {
         return angular.isObject(data) && String(data) !== '[object File]' ? param(data) : data;
      }];
   // $httpProvider.defaults.headers.post['Accept'] = 'application/json, text/javascript';
   // $httpProvider.defaults.headers.post['Content-Type'] = 'application/json; charset=utf-8';

   // $httpProvider.defaults.headers.common['Accept'] = 'application/json, text/javascript';
   // $httpProvider.defaults.headers.common['Content-Type'] = 'application/json; charset=utf-8';


   // For any unmatched url, send to /dashboard


   var authenticated = ['$q', 'AuthFactory', function ($q, AuthFactory) {
         var deferred = $q.defer();
         AuthFactory.getInfo().then(function (response) {
            if (response != null) {
               console.log('App.js fn authenticated deferred resolve')
               deferred.resolve();
            } else {
               deferred.reject('Not logged in');
            }
         });
         return deferred.promise;
      }];

   var templateProvider = function ($http, $stateParams, $state, scriptLoader, AuthFactory) {
      var url = '';
      if ($stateParams.page == "home") {
         url = $stateParams.app + '/' + 'index';
      } else {
         url = $stateParams.app + '/' + $stateParams.page;
      }

      return $http.get(url).then(function (response) {
         return scriptLoader.loadScriptTagsFromData(response.data);
      }).then(function (responseData) {
         return responseData;
      });
   }

   $urlRouterProvider.otherwise("/bm/main/index/");
   $stateProvider.state('bm', {url: '/bm', abstract: true, templateUrl: 'Shared/appBootstrap'});
   $stateProvider.state('bm.app', {
      abstract: true,
      url: '/:app',
      params: {
         app: 'main',
      },
      views: {
         'appItems': {
            templateUrl: function (params) {
               return  params.app + '/sidebar';
            },
         }
      },
   });
   $stateProvider.state('bm.app.page', {
      url: '/:page/:child',
      params: {
         app: '',
         page: '',
         child: null,
         id: {value: null}
      },
      resolve: {
         authenticated: authenticated,
         deps: ['scriptLoader', function (scriptLoader) {
               return scriptLoader;
            }]
      },
      views: {
         'mainContent@bm': {
            templateProvider: templateProvider
         }
      }
   });





   //separate state for login & error pages
   $stateProvider.state('login', {
      url: '/login',
      templateUrl: 'Shared/login'
   })
           .state('error', {
              url: '/error',
              params: {
                 code: '',
                 message: ''
              },
              templateUrl: 'Shared/error'
           })

           .state('404', {
              url: '/404',
              templateUrl: 'Shared/notFound'
           });
});

BMApp.run(function ($rootScope, $state, $log, AuthFactory, partialCleanup) {
   $rootScope.previousState;
   $rootScope.previousStateParams;
   $rootScope.$on('$stateChangeSuccess', function (ev, to, toParams, from, fromParams) {
      $rootScope.previousState = from.name;
      $rootScope.previousStateParams = fromParams;
   });

   $rootScope.$on('$stateChangeStart', function () {
      partialCleanup.clean()
   });

   $rootScope.$on('$stateChangeError', function (event, toState, toParams, fromState, fromParams, error) {

      switch (error.status) {
         case 200:
         default:
            break;

         case 400:
            $state.go('error', {code: '400'});
         case 401:
         case 403:
            AuthFactory.logout();
            break;
         case 404:
            $state.go('error', {code: '404', message: 'Part of/or the page requested was not found.'});
         case 500:
            $state.go('error', {code: '500', message: 'An internal server error has occured.'});

            break;
      }
   });
});


BMApp.value('uiJqDependencies', {
   'dropzone': [
      'http://www.bookmasters.com/CDN/js/dropzone/dist/min/dropzone.min.js'
   ],
   'mapael': [
      'vendor/raphael/raphael-min.js',
      'vendor/jQuery-Mapael/js/jquery.mapael.js'
   ],
   'easyPieChart': [
      'vendor/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js'
   ],
   'autosize': [
      'vendor/jquery-autosize/jquery.autosize.min.js'
   ],
   'wysihtml5': [
      'vendor/bootstrap3-wysihtml5/lib/js/wysihtml5-0.3.0.min.js',
      'vendor/bootstrap3-wysihtml5/src/bootstrap3-wysihtml5.js'
   ],
   'select2': [
      'vendor/select2/select2.min.js'
   ],
   'markdown': [
      'vendor/markdown/lib/markdown.js',
      'vendor/bootstrap-markdown/js/bootstrap-markdown.js'
   ],
   'datetimepicker': [
      'vendor/moment/min/moment.min.js',
      'vendor/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js'
   ],
   'colorpicker': [
      'vendor/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js'
   ],
   'inputmask': [
      'vendor/jasny-bootstrap/js/inputmask.js'
   ],
   'fileinput': [
      'vendor/holderjs/holder.js',
      'vendor/jasny-bootstrap/js/fileinput.js'
   ],
   'slider': [
      'vendor/seiyria-bootstrap-slider/dist/bootstrap-slider.min.js'
   ],
   'parsley': [
      'vendor/parsleyjs/dist/parsley.min.js'
   ],
   'sortable': [
      'vendor/jquery-ui/ui/core.js',
      'vendor/jquery-ui/ui/widget.js',
      'vendor/jquery-ui/ui/mouse.js',
      'vendor/jquery-ui/ui/sortable.js',
      'vendor/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js'
   ],
   'draggable': [
      'vendor/jquery-ui/ui/core.js',
      'vendor/jquery-ui/ui/widget.js',
      'vendor/jquery-ui/ui/mouse.js',
      'vendor/jquery-ui/ui/draggable.js'
   ],
   'nestable': [
      'vendor/jquery.nestable/jquery.nestable.js'
   ],
   'vectorMap': [
      'vendor/jvectormap/jquery-jvectormap-1.2.2.min.js',
      'vendor/jvectormap-world/index.js'
   ],
   'sparkline': [
      'vendor/jquery.sparkline/index.js'
   ],
   'magnificPopup': [
      'vendor/magnific-popup/dist/jquery.magnific-popup.min.js'
   ]
});
