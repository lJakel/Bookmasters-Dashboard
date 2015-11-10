'use strict';

/* Services */

// Define your services here if necessary
var appServices = angular.module('app.services', []);


appServices.factory('partialCleanup', function ($timeout) {
   var objectsToClean = [];
   return{
      prepare: function (array) {
         array = array || [];
         objectsToClean = array;
      },
      clean: function () {
         console.log(objectsToClean)
         $('.partial-script').each(function () {
            this.remove();
         });
         $.each(objectsToClean, function (index, value) {
            $timeout(function () {
               window[value] = null;
            });
            objectsToClean = [];
         });
      }
   }

});
/**
 * Override default angular exception handler to log and alert info if debug mode
 */
appServices.factory('$exceptionHandler', function ($log) {
   return function (exception, cause) {
      var errors = JSON.parse(localStorage.getItem('bm-angular-errors')) || {};
      errors[new Date().getTime()] = arguments;
      localStorage.setItem('bm-angular-errors', JSON.stringify(errors));
      app.debug && $log.error.apply($log, arguments);
   };
});
/**
 * Sing Script loader. Loads script tags asynchronously and in order defined in a page
 */
appServices.factory('scriptLoader', ['$q', '$timeout', function ($q, $timeout) {

      /**
       * Naming it processedScripts because there is no guarantee any of those have been actually loaded/executed
       * @type {Array}
       */
      var processedScripts = [];
      return {
         /**
          * Parses 'data' in order to find & execute script tags asynchronously as defined.
          * Called for partial views.
          * @param data
          * @returns {*} promise that will be resolved when all scripts are loaded
          */
         loadScriptTagsFromData: function (data) {
            var deferred = $q.defer();
            var $contents = $($.parseHTML(data, document, true)),
                    $scripts = $contents.filter('script[data-src][type="text/javascript-lazy"]').add($contents.find('script[data-src][type="text/javascript-lazy"]')),
                    scriptLoader = this;
            scriptLoader.loadScripts($scripts.map(function () {
               return $(this).attr('data-src');
            }).get())
                    .then(function () {
                       deferred.resolve(data);
                    });
            return deferred.promise;
         },
         /**
          * Sequentially and asynchronously loads scripts (without blocking) if not already loaded
          * @param scripts an array of url to create script tags from
          * @returns {*} promise that will be resolved when all scripts are loaded
          */
         loadScripts: function (scripts, loadScope) {

            loadScope = loadScope || 'partial';
            var previousDefer = $q.defer();
            previousDefer.resolve();
            scripts.forEach(function (script) {
               if (processedScripts[script]) {
                  if (processedScripts[script].processing) {
                     previousDefer = processedScripts[script];
                  }
                  return
               }
               if (loadScope == 'partial') {
                  var scriptTag = document.createElement('script'),
                          $scriptTag = $(scriptTag).attr('data-bm-lazy', loadScope).addClass('partial-script'),
                          defer = $q.defer();
               } else {
                  var scriptTag = document.createElement('script'),
                          $scriptTag = $(scriptTag).attr('data-bm-lazy', loadScope),
                          defer = $q.defer();
               }


               scriptTag.src = script;
               defer.processing = true;
               $scriptTag.load(function () {
                  $timeout(function () {
                     defer.resolve();
                     defer.processing = false;
                     Pace.restart();
                  });
               });
               previousDefer.promise.then(function () {
                  document.body.appendChild(scriptTag);
               });
               processedScripts[script] = previousDefer = defer;
            });
            return previousDefer.promise;
         }
      }
   }]);
appServices.factory('AuthFactory', ['$http', '$state', '$q', '$localStorage', function ($http, $state, $q, $localStorage) {

      var local = true;
      var url = '';
      if (local == true) {
         var url = 'auth/';
      } else {
         var url = 'http://10.10.11.48/Utilities/api/';
      }

      var factory = {
         user: null,
         isLoggedIn: isLoggedIn,
         getInfo: getInfo,
         logout: logout,
         login: login,
         register: register
      };
      return factory;
      function changeUser(user) {
         factory.user = user
         $localStorage.user = user;
      }
      function logout() {
         $http.post(url + 'logout').then(function (response) {
            $localStorage.$reset();
            changeUser(null);
            $state.go('login');
         }, function (response) {
            $state.go('error');
         });
      }

      function login(user, redirect, success, error) {

         $http.post(url + 'login', user, redirect).then(function (response) {

            changeUser(response.data.data); // get user block
            success(response.data); //get parent userblock and message block
         }, function (response) {
            changeUser(null);
            error(response.data);
         });
      }

      function register(user, success, error) {
         $http.post(url + 'register', user).success(function (user) {
            success(user);
         }).error(function (err) {
            error(err);
         });
      }

      function isLoggedIn(get) {
         return $http.post(url + 'getuser').then(function (response) {
            console.log('services.js fn isLoggedIn get session data from server')
            changeUser(response.data);
            if (get == true) {
               return response.data;
            }
         }, function (response) {

            changeUser(null);
            return $state.go('login');
         });
      }
      function getInfo() {

         if ($localStorage.user == null) {
            console.log('services.js fn getInfo factory.user == null return islogged from server')
            return factory.isLoggedIn(true);
         } else {
            console.log('services.js fn getInfo factory.user != null return data from storage WHEN')
            factory.user = $localStorage.user;
            return $q.when(factory.user);
         }
      }

   }]);