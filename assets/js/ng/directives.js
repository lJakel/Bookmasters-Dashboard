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