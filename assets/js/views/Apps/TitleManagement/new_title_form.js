BMApp.register.controller('NewTitleForm', ['scriptLoader', '$scope', '$timeout', 'FixedReferences', '$stateParams', 'partialCleanup', 'NewTitleDraftsFactory', 'GuidCreator', function (scriptLoader, $scope, $timeout, FixedReferences, $stateParams, partialCleanup, NewTitleDraftsFactory, GuidCreator) {
      var vm = this;
      // if ($stateParams.child) {
      //   alert($stateParams.child)
      // }

      function init() {

         partialCleanup.prepare(['BasicInfo', 'Contributors', 'Formats', 'Demographics', 'Marketing', 'Modals']);
         vm.Form = {
            DraftId: GuidCreator.CreateGuid(),
            ProductGroupId: null,
         }
         vm.BasicInfo = new BasicInfo(data.NewTitle.BasicInfo || '');
         vm.Contributors = new Contributors(data.NewTitle.Contributors.Contributors || '');
         vm.Formats = new Formats(data.NewTitle.Formats.Formats || '', $scope, $timeout);
         vm.Demographics = new Demographics(data.NewTitle.Demographics || '', FixedReferences);
         vm.Marketing = new Marketing(data.NewTitle.Marketing || '');

         vm.Drafts = [];

         vm.GetDrafts = function () {
            NewTitleDraftsFactory.GetDrafts().then(function (response) {
               console.log(response)
               vm.Drafts = $.map(response, function (item) {
                  return JSON.parse(item);
               });
            });
         };
         vm.GetDrafts();

         vm.ClearDrafts = function () {
            NewTitleDraftsFactory.ClearDrafts().then(function (response) {
               vm.Drafts = response
            });
         }
         vm.SaveDraft = function () {
            NewTitleDraftsFactory.SaveDraft({
               "Form": vm.Form,
               "BasicInfo": vm.BasicInfo.Model,
               "Contributors": vm.Contributors.Model,
               "Formats": vm.Formats.Model,
               "Demographics": vm.Demographics.Model,
               "Marketing": vm.Marketing.Model,
            }).then(function (response) {
               vm.Drafts = $.map(response, function (item) {
                  return JSON.parse(item);
               });
            });

         };

         vm.RefreshJson = function () {
            $('#jsonPre').text(JSON.stringify({
               "BasicInfo": (vm.BasicInfo),
               "Contributors": (vm.Contributors),
               "Formats": (vm.Formats),
               "Demographics": (vm.Demographics),
               "Marketing": (vm.Marketing),
            }));

         };

         FixedReferences.getReferences().then(function (response) {
            vm.Contributors.ContributorModal.FixedAuthorRoles = $.map(response.ContributorRoles, function (item) {
               return item;
            });
            vm.Formats.FormatModal.FixedProductTypes = $.map(response.FixedProductTypes, function (item) {
               return item;
            });
            vm.Formats.FormatModal.FixedProductForms = $.map(response.FixedProductForms, function (item) {
               return item;
            });
            vm.Formats.FormatModal.FixedProductFormDetails = $.map(response.FixedProductFormDetails, function (item) {
               return item;
            });
            vm.Formats.FormatModal.FixedProductFormDetailSpecifics = $.map(response.FixedProductFormDetailSpecifics, function (item) {
               return item;
            });
            vm.Formats.FormatModal.FixedEditionTypes = $.map(response.Editions, function (item) {
               return item;
            });
            console.log(response)
            vm.Demographics.FixedAudienceTypes = $.map(response.AudienceTypes, function (item) {
               return item;
            });
            //Where does PublicationStatuses go?
            //vm.Demographics.PublicationStatuses = $.map(response.PublicationStatuses, function (item) {
            //return item;
            //});
            vm.Demographics.FixedList = $.map(response.BisacGroups, function (item) {
               return item;
            });

         });
//
         FixedReferences.getIsoCodes().then(function (response) {
            vm.Formats.FormatModal.FixedIsoCodes = $.map(response, function (item) {
               return item;
            });
         });
         FixedReferences.getDiscountCodes().then(function (response) {
            vm.Formats.FormatModal.FixedDiscountCodes = $.map(response, function (item) {
               return item;
            });
         });

         $timeout(function () {
            $('[data-toggle="popover"]').popover();
         });

      }

      scriptLoader.loadScripts([
         'http://www.bookmasters.com/CDN/js/summernote/dist/summernote.min.js',
         'http://www.bookmasters.com/CDN/js/bs-filepicker/bs-filepicker.js',
         'http://www.bookmasters.com/CDN/js/trip.js/dist/trip.min.js',
      ], 'partial').then(init);
   }]);

//blank model
var data = {
   "NewTitle": {
      "BasicInfo": {},
      "Contributors": {},
      "Demographics": {},
      "Formats": {},
      "Marketing": {}
   },
};