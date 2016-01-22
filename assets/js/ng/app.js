'use strict';

var BMApp = angular.module('BMApp', [
   // common essential modules
   'ngAnimate',
   'ngStorage',
   'ngResource',
   'ui.router',
   'ui.router.util',
   'ui.event',
   'ngFileUpload',
   'nya.bootstrap.select',
   'ui.bootstrap',
   'angular-toasty',
   'summernote',
   'ngTasty',
   // page-specific and demo. may be removed
   // application libs
   'app.controllers',
   'app.services',
   'app.directives',
   'app.wrappers',
   'app.validators',
]);

BMApp.config(['$stateProvider', '$urlRouterProvider', '$controllerProvider', '$compileProvider', '$filterProvider', '$provide', '$httpProvider', 'toastyConfigProvider',
   function ($stateProvider, $urlRouterProvider, $controllerProvider, $compileProvider, $filterProvider, $provide, $httpProvider, toastyConfigProvider) {

      toastyConfigProvider.setConfig({
         limit: 10, // {int} Maximum number of toasties to show at once
         showClose: true, // {bool} Whether to show the 'X' icon to close the toasty
         clickToClose: false, // {bool} Whether clicking the toasty closes it
         position: 'bottom-right', // {string:bottom-right,bottom-left,top-right,top-left} The window position where the toast pops up
         timeout: 5000, // {int} How long (in miliseconds) the toasty shows before it's removed. Set to false to disable.
         sound: false, // {bool} Whether to play a sound when a toast is added
         html: false, // {bool} Whether HTML is allowed in toasts
         shake: false, // {bool} Whether to shake the toasts
         theme: 'bootstrap' // {string} What theme to use; default, material or bootstrap
      });


      BMApp.register = {
         controller: $controllerProvider.register,
         directive: $compileProvider.directive,
         filter: $filterProvider.register,
         factory: $provide.factory,
         service: $provide.service
      };

      $httpProvider.defaults.headers.post['Accept'] = 'application/json, text/javascript';
      $httpProvider.defaults.headers.post['Content-Type'] = 'application/json; charset=utf-8';

      $httpProvider.defaults.headers.common['Accept'] = 'application/json, text/javascript';
      $httpProvider.defaults.headers.common['Content-Type'] = 'application/json; charset=utf-8';


      // For any unmatched url, send to /dashboard


      var authenticated = ['$q', 'AuthFactory', function ($q, AuthFactory) {
            var deferred = $q.defer();
            AuthFactory.getInfo().then(function (response) {
               if (response != null) {
                  deferred.resolve();
               } else {
                  deferred.reject('Not logged in');
               }
            });
            return deferred.promise;
         }];

      var templateProvider = ['$http', '$stateParams', '$state', 'scriptLoader', 'AuthFactory', function ($http, $stateParams, $state, scriptLoader, AuthFactory) {
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
         }];

      $urlRouterProvider.otherwise("/bm/main/index/");
      $stateProvider.state('bm', {url: '/bm', abstract: true, templateUrl: 'Shared/appBootstrap'});
      $stateProvider.state('bm.app', {
         abstract: true,
         url: '/:app',
         params: {
            app: 'main',
         },
         views: {
//         'appItems': {
//            templateUrl: function (params) {
//               return  params.app + '/sidebar';
//            },
//         }
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
   }]);

BMApp.run(['$rootScope', '$state', '$log', 'AuthFactory', function ($rootScope, $state, $log, AuthFactory) {
      $rootScope.previousState;
      $rootScope.previousStateParams;
      $rootScope.$on('$stateChangeSuccess', function (ev, to, toParams, from, fromParams) {
         $rootScope.previousState = from.name;
         $rootScope.previousStateParams = fromParams;
      });


      $rootScope.$on('$stateChangeError', function (event, toState, toParams, fromState, fromParams, error) {
         switch (error.status) {
            case 200:
            default:
               break;

            case 400:
               $state.go('error', {code: '400', message: 'Bad request. The request could not be understood by the server due to malformed syntax. The client SHOULD NOT repeat the request without modifications.'});
               break;

            case 401:
               AuthFactory.logout();
               break;
            case 403:
               $state.go('error', {code: '403', message: 'You do not have privileges to access this application.'});

               break;
            case 404:
               $state.go('error', {code: '404', message: 'Part of / and or / the page requested was not found.'});
               break;

            case 500:
               $state.go('error', {code: '500', message: 'An internal server error has occured.'});
               break;
         }
      });
   }]);
