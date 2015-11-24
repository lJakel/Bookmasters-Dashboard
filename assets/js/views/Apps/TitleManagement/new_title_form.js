BMApp.register.controller('NewTitleForm', ['scriptLoader', '$scope', '$timeout', 'FixedReferences', '$stateParams', 'partialCleanup', function (scriptLoader, $scope, $timeout, FixedReferences, $stateParams, partialCleanup) {
      var vm = this;
      // if ($stateParams.child) {
      //   alert($stateParams.child)
      // }

      function init() {

         partialCleanup.prepare(['BasicInfo', 'Contributors', 'Formats', 'Demographics', 'Marketing', 'Modals']);

         vm.BasicInfo = new BasicInfo(data.NewTitle.BasicInfo || '');
         vm.Contributors = new Contributors(data.NewTitle.Contributors.Contributors || '');
         vm.Formats = new Formats(data.NewTitle.Formats.Formats || '', $scope);
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
         'http://www.bookmasters.com/CDN/js/moment/moment.js',
         'http://www.bookmasters.com/CDN/js/bootstrap-daterangepicker/daterangepicker.js'
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
               "IsRolePrimary": false,
               "IsTitlePrimary": true,
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
      "Formats": {},
      "Marketing": {}
   },
};