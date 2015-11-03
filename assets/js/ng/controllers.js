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

appControllers.controller('BMAppController', ['$scope', '$localStorage', 'AuthFactory', '$q', function ($scope, $localStorage, AuthFactory, $q) {

      $scope.app = app;
      $scope.logout = AuthFactory.logout;

      AuthFactory.isLoggedIn(true).then(function (response) {
         $scope.user = response;
         console.log($scope.user);
      });

      $scope.$on('$stateChangeSuccess', function (event, toState, toParams, fromState, fromParams) {
         $scope.loginPage = toState.name == 'login';
         $scope.errorPage = toState.name == 'error';
         $(document).trigger('sn:loaded', [event, toState, toParams, fromState, fromParams]);
      })
   }]);

appControllers.controller('FeedbackController', [function () {
      var self = this;

      self.url = window.location.href;
      self.useragent = navigator.userAgent;
      self.platform = navigator.platform;
      self.description = '';


   }]);