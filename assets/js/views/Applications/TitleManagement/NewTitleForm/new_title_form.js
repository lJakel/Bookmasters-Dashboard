BMApp.register.controller('NewTitleForm',
        ['scriptLoader', '$scope', '$rootScope', '$timeout', 'FixedReferences', '$stateParams', 'GuidCreator', 'Upload', 'NewTitleDraftsFactory', 'toasty', '$localStorage', '$q', 'toasty',
           function (scriptLoader, $scope, $rootScope, $timeout, FixedReferences, $stateParams, GuidCreator, Upload, NewTitleDraftsFactory, toasty, $localStorage, $q, toasty) {
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

              vm.EmptyCache = function () {
                 $localStorage.FixedReferencesFactory = {};
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
                 vm.isValid = false;
                 vm.ValidSubject = false;
                 vm.ValidFormWatch = [
                    'NTFNGForm.BasicInfoFormPanel.$valid',
                    function () {
                       return (vm.Formats.Model.Formats.length > 0);
                    },
                    function () {
                       return (vm.Contributors.Model.Contributors.length > 0);
                    },
                    function () {
                       return (vm.Demographics.Model.Bisacs.length > 0);
                    },
                    'NTFNGForm.BasicInfoExtendedFormPanel.$valid',
                    'NTFNGForm.DemographicsFormPanel.$valid',
                    'NTFNGForm.MarketingFormPanel.$valid',
                    'NTFNGForm.CoversFormPanel.$valid',
                 ];
                 $scope.$watchGroup(vm.ValidFormWatch, function (newValues) {
                    if (newValues.indexOf(false) == -1) {
                       vm.isValid = true;
                    }
                    if (newValues[3] == true) {
                       vm.ValidSubject = true;
                    } else {
                       vm.ValidSubject = false;
                    }
                    console.log(vm.isValid, newValues);
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

              FixedReferences.GetFixedReferences(function (successResponse) {
                 vm.References.FixedAuthorRoles = successResponse.FixedAuthorRoles;
                 vm.References.FixedProductTypes = successResponse.FixedProductTypes;
                 vm.References.FixedEditionTypes = successResponse.FixedEditionTypes;
                 vm.References.FixedAudienceTypes = successResponse.FixedAudienceTypes;
                 vm.References.FixedAgeRanges = successResponse.FixedAgeRanges;
                 vm.References.FixedBisacGroups = successResponse.FixedBisacGroups;
                 vm.References.FixedISOCountryCodes = successResponse.FixedISOCountryCodes;
                 vm.References.FixedISOLanguageCodes = successResponse.FixedISOLanguageCodes;
                 init();
              }, function (errorResponse) {

              });



//                 FixedReferences.getDiscountCodes().then(function (FixedDiscountCodesResponse) {
//                    vm.References.FixedDiscountCodes = FixedDiscountCodesResponse;
//                 });


           }]);