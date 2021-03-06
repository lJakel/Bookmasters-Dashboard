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



      $httpProvider.interceptors.push(['$q', 'toasty', function ($q, toasty) {
            return {
               request: function (request) {
//               request.headers.authorization = userService.getAuthorization();
                  return request;
               },
               // This is the responseError interceptor
               responseError: function (rejection) {
                  console.log(rejection);
                  if (rejection.status === 401 && rejection.config.url != "Authentication/Auth/getuser" && rejection.config.url != 'Dashboard/Main/Index') {
                     toasty.error({title: 'Error!', msg: 'Your session has expired.', html: true, theme: 'bootstrap', timeout: 8000});
                  }

                  return $q.reject(rejection);
               }
            };
         }]);


      // For any unmatched url, send to /dashboard

      var templateProvider = ['$http', '$stateParams', '$state', 'scriptLoader', 'AuthFactory', function ($http, $stateParams, $state, scriptLoader, AuthFactory) {
            var url = '';
            if ($stateParams.page == "home") {
               url = $stateParams.folder + '/' + $stateParams.app + '/' + 'index';
            } else {
               url = $stateParams.folder + '/' + $stateParams.app + '/' + $stateParams.page;
            }
            return $http.get(url).then(function (response) {
               return scriptLoader.loadScriptTagsFromData(response.data);
            }).then(function (responseData) {
               return responseData;
            });
         }];

      $urlRouterProvider.otherwise("/bm/Dashboard/Main/Index/");
      $stateProvider.state('bm', {url: '/bm', abstract: true, templateUrl: 'Shared/appBootstrap'});
      $stateProvider.state('bm.app', {
         abstract: true,
         url: '/:folder',
         params: {
            folder: 'titlemanagementt/newci',
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
         url: '/:app/:page/:child',
         params: {
            app: '',
            page: '',
            child: null,
            params: {value: null}
         },
         resolve: {
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
      $stateProvider
              .state('login', {
                 url: '/Login',
                 templateUrl: 'Shared/Login',
                 public: true
              })
              .state('register', {
                 url: '/Register',
                 templateUrl: 'Shared/Register',
                 public: true

              })
              .state('forgot', {
                 url: '/Forgot',
                 templateUrl: 'Shared/Forgot',
                 public: true

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

BMApp.run(['$rootScope', '$state', 'AuthFactory', '$location', function ($rootScope, $state, AuthFactory, $location) {

      $rootScope.$on('$stateChangeStart', function (event, toState, toParams, fromState, fromParams) {

         if (!$.isEmptyObject(toParams)) {
            $rootScope.redirectToStateAfterLogin = JSON.stringify(toParams);
            console.log($rootScope.redirectToStateAfterLogin);
         }

         if (!toState.public) {
            AuthFactory.getInfo().then(function (response) {
               if (!response) {
                  $rootScope.returnToState = toState.url;
                  $rootScope.returnToStateParams = toParams.Id;
                  $location.path('/Login');
               }
            });
         }
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
               $location.path('/Login');
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
