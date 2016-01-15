BMApp.register.controller('NewTitleForm', ['scriptLoader', '$scope', '$rootScope', '$timeout', 'FixedReferences', '$stateParams', 'GuidCreator', 'Upload', function (scriptLoader, $scope, $rootScope, $timeout, FixedReferences, $stateParams, GuidCreator, Upload) {
      var vm = this;
    
      vm.Dependencies = {
         scriptLoader: scriptLoader,
         $scope: $scope,
         $rootScope: $rootScope,
         $timeout: $timeout,
         FixedReferences: FixedReferences,
         $stateParams: $stateParams,
         Upload: Upload
      }
      function init() {
         vm.Form = {
            DraftId: GuidCreator.CreateGuid(),
            ProductGroupId: null,
         }

         vm.BasicInfo = new BasicInfo(data.NewTitle.BasicInfo || '', vm.Dependencies);
         vm.Contributors = new Contributors(data.NewTitle.Contributors.Contributors || '', vm.Dependencies);
         vm.Formats = new Formats(data.NewTitle.Formats.Formats || '', vm.Dependencies);
         vm.Demographics = new Demographics(data.NewTitle.Demographics || '', vm.Dependencies);
         vm.Marketing = new Marketing(data.NewTitle.Marketing || '', vm.Dependencies);
         vm.Covers = new Covers(data.Covers || '', vm.Dependencies);

         vm.RefreshJson = function () {
            $('#jsonPre').text(JSON.stringify({
               "BasicInfo": vm.BasicInfo.Model,
               "Contributors": vm.Contributors.Model,
               "Formats": vm.Formats.Model,
               "Demographics": vm.Demographics.Model,
               "Marketing": vm.Marketing.Model,
               "Covers": vm.Covers.Model,
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
//data = {
//   "NewTitle": {
//      "BasicInfo": {
//         "ProductGroupId": null,
//         "Title": "Jakes Book of Memes",
//         "Subtitle": "Test",
//         "Publisher": "Jake",
//         "Imprint": "Lol",
//         "ContentLanguage": "English",
//         "Series": "Starwars",
//         "NumberinSeries": "3",
//         "MainDescription": "hgfdsfdsf",
//         "ShortDescription": "hgfdsfdsfdsfsdfds"
//      },
//      "Contributors": {
//         "Contributors": [
//            {
//               "FirstName": "Jake",
//               "MiddleName": "A",
//               "LastName": "Ihasz",
//               "Prefix": "Mr",
//               "Suffix": "3rd",
//               "Hometown": "Ashland",
//               "Role": {
//                  "Id": "1",
//                  "Name": "Author"
//               },
//               "Biography": "sdfdsfdsfdsfdsfds",
//               "IsRolePrimary": true,
//               "IsTitlePrimary": true,
//               "AdditionalTitles": [
//                  {
//                     "ISBN": "9780000000002",
//                     "Title": "bv",
//                  }
//               ],
//            }
//         ]
//      },
//      "Formats": {
//         "Formats": [
//            {
//               "ProductType": {
//                  "Id": "1",
//                  "Name": "eBook"
//               },
//               "ProductForm": {
//                  "Id": "1",
//                  "Name": "eBook",
//                  "MediaTypeId": "1"
//               },
//               "ProductDetail": {
//                  "Id": "1",
//                  "Name": "ePUB",
//                  "FormId": "1"
//               },
//               "ProductBinding": {
//                  "Id": "1",
//                  "Name": "Enhanced",
//                  "FormDetailId": "1"
//               },
//               "ISBN13": "9780000000004",
//               "Width": "fds",
//               "Height": "fds",
//               "Spine": "lk",
//               "Weight": "lk",
//               "PublicationDate": "lk",
//               "Copyright": "lk",
//               "StockDueDate": "lk",
//               "TradeSales": null,
//               "Pages": "lk",
//               "CartonQuantity": "lk",
//               "USPrice": "120.00",
//               "DiscountCode": null,
//               "CustomsValue": null,
//               "Edition": null,
//               "EditionNumber": null,
//               "EditionType": null,
//               "CountryofOrigin": null,
//               "PublicationLocation": null,
//               "ComparableTitles": [
//               ],
//               "$$hashKey": "object:1242"
//            },
//            {
//               "ProductType": {
//                  "Id": "1",
//                  "Name": "eBook"
//               },
//               "ProductForm": {
//                  "Id": "1",
//                  "Name": "eBook",
//                  "MediaTypeId": "1"
//               },
//               "ProductDetail": {
//                  "Id": "1",
//                  "Name": "ePUB",
//                  "FormId": "1"
//               },
//               "ProductBinding": {
//                  "Id": "1",
//                  "Name": "Enhanced",
//                  "FormDetailId": "1"
//               },
//               "ISBN13": "9780000000002",
//               "Width": "dsa",
//               "Height": "kj",
//               "Spine": "kj",
//               "Weight": "kj",
//               "PublicationDate": "jk",
//               "Copyright": "kj",
//               "StockDueDate": "kj",
//               "TradeSales": null,
//               "Pages": "kj",
//               "CartonQuantity": "kj",
//               "USPrice": "12.00",
//               "DiscountCode": null,
//               "CustomsValue": null,
//               "Edition": null,
//               "EditionNumber": null,
//               "EditionType": null,
//               "CountryofOrigin": null,
//               "PublicationLocation": null,
//               "ComparableTitles": [
//               ],
//               "$$hashKey": "object:1255"
//            }
//         ]
//      },
//      "Demographics": {
//         "Audience": "",
//         "Bisacs": [
//            {
//               "FixedList": [
//               ],
//               "FixedList2": [
//               ],
//               "BisacGroup": {
//                  "Id": "2",
//                  "Prefix": "ARC",
//                  "Name": "ARCHITECTURE",
//                  "YearVersion": "2014",
//                  "$$hashKey": 2
//               },
//               "Code": {
//                  "Id": "48",
//                  "Code": "ARC001000",
//                  "Text": "ARCHITECTURE / Criticism",
//                  "GroupId": "2",
//                  "$$hashKey": 54
//               },
//               "Text": "",
//               "Group": "",
//               "LongName": "",
//               "BisacID": "",
//               "$$hashKey": "object:1078"
//            }
//         ],
//         "AgeRange": ""
//      },
//      "Marketing": {
//         "Websites": [
//            {
//               "URL": "http://google.com/",
//               "Type": "",
//               "$$hashKey": "object:219"
//            }
//         ],
//         "MarketingAndPublicitys": [
//            {
//               "Type": "2",
//               "Description": "jhl",
//               "$$hashKey": "object:243"
//            }
//         ],
//         "Reviews": [
//            {
//               "Name": "rev",
//               "Publication": "fdsf",
//               "Text": "sdfdsfsdfdsfdsf",
//               "$$hashKey": "object:227"
//            }
//         ],
//         "Endorsements": [
//            {
//               "Name": "fds",
//               "Affiliation": "null894",
//               "Text": "sdfdsfs",
//               "$$hashKey": "object:235"
//            }
//         ],
//         "AppearanceAndEvents": [
//            {
//               "Name": "fdsafdsa",
//               "Date": "fsasdfs",
//               "Location": "fdsadsa",
//               "Description": null,
//               "$$hashKey": "object:250"
//            }
//         ]
//      }
//   }
//}
