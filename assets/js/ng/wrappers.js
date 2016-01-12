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
               console.log(options)

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