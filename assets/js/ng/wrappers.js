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
