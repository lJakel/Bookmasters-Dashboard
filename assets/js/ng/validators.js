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