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

appDirectives.directive('bmAction', function ($rootScope) {
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
});
/* ========================================================================
 * Sing App Navigation (Sidebar)
 * ========================================================================
 */




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

         scriptLoader.loadScripts(['http://www.bookmasters.com/CDN/js/nicescroll/dist/jquery.nicescroll.min.js'], 'sidebar').then(render);
      };
   }]);
appDirectives.directive('bmNavigation', function ($timeout, $rootScope, $state) {
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

});
/*
 * Directives-wrappers for 3rd-party plugins & classes
 */


appDirectives.directive('ngWebsiteUrl', function () {

   return {
      restrict: 'A',
      require: 'ngModel',
      link: function ($scope, $element, $attrs, ngModel) {


         ngModel.$parsers.push(function (viewValue) {

            return viewValue;
         });
         $scope.$watch($attrs.ngModel, function (value) {


            var val = value.replace(/^\s+|\s+$/, '');
            var isValid = (val.match(/^(?:(?:https?|ftp):\/\/)(?:\S+(?::\S*)?@)?(?:(?!(?:10|127)(?:\.\d{1,3}){3})(?!(?:169\.254|192\.168)(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]+-?)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]+-?)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})))(?::\d{2,5})?(?:\/[^\s]*)?$/i));
            if (isValid === null) {
               ngModel.$setValidity('websiteUrl', false);
            } else {
               ngModel.$setValidity('websiteUrl', true);
            }
         });
      }
   }
});
appDirectives.directive('bmValidate', function ($http, $parse, $timeout) {

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
                     $timeout(function () {
                        $element.parent().parent().removeClass('has-success has-error');
                        $element.siblings('.input-group-addon').children('i').removeClass().addClass('fa fa-fw fa-refresh fa-spin');
                     }).then(function () {
                        $http.post('http://api.bookmasters.com/util/checkIsbn13', {isbn13: viewValue}).then(function () {
                           ngModel.$setValidity("isbnValidate", true);
                           $element.siblings('.input-group-addon').children('i').removeClass('fa-refresh fa-spin fa-close fa-question').addClass('fa-check');
                           $element.parent().parent().removeClass('has-error').addClass('has-success');
                        }, function () {
                           ngModel.$setValidity("isbnValidate", false);
                           $element.parent().parent().removeClass('has-success');
                           $element.siblings('.input-group-addon').children('i').removeClass('fa-refresh fa-spin fa-check fa-question').addClass('fa-close');
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


               default:
                  break;
            }
         });
      }
   }
});


appDirectives.directive('showErrors', [
   '$timeout', 'showErrorsConfig', '$interpolate', function ($timeout, showErrorsConfig, $interpolate) {
      var getShowSuccess, getTrigger, linkFn;
      var errors = {
         isbnValidate: 'The ISBN you supplied is invalid',
         bmPassword: 'Your password must contain a lowercase and uppercase letter, numbers, and more than 8 characters long',
         required: 'This field is requierd',
         minlength: 'Your input is too short',
         maxlength: 'Your input is too long',
         email: 'Your email address is invalid',
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
         //console.log(el)
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
               return blurred = false;
            }, 0, false);
         });
         return toggleClasses = function (invalid) {
            el.toggleClass('has-error', invalid);
            el.find('.help-block').remove();
            $.each(formCtrl[inputName].$error, function (item) {
               console.log(item)
               el.append('<span class="help-block">' + errors[item] + '</span>')
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
appDirectives.directive("bscheck", function () {
   return {
      restrict: "C",
      link: function (scope, element, attrs) {
         $(element).selectpicker();
      }
   }
});
appDirectives.directive("bsradio", function () {

   return {
      restrict: 'A',
      transclude: true,
      replace: false,
      require: 'ngModel',
      link: function ($scope, $element, $attr, require) {


         var ngModel = require;
         $element.on('change', function () {
            updateModelFromElement();
         });
         var updateModelFromElement = function () {
            // If modified
            var checked = $element.prop('checked');
            if (checked != ngModel.$viewValue) {
               // Update ngModel
               $element.prop('checked', checked)

               ngModel.$setViewValue(checked);
            }
         }

         // Update input from Model
         var updateElementFromModel = function () {
            // Update button state to match model
            $element.trigger('change');
         };
         // Observe: Element changes affect Model
         //       
         // Observe: ngModel for changes
         $scope.$watch(function () {
            return ngModel.$viewValue;
         }, function () {
            updateElementFromModel();
         });
      }
   }
});
appDirectives.directive('selectpicker', ['$parse', '$timeout', function ($parse, $timeout) {
      return {
         restrict: 'A',
         priority: 1000,
         link: function (scope, element, attrs) {
            function refresh(newVal) {

               scope.$applyAsync(function () {
                  if (attrs.ngOptions && /track by/.test(attrs.ngOptions)) {
                     element.val(newVal);
                  }
                  refreshLog('Initial refresh function');
               });
            }

            attrs.$observe('spTheme', function (val) {
               $timeout(function () {
                  element.data('selectpicker').$button.removeClass(function (i, c) {
                     return (c.match(/(^|\s)?btn-\S+/g) || []).join(' ');
                  });
                  element.selectpicker('setStyle', val);
               });
            });
            $timeout(function () {
               element.selectpicker($parse(attrs.selectpicker)());
               refreshLog('Timeout thing idk');
            });
            if (attrs.ngModel) {
               scope.$watch(attrs.ngModel, refresh, false);
            }

            if (attrs.ngDisabled) {
               scope.$watch(attrs.ngDisabled, refresh, true);
            }

            if (attrs['options']) {
               scope.$watch(attrs['options'], function (value) {
                  if (value) {
                     scope.$applyAsync(function () {
                        refreshLog('New Options Attr');
                     });
                  }
               }, true);
            }

            function refreshLog(message) {
//               console.log("Refreshed selectpicker - " + message);
               element.selectpicker('refresh');
            }

            scope.$on('$destroy', function () {
               $timeout(function () {
                  element.selectpicker('destroy');
               });
            });
         }
      };
   }]);
appDirectives.directive('toggle', function () {
   return {
      restrict: 'ACE',
      priority: 101,
      link: function (scope, element, attrs) {
         var toggleFn = function (e) {
            var parent = angular.element(this).parent();
            angular.element('.bootstrap-select.open', element)
                    .not(parent)
                    .removeClass('open');
            parent.toggleClass('open');
         };
         element.on('click.bootstrapSelect', '.dropdown-toggle', toggleFn);
         scope.$on('$destroy', function () {
            element.off('.bootstrapSelect');
         });
      }
   };
});
appDirectives.directive('summernote', function (scriptLoader) {
   //simple summernote directive

   return {
      restrict: 'A',
      require: '?ngModel',
      priority: 10,
      link: function (scope, element, attrs, ngModel) {

         scriptLoader.loadScripts([
            'http://www.bookmasters.com/CDN/js/summernote/dist/summernote.min.js',
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
               onBlur: function (event) {
                  ngModel.$setViewValue($summernote.code())
                  return;
               },
            };
            var $summernote = $(element).summernote(options);
            scope.$watch(attrs.ngModel, function (newVal, oldVal) {
               $summernote.code(newVal);
            });
         }
      }
   }
});
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
/**
 * Flatlogic comment:
 * Here goes an extension to jQuery Passthrough(http://angular-ui.github.io/ui-utils/) plugin.
 * Sing extension allows to dynamically load library used by ui-jq directive.
 * So for example in this case:
 * @example <input ui-jq="datepicker" ui-options="{showOn:'click'},secondParameter,thirdParameter" ui-refresh="iChange">
 *
 * datepicker library will be loaded dynamically and plugin initialization will take place only after datepicker exists
 * in jQuery scope.
 * There is a global value - uiJqDependencies which is defined in app.js. It's a map of jquery plugin name and it's dependencies.
 * It's also possible to pass dependencies via ui-preload attribute. See mapael example in index.html
 */
/**
 * General-purpose jQuery wrapper. Simply pass the plugin name as the expression.
 *
 * It is possible to specify a default set of parameters for each jQuery plugin.
 * Under the jq key, namespace each plugin by that which will be passed to ui-jq.
 * Unfortunately, at this time you can only pre-define the first parameter.
 * @example { jq : { datepicker : { showOn:'click' } } }
 *
 * @param ui-jq {string} The $elem.[pluginName]() to call.
 * @param [ui-options] {mixed} Expression to be evaluated and passed as options to the function
 *     Multiple parameters can be separated by commas
 * @param [ui-refresh] {expression} Watch expression and refire plugin on changes
 *
 * @example <input ui-jq="datepicker" ui-options="{showOn:'click'},secondParameter,thirdParameter" ui-refresh="iChange">
 */
angular.module('ui.jq', []).
        value('uiJqConfig', {}).
        value('uiJqDependencies', {}).
        directive('uiJq', ['uiJqConfig', '$timeout', 'uiJqDependencies', 'scriptLoader',
           function uiJqInjectingFunction(uiJqConfig, $timeout, uiJqDependencies, scriptLoader) {

              return {
                 restrict: 'A',
                 compile: function uiJqCompilingFunction(telem, tAttrs) {

                    if (!(angular.isFunction(telem[tAttrs.uiJq]) || angular.isArray(uiJqDependencies[tAttrs.uiJq]))) {
                       throw new Error('ui-jq: The "' + tAttrs.uiJq + '" function does not exist');
                    }
                    var options = uiJqConfig && uiJqConfig[tAttrs.uiJq];
                    return function uiJqLinkingFunction(scope, elem, attrs) {

                       // If change compatibility is enabled, the form input's "change" event will trigger an "input" event
                       if (attrs.ngModel && elem.is('select,input,textarea')) {
                          elem.bind('change', function () {
                             elem.trigger('input');
                          });
                       }

                       // Call jQuery method and pass relevant options
                       function callPlugin() {
                          $timeout(function () {
                             var linkOptions = [];
                             // If ui-options are passed, merge (or override) them onto global defaults and pass to the jQuery method
                             if (attrs.uiOptions) {
                                linkOptions = scope.$eval('[' + attrs.uiOptions + ']');
                                if (angular.isObject(options) && angular.isObject(linkOptions[0])) {
                                   linkOptions[0] = angular.extend({}, options, linkOptions[0]);
                                }
                             } else if (options) {
                                linkOptions = [options];
                             }
                             elem[attrs.uiJq].apply(elem, linkOptions);
                          }, 0, false);
                       }

                       // If ui-refresh is used, re-fire the the method upon every change
                       if (attrs.uiRefresh) {
                          scope.$watch(attrs.uiRefresh, function () {
                             callPlugin();
                          });
                       }

                       // Sing addition. If there jQuery functions is defined, then just calling plugin
                       // if there is no jQuery function, then loading it first from uiJqDependencies object
                       // defined in app.js
                       var scriptsFromOptions = scope.$eval(tAttrs.uiPreload) || [];
                       if (angular.isFunction(telem[tAttrs.uiJq])) {
                          if (scriptsFromOptions.length > 0) {
                             scriptLoader.loadScripts(scriptsFromOptions)
                                     .then(callPlugin);
                          } else {
                             callPlugin();
                          }
                       } else {
                          var scriptsToLoad = uiJqDependencies[tAttrs.uiJq].concat(scriptsFromOptions);
                          scriptLoader.loadScripts(scriptsToLoad)
                                  .then(callPlugin);
                       }
                    };
                 }
              };
           }]);