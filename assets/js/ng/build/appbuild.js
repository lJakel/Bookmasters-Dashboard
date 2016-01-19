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

'use strict';

var appControllers = angular.module('app.controllers', []);

//settings and state
var app = {
   name: 'BM',
   title: 'Bookmasters - Dashboard',
   version: '0.0.1',
   /**
    * Whether to print and alert some log information
    */
   debug: true,
   /**
    * In-app constants
    */
   settings: {
      colors: {
         'white': '#fff',
         'black': '#000',
         'gray-light': '#999',
         'gray-lighter': '#eee',
         'gray': '#666',
         'gray-dark': '#343434',
         'gray-darker': '#222',
         'gray-semi-light': '#777',
         'gray-semi-lighter': '#ddd',
         'brand-primary': '#5d8fc2',
         'brand-success': '#64bd63',
         'brand-warning': '#f0b518',
         'brand-danger': '#dd5826',
         'brand-info': '#5dc4bf'
      },
      screens: {
         'xs-max': 767,
         'sm-min': 768,
         'sm-max': 991,
         'md-min': 992,
         'md-max': 1199,
         'lg-min': 1200
      },
      navCollapseTimeout: 2500
   },
   /**
    * Application state. May be changed when using.
    * Synced to Local Storage
    */
   state: {
      /**
       * whether navigation is static (prevent automatic collapsing)
       */
      'nav-static': false,
      'sidebar-left': true,
      'sidebar-right': false
   },
};

var Helpers = function () {
   this._initResizeEvent();
   this._initOnScreenSizeCallbacks();
};
Helpers.prototype = {
   _resizeCallbacks: [],
   _screenSizeCallbacks: {
      xs: {
         enter: [],
         exit: []
      },
      sm: {
         enter: [],
         exit: []
      },
      md: {
         enter: [],
         exit: []
      },
      lg: {
         enter: [],
         exit: []
      }
   },
   /**
    * Checks screen size according to Bootstrap default sizes
    * @param size screen size  ('xs','sm','md','lg')
    * @returns {boolean} whether screen is <code>size</code>
    */
   isScreen: function (size) {
      var screenPx = window.innerWidth;
      return (screenPx >= app.settings.screens[size + '-min'] || size == 'xs') && (screenPx <= app.settings.screens[size + '-max'] || size == 'lg');
   },
   /**
    * Returns screen size Bootstrap-like string ('xs','sm','md','lg')
    * @returns {string}
    */
   getScreenSize: function () {
      var screenPx = window.innerWidth;
      if (screenPx <= app.settings.screens['xs-max'])
         return 'xs';
      if ((screenPx >= app.settings.screens['sm-min']) && (screenPx <= app.settings.screens['sm-max']))
         return 'sm';
      if ((screenPx >= app.settings.screens['md-min']) && (screenPx <= app.settings.screens['md-max']))
         return 'md';
      if (screenPx >= app.settings.screens['lg-min'])
         return 'lg';
   },
   /**
    * Specify a function to execute when window entered/exited particular size.
    * @param size ('xs','sm','md','lg')
    * @param fn callback(newScreenSize, prevScreenSize)
    * @param onEnter whether to run a callback when screen enters `size` or exits. true by default @optional
    */
   onScreenSize: function (size, fn, /**Boolean=*/ onEnter) {
      onEnter = typeof onEnter !== 'undefined' ? onEnter : true;
      this._screenSizeCallbacks[size][onEnter ? 'enter' : 'exit'].push(fn)
   },
   /**
    * Triggers sn:resize event. sn:resize is a convenient way to handle both window resize event and
    * sidebar state change.
    * Fired maximum once in 100 millis
    * @private
    */
   _initResizeEvent: function () {
      var resizeTimeout;

      $(window).on('resize', function () {
         clearTimeout(resizeTimeout);
         resizeTimeout = setTimeout(function () {
            $(window).trigger('sn:resize');
         }, 100);
      });
   },
   /**
    * Initiates an array of throttle onScreenSize callbacks.
    * @private
    */
   _initOnScreenSizeCallbacks: function () {
      var resizeTimeout,
              helpers = this,
              prevSize = this.getScreenSize();

      $(window).resize(function () {
         clearTimeout(resizeTimeout);
         resizeTimeout = setTimeout(function () {
            var size = helpers.getScreenSize();
            if (size != prevSize) { //run only if something changed
               //run exit callbacks first
               helpers._screenSizeCallbacks[prevSize]['exit'].forEach(function (fn) {
                  fn(size, prevSize);
               });
               //run enter callbacks then
               helpers._screenSizeCallbacks[size]['enter'].forEach(function (fn) {
                  fn(size, prevSize);
               });
               console.log('screen changed. new: ' + size + ', old: ' + prevSize);
            }
            prevSize = size;
         }, 100);
      });
   }
};

app.helpers = new Helpers();

appControllers.controller('BMAppController', ['$scope', '$localStorage', 'AuthFactory', '$q', '$http', function ($scope, $localStorage, AuthFactory, $q, $http) {
      var self = this;
      self.Feedback = new Feedback({'$http': $http, 'AuthFactory': AuthFactory});
      //fix below for self
      $scope.app = app;
      $scope.logout = AuthFactory.logout;
      AuthFactory.isLoggedIn(true).then(function (response) {
         console.log(AuthFactory);
         $scope.user = response;
      });
   }]);
var Feedback = function (dep) {
   var self = this;

   self.FeedbackModalVisible = false;

   self.feedback = {
      username: '',
      email: '',
      url: '',
      useragent: '',
      platform: '',
      contact: '',
      message: ''
   };


   self.submitBtn = 'Submit';
   self.success = false;

   self.showFeedbackModal = function () {
      self.feedback.message = '';
      self.submitBtn = 'Submit';
      self.success = false;

      self.feedback.url = window.location.href;
      self.feedback.useragent = navigator.userAgent;
      self.feedback.platform = navigator.platform;
      dep.AuthFactory.getInfo().then(function (response) {
         self.feedback.username = response.credentials.username;
         self.feedback.email = response.credentials.email;
      });
      self.FeedbackModalVisible = !self.FeedbackModalVisible;
   };

   self.submitFeedback = function () {
      self.submitBtn = 'Submitting...';
      dep.$http.post('feedback/apisubmit', self.feedback).then(function (success) {
         self.submitBtn = 'Success!';
         self.success = true;
      }, function (fail) {
         self.submitBtn = 'Failed';
      });
   };
};
'use strict';

/* Services */

// Define your services here if necessary
var appServices = angular.module('app.services', []);

appServices.factory('GuidCreator', function () {
   return{
      CreateGuid: CreateGuid
   }
   function CreateGuid() {
      function s4() {
         return Math.floor((1 + Math.random()) * 0x10000)
                 .toString(16)
                 .substring(1);
      }
//      return s4() + s4() + '-' + s4() + '-' + s4() + '-' + s4() + '-' + s4() + s4() + s4();

      return s4() + s4();
   }
});


/**
 * Override default angular exception handler to log and alert info if debug mode
 */
appServices.factory('$exceptionHandler', ['$log', function ($log) {
      return function (exception, cause) {
         var errors = JSON.parse(localStorage.getItem('bm-angular-errors')) || {};
         errors[new Date().getTime()] = arguments;
         localStorage.setItem('bm-angular-errors', JSON.stringify(errors));
         app.debug && $log.error.apply($log, arguments);
      };
   }]);
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
appServices.factory('AuthFactory', ['$http', '$state', '$q', '$localStorage', '$timeout', function ($http, $state, $q, $localStorage, $timeout) {

      var url = 'auth/';

      var factory = {
         user: null,
         isLoggedIn: isLoggedIn,
         getInfo: getInfo,
         logout: logout,
         forgot: forgot,
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
            $localStorage.user = null;
            changeUser(null);
            $state.go('login');
         }, function (response) {
            $state.go('error');
         });
      }

      function login(user, success, error) {

         $http.post(url + 'login', user).then(function (response) {
            console.log(response);
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
      function forgot(user, success, error) {
         $http.post(url + 'forgot', user).success(function (user) {
            success(user);
         }).error(function (err) {
            error(err);
         });
      }

      function isLoggedIn(get) {
         return $http.post(url + 'getuser').then(function (response) {
            console.log(response);
            changeUser(response.data.data);
            if (get == true) {
               return response.data.data;
            }
         }, function (response) {
            changeUser(null);
            return $state.go('login');
         });
      }
      function getInfo() {
         if ($localStorage.user == null || factory.user == null) {
            console.log('server')

            return factory.isLoggedIn(true);
         } else {
            factory.user = $localStorage.user;
            return $q.when(factory.user);
         }
      }

   }]);
/**
 * Core Sign directives. Sing framework is built on top of them
 */

'use strict';
var appDirectives = angular.module('app.directives', []);
/**
 * Sing Directives
 * sn: - Sing angular namespace
 */

/**
 * Prevent default links behaviour so it won't cause unwanted url changes for angular
 */
appDirectives.directive('body', function () {
   return {
      restrict: 'E',
      link: function (scope, $element) {
         // prevent unwanted navigation
         $element.on('click', 'a[href=#]', function (e) {
            e.preventDefault();
         })
      }
   }
});
/* ========================================================================
 * Sing App actions. Shortcuts available via data-sn-action attribute
 * ========================================================================
 */



appDirectives.directive('bmAction', ['$rootScope', function ($rootScope) {
      var bmActions = {
         'toggle-left-sidebar': function (e, scope) {
            scope.app.state['sidebar-left'] = !scope.app.state['sidebar-left'];
         }
      }

      return {
         restrict: 'A',
         link: function (scope, $el, attrs) {
            if (angular.isDefined(attrs.bmAction) && attrs.bmAction != '') {
               $el.on('click', function (e) {

                  scope.$apply(function () {
                     bmActions[attrs.bmAction].call($el[0], e, scope);
                  });
                  e.preventDefault();
               });
            }

            if (angular.isDefined(attrs.tooltip) && attrs.bmAction != '') {
               $el.tooltip();
            }
         }
      }
   }]);
appDirectives.directive('bmSidebarScroll', ['scriptLoader', function (scriptLoader) {
      return function (scope, element, attrs) {
         function render() {
            $(element).niceScroll({
               cursorcolor: "#6181a2",
               cursorborder: "0px solid #fff",
               cursorborderradius: "0px",
               cursorwidth: "5px"
            });
            $(element).getNiceScroll().resize();
            if ($('.sidebar-left').hasClass('hide-left-bar')) {
               $(element).getNiceScroll().hide();
            }
            $(element).getNiceScroll().show();
         }

         scriptLoader.loadScripts(['http://www.bookmasters.com/CDN/bower_components/jquery.nicescroll/dist/jquery.nicescroll.min.js'], 'sidebar').then(render);
      };
   }]);
appDirectives.directive('bmNavigation', ['$timeout', '$rootScope', '$state', function ($timeout, $rootScope, $state) {
      var BmNavigationDirective = function ($el, scope) {
         this.$el = $el;
         this.scope = scope;
         this.helpers = scope.app.helpers;
         $rootScope.changeNavigationItem = $.proxy(this.changeNavigationItem, this);
      };
      BmNavigationDirective.prototype = {
         collapseLeftSidebar: function () {
            $(this.$el).addClass('hide-left-bar');
            $("#main-content").addClass('merge-left');
            this.scope.app.state['sidebar-left'] = false;
         },
         expandLeftSidebar: function () {
            $(this.$el).addClass('hide-left-bar');
            $("#main-content").addClass('merge-left');
            this.scope.app.state['sidebar-left'] = true;
         },
         toggleLeftSidebar: function () {

            $(this.$el).toggleClass('hide-left-bar');
            if ($(this.$el).hasClass('hide-left-bar')) {
               //            $("#innersidebar").getNiceScroll().hide();
            }
            //         $("#innersidebar").getNiceScroll().show();
            $('#main-content').toggleClass('merge-left');
            if ($('#container').hasClass('open-right-panel')) {
               $('#container').removeClass('open-right-panel')
            }
            if ($('.sidebar-right').hasClass('open-right-bar')) {
               $('.sidebar-right').removeClass('open-right-bar')
            }

            if ($('.header').hasClass('merge-header')) {
               $('.header').removeClass('merge-header')
            }

         },
         checkLeftSidebarState: function () {
            return this.scope.app.state['sidebar-left'];
         },
         checkRightSidebarState: function () {
            return this.scope.app.state['sidebar-right'];
         },
         changeNavigationItem: function (event, toState, toParams) {

            var $newActiveLink = this.$el.find('a[href="' + $state.href(toState, toParams) + '"]');
            // collapse .collapse only if new and old active links belong to different .collapse
            if (!$newActiveLink.is('.active > .collapse > li > a')) {
               this.$el.find('.active .active').closest('.collapse').collapse('hide');
            }
            this.$el.find('#innersidebar .active').removeClass('active');
            //
            $newActiveLink.closest('li').addClass('active').parents('li').addClass('active').addClass('open');
            // uncollapse parent
            $newActiveLink.closest('.collapse').addClass('in').siblings('a[data-toggle=collapse]').removeClass('collapsed');
         },
      };
      return {
         link: function (scope, $el) {
            var BmNav = new BmNavigationDirective($el, scope);
            $timeout(function () {
               // set active navigation item

               BmNav.changeNavigationItem({}, $state.$current, $state.params);
               $rootScope.$on('$stateChangeStart', $.proxy(BmNav.changeNavigationItem, BmNav));
               $el.find('.collapse').on('show.bs.collapse', function (e) {
                  // execute only if we're actually the .collapse element initiated event
                  // return for bubbled events
                  if (e.target != e.currentTarget)
                     return;
                  var $triggerLink = $(this).prev('[data-toggle=collapse]');
                  $($triggerLink.data('parent')).find('.collapse.in').not($(this)).collapse('hide');
               })
                       /* adding additional classes to navigation link li-parent for several purposes. see navigation styles */
                       .on('show.bs.collapse', function (e) {

                          // execute only if we're actually the .collapse element initiated event
                          // return for bubbled events
                          if (e.target != e.currentTarget)
                             return;
                          $(this).closest('li').addClass('open');
                       }).on('hide.bs.collapse', function (e) {
                  // execute only if we're actually the .collapse element initiated event
                  // return for bubbled events
                  if (e.target != e.currentTarget)
                     return;
                  $(this).closest('li').removeClass('open');
               });
            });
            scope.$watch('app.state["sidebar-left"]', function (newVal, oldVal) {
               if (newVal == oldVal) {
                  return;
               }
               BmNav.toggleLeftSidebar();
            });
            $('.header,#main-content,.sidebar-left').click(function () {
               if ($('#container').hasClass('open-right-panel')) {
                  $('#container').removeClass('open-right-panel')
               }
               if ($('.sidebar-right').hasClass('open-right-bar')) {
                  $('.sidebar-right').removeClass('open-right-bar')
               }

               if ($('.header').hasClass('merge-header')) {
                  $('.header').removeClass('merge-header')
               }


            });
         }
      }

   }]);


/* ========================================================================
 * Sing App Navigation (Sidebar)
 * ========================================================================
 */




appDirectives.directive("bsRadio", ['$compile', '$timeout', function ($compile, $timeout) {


      return {
         restrict: 'E',
         scope: {
            model: '=',
            value: '@',
            label: '@',
            name: '@',
         },
         template: '' +
                 '<div class="radio radio-primary">' +
                 '<input type="radio" name="name" ng-model="model" value="value" ng-checked="model==value" ng-click="model=value">' +
                 '<label name="name" ng-click="model=value">' +
                 '{{label}}{{model==value}}' +
                 '</label>' +
                 '</div>',
         compile: function (tElt) {
            tElt.addClass('bs-radio');
         }
      };


   }]);




appDirectives.directive("modalShow", function () {
   return {
      restrict: "A",
      scope: {
         modalVisible: "="
      },
      link: function (scope, element, attrs) {

         //Hide or show the modal
         scope.showModal = function (visible) {
            if (visible) {
               element.modal("show");
            } else {
               element.modal("hide");
            }
         }

         //Check to see if the modal-visible attribute exists
         if (!attrs.modalVisible) {
            //The attribute isn't defined, show the modal by default
            scope.showModal(true);
         } else {
            //Watch for changes to the modal-visible attribute
            scope.$watch("modalVisible", function (newValue, oldValue) {
               scope.showModal(newValue);
            });
            //Update the visible value when the dialog is closed through UI actions (Ok, cancel, etc.)
            element.bind("hide.bs.modal", function () {
               scope.modalVisible = false;
               if (!scope.$$phase && !scope.$root.$$phase) {
                  scope.$apply();
               }
            });
         }
      }
   };
});
var appWrappers = angular.module('app.wrappers', []);
appWrappers.directive('datetimepicker', ['$timeout', '$parse', function ($timeout, $parse) {
      return {
         link: function ($scope, element, $attrs) {
            return $timeout(function () {
               var ngModelGetter = $parse($attrs['ngModel']);
               var options = $scope.$eval($attrs.datetimepickerOptions) || {};
               options.allowInputToggle = true;
               options.useCurrent = false;
               options.icons = {
                  time: 'fa fa-clock-o',
                  date: 'fa fa-calendar',
                  up: 'fa fa-chevron-up',
                  down: 'fa fa-chevron-down',
                  previous: 'fa fa-chevron-left',
                  next: 'fa fa-chevron-right',
                  today: 'fa fa-screenshot',
                  clear: 'fa fa-trash',
                  close: 'fa fa-times'
               };
               

               return $(element).datetimepicker(options).on('dp.change', function (event) {
                  $scope.$apply(function () {
                     return ngModelGetter.assign($scope, event.target.value);
                  });
               });
            });
         }
      };
   }
]);

var appValidators = angular.module('app.validators', []);

appValidators.directive('showErrors', ['$timeout', 'showErrorsConfig', '$interpolate', function ($timeout, showErrorsConfig, $interpolate) {
      var getShowSuccess, getTrigger, linkFn;
      var errors = {
         isbnValidate: 'The ISBN you supplied is invalid',
         bmPassword: 'Your password must contain a lowercase and uppercase letter, numbers, and 8 or more characters long',
         bmWebsite: 'Please enter a valid URL. Example: http://bookmasters.com',
         required: 'This field is required',
         minlength: 'Your input is too short',
         maxlength: 'Your input is too long',
         email: 'Your email address is invalid',
         number: 'Your input is not a number',
         price: 'The given amount is invalid. Ex 125,944.10',
      };
      getTrigger = function (options) {
         var trigger;
         trigger = showErrorsConfig.trigger;
         if (options && (options.trigger != null)) {
            trigger = options.trigger;
         }
         return trigger;
      };
      getShowSuccess = function (options) {
         var showSuccess;
         showSuccess = showErrorsConfig.showSuccess;
         if (options && (options.showSuccess != null)) {
            showSuccess = options.showSuccess;
         }
         return showSuccess;
      };
      linkFn = function (scope, el, attrs, formCtrl) {
         var blurred, inputEl, inputName, inputNgEl, options, showSuccess, toggleClasses, trigger;

         blurred = false;
         options = scope.$eval(attrs.showErrors);
         showSuccess = getShowSuccess(options);
         trigger = getTrigger(options);
         inputEl = el[0].querySelector('.form-control[name]');
         inputNgEl = angular.element(inputEl);
         inputName = $interpolate(inputNgEl.attr('name') || '')(scope);
         if (!inputName) {
            throw "show-errors element has no child input elements with a 'name' attribute and a 'form-control' class";
         }
         inputNgEl.bind(trigger, function () {
            blurred = true;
            return toggleClasses(formCtrl[inputName].$invalid);
         });
         scope.$watch(function () {

            return formCtrl[inputName] && formCtrl[inputName].$invalid;
         }, function (invalid) {

            if (!blurred) {
               return;
            }
            return toggleClasses(invalid);
         });
         scope.$on('show-errors-check-validity', function () {
            return toggleClasses(formCtrl[inputName].$invalid);
         });
         scope.$on('show-errors-reset', function () {
            return $timeout(function () {
               el.removeClass('has-error');
               el.removeClass('has-success');
               el.find('.help-block').remove();

               return blurred = false;
            }, 0, false);
         });
         return toggleClasses = function (invalid) {
            el.toggleClass('has-error', invalid);
            el.find('.help-block').remove();
            $.each(formCtrl[inputName].$error, function (item) {
               console.log(item);
               el.append('<span class="help-block">' + errors[item] + '</span>');
            });
            if (showSuccess) {
               return el.toggleClass('has-success', !invalid);
            }
         };
      };
      return {
         restrict: 'A',
         require: '^form',
         compile: function (elem, attrs) {
            if (attrs['showErrors'].indexOf('skipFormGroupCheck') === -1) {
               if (!(elem.hasClass('form-group') || elem.hasClass('input-group'))) {
                  throw "show-errors element does not have the 'form-group' or 'input-group' class";
               }
            }
            return linkFn;
         }
      };
   }
]).provider('showErrorsConfig', function () {
   var _showSuccess, _trigger;
   _showSuccess = false;
   _trigger = 'blur';
   this.showSuccess = function (showSuccess) {
      return _showSuccess = showSuccess;
   };
   this.trigger = function (trigger) {
      return _trigger = trigger;
   };
   this.$get = function () {
      return {
         showSuccess: _showSuccess,
         trigger: _trigger
      };
   };
});

appValidators.directive('bmValidateOptions', ['$http', '$parse', '$timeout', function ($http, $parse, $timeout) {
      return {
         restrict: 'A',
         require: 'ngModel',
         link: function ($scope, $element, $attrs, ngModel) {
            /*using push() here to run it as the last parser, after we are sure that other validators were run*/
            var ValidateOptions = $parse($attrs.bmValidateOptions);
            $.each(ValidateOptions(), function (k, value) {

               switch (value) {

                  case 'isbn':
                     ngModel.$parsers.push(function (viewValue) {
                        var formGroup = $element.parent().parent();
                        var inputGroupAddon = $element.siblings('.input-group-addon').children('i');

                        $timeout(function () {
                           inputGroupAddon.removeClass().addClass('fa fa-fw fa-refresh fa-spin');
                        }).then(function () {
                           $http.post('http://api.bookmasters.com/validation/isbn13', {isbn13: viewValue}).then(function () {
                              ngModel.$setValidity("isbnValidate", true);
                              inputGroupAddon.removeClass('fa-refresh fa-spin fa-close fa-question').addClass('fa-check');
                              formGroup.removeClass('has-error').addClass('has-success');
                           }, function () {
                              formGroup.removeClass('has-success');
                              inputGroupAddon.removeClass('fa-refresh fa-spin fa-check fa-question').addClass('fa-close');
                              ngModel.$setValidity("isbnValidate", false);

                           });
                        });
                        return viewValue;
                     });
                     break;

                  case 'bmpassword':
                     ngModel.$parsers.push(function (viewValue) {
                        var passwordRegex = /(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}/;
                        if (passwordRegex.test(viewValue)) {
                           ngModel.$setValidity("bmPassword", true);
                        } else {
                           ngModel.$setValidity("bmPassword", false);
                        }
                        return viewValue;
                     });

                     break;

                  case 'bmwebsite':
                     ngModel.$parsers.push(function (viewValue) {
                        var websiteRegex = /^(?:(?:https?|ftp):\/\/)(?:\S+(?::\S*)?@)?(?:(?!(?:10|127)(?:\.\d{1,3}){3})(?!(?:169\.254|192\.168)(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]+-?)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]+-?)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})))(?::\d{2,5})?(?:\/[^\s]*)?$/i;
                        if (websiteRegex.test(viewValue)) {
                           ngModel.$setValidity("bmWebsite", true);
                        } else {
                           ngModel.$setValidity("bmWebsite", false);
                        }
                        return viewValue;
                     });
                     break;
                  case 'price':
                     ngModel.$parsers.push(function (viewValue) {
                        var priceRegex = /^[0-9]{1,3}(?:,?[0-9]{3})*\.[0-9]{2}$/gm;
                        if (priceRegex.test(viewValue)) {
                           ngModel.$setValidity("price", true);
                        } else {
                           ngModel.$setValidity("price", false);
                        }
                        return viewValue;
                     });
                     break;

                  default:
                     break;
               }
            });
         }
      }
   }]);