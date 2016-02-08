BMApp.register.controller('NewTitleForm',
        ['scriptLoader', '$scope', '$rootScope', '$timeout', 'FixedReferences', '$stateParams', 'GuidCreator', 'Upload', 'NewTitleDraftsFactory', 'toasty', 'toasty',
           function (scriptLoader, $scope, $rootScope, $timeout, FixedReferences, $stateParams, GuidCreator, Upload, NewTitleDraftsFactory, toasty, toasty) {
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


              vm.References = {
                 FixedAuthorRoles: [],
                 FixedProductTypes: [],
                 FixedEditionTypes: [],
                 FixedAudienceTypes: [],
                 FixedAgeRanges: [],
                 FixedBisacGroups: [],
                 FixedISOCountryCodes: [],
                 FixedISOLanguageCodes: [],
                 FixedDiscountCodes: []
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

                 $('a[data-target="#basic"]').tab('show');
                 vm.isValid = false;
                 vm.Notified = false;
                 $timeout(function () {

                    vm.ValidFormWatch = [
                       'NTFNGForm.BasicInfoFormPanel.$valid',
                       function () {
                          return (vm.Formats.Model.Formats.length > 0);
                       },
                       function () {
                          return (vm.Contributors.Model.Contributors.length > 0);
                       },
                       function () {
                          return (vm.Demographics.ValidSubject);
                       },
                       'NTFNGForm.BasicInfoExtendedFormPanel.$valid',
                       'NTFNGForm.MarketingFormPanel.$valid',
                       'NTFNGForm.CoversFormPanel.$valid',
                    ];
                    $scope.$watchGroup(vm.ValidFormWatch, function (newValues) {
                       if (newValues.indexOf(false) == -1) {
                          vm.isValid = true;
                          if (!vm.Notified) {
                             toasty.info({title: 'Well Done!', msg: 'You have completed the minimum specifications to submit your new title!', theme: 'bootstrap', timeout: 8000});
                             vm.Notified = true;
                          }
                       } else {
                          vm.isValid = false;
                       }

                    });
                 });


                 vm.BasicInfo = /******/new BasicInfo /******/(vm.data.BasicInfo || '', vm.Dependencies, vm.References);
                 vm.Contributors = /***/new Contributors /***/(vm.data.Contributors.Contributors || '', vm.Dependencies, vm.References);
                 vm.Formats = /********/new Formats /********/(vm.data.Formats.Formats || '', vm.Dependencies, vm.References);
                 vm.Demographics = /***/new Demographics /***/(vm.data.Demographics || '', vm.Dependencies, vm.References);
                 vm.Marketing = /******/new Marketing /******/(vm.data.Marketing || '', vm.Dependencies, vm.References);
                 vm.Covers = /*********/new Covers /*********/(vm.data.Covers || '', vm.Dependencies, vm.References);
                 vm.Drafts = /*********/new Drafts /*********/(vm, vm.Dependencies);

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
                 $timeout(function () {
                    $('[data-toggle="popover"]').popover();
                 });
              }

              FixedReferences.GetDiscountCodes(function (successResponse) {
                 vm.References.FixedDiscountCodes = successResponse;
              });
              FixedReferences.GetFixedReferences().then(function (successResponse) {
                 vm.References.FixedAuthorRoles = successResponse.FixedAuthorRoles;
                 vm.References.FixedProductTypes = successResponse.FixedProductTypes;
                 vm.References.FixedEditionTypes = successResponse.FixedEditionTypes;
                 vm.References.FixedAudienceTypes = successResponse.FixedAudienceTypes;
                 vm.References.FixedAgeRanges = successResponse.FixedAgeRanges;
                 vm.References.FixedBisacGroups = successResponse.FixedBisacGroups;
                 vm.References.FixedISOCountryCodes = successResponse.FixedISOCountryCodes;
                 vm.References.FixedISOLanguageCodes = successResponse.FixedISOLanguageCodes;
                 init();
              });
           }]);