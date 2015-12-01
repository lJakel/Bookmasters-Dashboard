BMApp.register.controller('NewTitleForm', ['scriptLoader', '$scope', '$timeout', 'FixedReferences', '$stateParams', 'partialCleanup', function (scriptLoader, $scope, $timeout, FixedReferences, $stateParams, partialCleanup) {
      var vm = this;
      // if ($stateParams.child) {
      //   alert($stateParams.child)
      // }

      function init() {

         partialCleanup.prepare(['BasicInfo', 'Contributors', 'Formats', 'Demographics', 'Marketing', 'Modals']);

         vm.BasicInfo = new BasicInfo(data.NewTitle.BasicInfo || '');
         vm.Contributors = new Contributors(data.NewTitle.Contributors.Contributors || '');
         vm.Formats = new Formats(data.NewTitle.Formats.Formats || '', $scope, $timeout);
         vm.Demographics = new Demographics(data.NewTitle.Demographics || '', FixedReferences);
         vm.Marketing = new Marketing(data.NewTitle.Marketing || '');

         vm.save = function () {
            console.log("xD")
            $scope.$broadcast('show-errors-check-validity');
         };

         vm.RefreshJson = function () {
            $('#jsonPre').text(JSON.stringify(
                    {
                       "BasicInfo": (vm.BasicInfo),
                       "Contributors": (vm.Contributors),
                       "Formats": (vm.Formats),
                       "Demographics": (vm.Demographics),
                       "Marketing": (vm.Marketing),
                    }
            ));

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

         FixedReferences.getIsoCodes().then(function (response) {
            vm.Formats.FormatModal.FixedIsoCodes = $.map(response, function (item) {

               return item;
            });
         });

         $timeout(function () {
            //document ready
            $('[data-toggle="popover"]').popover();
         });

      }

      scriptLoader.loadScripts([
         'http://www.bookmasters.com/CDN/js/summernote/dist/summernote.min.js',
         'http://www.bookmasters.com/CDN/js/bs-filepicker/bs-filepicker.js',
         'http://www.bookmasters.com/CDN/js/trip.js/dist/trip.min.js',
      ], 'partial').then(init);
   }]);

var data = {
   "NewTitle": {
      "BasicInfo": {
         "Title": "Jakes Boss Book of Memes",
         "Subtitle": "To Troll and Beyond",
         "Publisher": "TrollToTroll",
         "Imprint": "TrollHasz",
         "ContentLanguage": "English",
         "Series": "Star Wars",
         "NumberinSeries": "3",
         "MainDescription": "Main Desc",
         "ShortDescription": "Short Desc",
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
                  "Id": 1,
                  "Name": "Author"
               },
               "Biography": "Well said mate",
               "IsRolePrimary": true,
               "IsTitlePrimary": false,
               "AdditionalTitles": [
                  {
                     "ISBN": "9780000000002",
                     "Title": "Mcghee",
                  },
                  {
                     "ISBN": "9780000000002",
                     "Title": "Mcghee",
                  }
               ],
            }
         ],
      },
      "Demographics": {},
      "Formats": {
         "Formats": [
            {
               "ProductType": {
                  "Id": 1,
                  "Name": "eBook"
               },
               "ProductForm": {
                  "Id": 1,
                  "MediaTypeId": 1,
                  "Name": "eBook"
               },
               "ProductDetail": {
                  "Id": 1,
                  "FormId": 1,
                  "Name": "ePUB"
               },
               "ProductBinding": {
                  "Id": 1,
                  "FormDetailId": 1,
                  "Name": "Enhanced"
               },
               "ISBN13": "9780000000002",
               "Width": "5",
               "Height": "5",
               "Spine": "5",
               "Weight": "5",
               "PublicationDate": "",
               "Copyright": "",
               "StockDueDate": "",
               "TradeSales": true,
               "Pages": "5",
               "CartonQuantity": "5",
               "USPrice": "f",
               "DiscountCode": null,
               "CustomsValue": null,
               "Edition": null,
               "EditionNumber": null,
               "EditionType": null,
               "CountryofOrigin": null,
               "PublicationLocation": null,
               "ComparableTitles": [
               ],
            }
         ],
      },
      "Marketing": {}
   },
};