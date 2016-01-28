BMApp.register.controller('NewTitleForm',
        ['scriptLoader', '$scope', '$rootScope', '$timeout', 'FixedReferences', '$stateParams', 'GuidCreator', 'Upload', 'NewTitleDraftsFactory',
           function (scriptLoader, $scope, $rootScope, $timeout, FixedReferences, $stateParams, GuidCreator, Upload, NewTitleDraftsFactory) {
              var vm = this;

              vm.Dependencies = {
                 scriptLoader: scriptLoader,
                 $scope: $scope,
                 $rootScope: $rootScope,
                 $timeout: $timeout,
                 FixedReferences: FixedReferences,
                 $stateParams: $stateParams,
                 Upload: Upload
              };
              function init() {
                 vm.Form = {
                    DraftId: GuidCreator.CreateGuid(),
                    ProductGroupId: null,
                 };

                 vm.BasicInfo = new BasicInfo(data.NewTitle.BasicInfo || '', vm.Dependencies);
                 vm.Contributors = new Contributors(data.NewTitle.Contributors.Contributors || '', vm.Dependencies);
                 vm.Formats = new Formats(data.NewTitle.Formats.Formats || '', vm.Dependencies);
                 vm.Demographics = new Demographics(data.NewTitle.Demographics || '', vm.Dependencies);
                 vm.Marketing = new Marketing(data.NewTitle.Marketing || '', vm.Dependencies);
                 vm.Covers = new Covers(data.Covers || '', vm.Dependencies);
                 vm.Debug = NewTitleDraftsFactory.Debug;
                 vm.EmptyCache = function () {
                    NewTitleDraftsFactory.EmptyCache();
                 };
                 vm.SaveDraft = function () {
                    NewTitleDraftsFactory.SaveDraft({
                       "DraftId": vm.Form.DraftId,
                       "ProductGroupId": vm.Form.ProductGroupId,
                       "Content": {
                          "BasicInfo": vm.BasicInfo.Model,
                          "Contributors": vm.Contributors.Model,
                          "Formats": vm.Formats.Model,
                          "Demographics": vm.Demographics.Model,
                          "Marketing": vm.Marketing.Model,
                       }
                    });
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
                    vm.Formats.FormatModal.FixedProductForms = response.FixedProductForms;
                    vm.Formats.FormatModal.FixedProductFormDetails = response.FixedProductFormDetails;
                    vm.Formats.FormatModal.FixedProductFormDetailSpecifics = response.FixedProductFormDetailSpecifics;
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

//blank model
var data = {
   "NewTitle": {
      "BasicInfo": {
         "Publisher": "Awesome Publications INC.",
      },
      "Contributors": {},
      "Demographics": {},
      "Formats": {},
      "Marketing": {}
   },
};
data = {
   "NewTitle": {
      "BasicInfo": {
         "ProductGroupId": null,
         "Title": "Jakes Book of Memes",
         "Subtitle": "Test",
         "Publisher": "Jake",
         "Imprint": "Lol",
         "ContentLanguage": "English",
         "Series": "Starwars",
         "NumberinSeries": "3",
         "MainDescription": "hgfdsfdsf",
         "ShortDescription": "hgfdsfdsfdsfsdfds"
      },
      "Contributors": {
         "Contributors": [
            {
               "FirstName": "Jake",
               "MiddleName": "A",
               "LastName": "Ihasz",
               "Prefix": "Mr",
               "Suffix": "3rd",
               "Hometown": "Ashland",
               "Role": {
                  "Id": "1",
                  "Name": "Author"
               },
               "Biography": "sdfdsfdsfdsfdsfds",
               "IsRolePrimary": true,
               "IsTitlePrimary": true,
               "AdditionalTitles": [
                  {
                     "ISBN": "9780000000002",
                     "Title": "bv",
                  }
               ],
            }
         ]
      },
      "Formats": {
         "Formats": [
            {
               "ProductType": {
                  "Id": "3",
                  "Name": "Print"
               },
               "ProductForm": {
                  "Id": "12",
                  "Name": "Hardback",
                  "MediaTypeId": "3"
               },
               "ProductDetail": {
                  "Id": "4",
                  "Name": "Printed Case",
                  "FormId": "12"
               },
               "ProductBinding": "",
               "ISBN13": "9780000000002",
               "Width": 59,
               "Height": 59,
               "Spine": 59,
               "Weight": 59,
               "PublicationDate": "01/27/2016",
               "Copyright": "2012",
               "StockDueDate": "01/19/2016",
               "TradeSales": true,
               "Pages": 158,
               "CartonQuantity": 15,
               "USPrice": "12.90",
               "DiscountCode": null,
               "CustomsValue": null,
               "Edition": null,
               "EditionNumber": "15",
               "EditionType": {
                  "Id": "2",
                  "Name": "Revised"
               },
               "CountryofOrigin": "us",
               "PublicationLocation": null,
               "ComparableTitles": [
               ],
               "$$hashKey": "object:1132"
            }
         ]
      },
      "Demographics": {
         "Audience": "",
         "Bisacs": [
            {
               "FixedList": [
               ],
               "FixedList2": [
               ],
               "BisacGroup": {
                  "Id": "2",
                  "Prefix": "ARC",
                  "Name": "ARCHITECTURE",
                  "YearVersion": "2014",
                  "$$hashKey": 2
               },
               "Code": {
                  "Id": "48",
                  "Code": "ARC001000",
                  "Text": "ARCHITECTURE / Criticism",
                  "GroupId": "2",
                  "$$hashKey": 54
               },
               "Text": "",
               "Group": "",
               "LongName": "",
               "BisacID": "",
               "$$hashKey": "object:1078"
            }
         ],
         "AgeRange": ""
      },
      "Marketing": {
         "Websites": [
            {
               "URL": "http://google.com/",
               "Type": "",
               "$$hashKey": "object:219"
            }
         ],
         "MarketingAndPublicitys": [
            {
               "Type": "2",
               "Description": "jhl",
               "$$hashKey": "object:243"
            }
         ],
         "Reviews": [
            {
               "Name": "rev",
               "Publication": "fdsf",
               "Text": "sdfdsfsdfdsfdsf",
               "$$hashKey": "object:227"
            }
         ],
         "Endorsements": [
            {
               "Name": "fds",
               "Affiliation": "null894",
               "Text": "sdfdsfs",
               "$$hashKey": "object:235"
            }
         ],
         "AppearanceAndEvents": [
            {
               "Name": "fdsafdsa",
               "Date": "fsasdfs",
               "Location": "fdsadsa",
               "Description": null,
               "$$hashKey": "object:250"
            }
         ]
      }
   }
};