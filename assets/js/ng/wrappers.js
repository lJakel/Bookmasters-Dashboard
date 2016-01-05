var appWrappers = angular.module('app.wrappers', []);


appWrappers.directive('datetimepicker', ['$timeout', function ($timeout) {
      return {
         require: '?ngModel',
         restrict: 'EA',
         scope: {
            datetimepickerOptions: '@',
            onDateChangeFunction: '&',
            onDateClickFunction: '&'
         },
         link: function ($scope, $element, $attrs, controller) {
            $element.on('dp.change', function () {
               $timeout(function () {
                  var dtp = $element.data('DateTimePicker');
                  controller.$setViewValue(dtp.date());
                  $scope.onDateChangeFunction();
               });
            });

            $element.on('click', function () {
               $scope.onDateClickFunction();
            });

            controller.$render = function () {
               if (!!controller && !!controller.$viewValue) {
                  var result = controller.$viewValue;
                  $element.data('DateTimePicker').date(result);
               }
            };

            var options = $scope.$eval($attrs.datetimepickerOptions) || {};
            console.log(options)
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
            }
            options.allowInputToggle = true;
            $element.datetimepicker(options);
         }
      };
   }
]);
appWrappers.directive('summernote', function (scriptLoader) {
   //simple summernote directive

   return {
      restrict: 'A',
      require: '?ngModel',
      priority: 10,
      link: function (scope, element, attrs, ngModel) {

         scriptLoader.loadScripts([
            'http://www.bookmasters.com/CDN/bower_components/summernote/dist/summernote.min.js',
         ], 'partial').then(summernoteInit);
         function summernoteInit() {
            if (!ngModel)
               return;
            var options = {
               toolbar: [
                  ['style', ['bold', 'italic', 'underline', 'clear']],
                  ['para', ['ul', 'ol']]
               ],
               height: 150,
               styleWithSpan: false,
               callbacks: {
                  onBlur: function () {
                     ngModel.$setViewValue($summernote.summernote('code'));
                     return;
                  }
               },
            };
            var $summernote = $(element).summernote(options);
            scope.$watch(attrs.ngModel, function (newVal, oldVal) {
               $summernote.summernote("code", newVal);
            });
         }
      }
   }
});