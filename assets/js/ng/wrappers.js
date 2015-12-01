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








appWrappers.directive('bmSidebarScroll', ['scriptLoader', function (scriptLoader) {
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
appWrappers.directive('bmNavigation', function ($timeout, $rootScope, $state) {
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




appWrappers.directive('multiSelect', function (scriptLoader, $timeout) {
   //simple summernote directive

   return {
      restrict: 'AC',
      require: '?ngModel',
      link: function (scope, element, attrs, ngModel) {

         scriptLoader.loadScripts([
            'http://loudev.com/js/jquery.multi-select.js',
         ], 'partial').then(multiselectInit);
         function multiselectInit() {


            function refresh(newVal) {

               scope.$applyAsync(function () {
                  if (attrs.ngOptions && /track by/.test(attrs.ngOptions)) {
                     element.val(newVal);
                  }
                  refreshLog('Initial refresh function');
               });
            }


            var options = {
//               afterSelect: function (values) {
//                  alert("Select value: " + values);
//               },
//               afterDeselect: function (values) {
//                  alert("Deselect value: " + values);
//               }

            };
            $timeout(function () {
               element.multiSelect(options);
               refreshLog('Timeout thing idk');
            });

//            scope.$watch(attrs.ngModel, function (newVal, oldVal) {
//               $multiSelect.code(newVal);
//            });


//            if (attrs.ngModel) {
//               scope.$watch(attrs.ngModel, refresh, false);
//            }

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
               element.multiSelect('refresh');
            }
            scope.$on('$destroy', function () {
               $timeout(function () {
                  element.multiSelect('destroy');
               });
            });
         }
      }
   }
});