BMApp.register.controller('NewTitleForm',
        ['scriptLoader', '$scope', '$rootScope', '$timeout', 'FixedReferences', '$stateParams', 'GuidCreator', 'Upload', 'NewTitleDraftsFactory', 'toasty',
           function (scriptLoader, $scope, $rootScope, $timeout, FixedReferences, $stateParams, GuidCreator, Upload, NewTitleDraftsFactory, toasty) {
              var vm = this;

              vm.Dependencies = {
                 scriptLoader: scriptLoader,
                 $scope: $scope,
                 $rootScope: $rootScope,
                 $timeout: $timeout,
                 FixedReferences: FixedReferences,
                 $stateParams: $stateParams,
                 toasty: toasty,
                 NewTitleDraftsFactory: NewTitleDraftsFactory,
                 Upload: Upload
              };

              vm.data = {
                 "BasicInfo": {
                    Publisher: 'h.f.ullmann'
                 },
                 "Contributors": {},
                 "Demographics": {},
                 "Formats": {},
                 "Marketing": {}
              };
              vm.Form = {
                 DraftId: GuidCreator.CreateGuid(),
                 ProductGroupId: null,
                 CreationDate: moment().format('X')
              };
              function init() {
                 vm.BasicInfo = new BasicInfo(vm.data.BasicInfo || '', vm.Dependencies);
                 vm.Contributors = new Contributors(vm.data.Contributors.Contributors || '', vm.Dependencies);
                 vm.Formats = new Formats(vm.data.Formats.Formats || '', vm.Dependencies);
                 vm.Demographics = new Demographics(vm.data.Demographics || '', vm.Dependencies);
                 vm.Marketing = new Marketing(vm.data.Marketing || '', vm.Dependencies);
                 vm.Covers = new Covers(vm.data.Covers || '', vm.Dependencies);
                 vm.Drafts = new Drafts(vm, vm.Dependencies);

                 vm.LoadDraft = function (Draft) {
                    vm.Form.DraftId = Draft.DraftId;
                    vm.Form.ProductGroupId = Draft.ProductGroupId;
                    vm.Form.CreationDate = Draft.CreationDate;
                    vm.data = JSON.parse(Draft.Content);
                    init();
                 };

                 vm.RefreshJson = function () {
                    $('#jsonPre').text(JSON.stringify({
                       "Form": vm.Form,
                       "BasicInfo": vm.BasicInfo.Model,
                       "Contributors": vm.Contributors.Model,
                       "Formats": vm.Formats.Model,
                       "Demographics": vm.Demographics.Model,
                       "Marketing": vm.Marketing.Model,
                       "Covers": vm.Covers.Model
                    }));
                 };


                 FixedReferences.getReferences().then(function (response) {
                    vm.Contributors.ContributorModal.FixedAuthorRoles = response.ContributorRoles;
                    vm.Formats.FormatModal.FixedProductTypes = response.FixedProductTypes;
                    console.log(response.FixedProductTypes);
                    vm.Formats.FormatModal.FixedEditionTypes = response.Editions;
                    vm.Demographics.FixedAudienceTypes = response.AudienceTypes;
                    vm.Demographics.FixedList = response.BisacGroups;
                 });

                 FixedReferences.getIsoCodes().then(function (response) {
                    vm.Formats.FormatModal.FixedIsoCodes = response.codes;
                 });
                 FixedReferences.getDiscountCodes().then(function (response) {
                    vm.Formats.FormatModal.FixedDiscountCodes = response;
                 });

                 $timeout(function () {
                    $('[data-toggle="popover"]').popover();
                 });

              }
              $timeout(function () {

              }).then(init);

           }]);