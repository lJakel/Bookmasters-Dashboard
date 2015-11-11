BMApp.register.controller('NewTitleForm', ['scriptLoader', '$scope', 'FixedReferences', '$stateParams', 'partialCleanup', function (scriptLoader, $scope, FixedReferences, $stateParams, partialCleanup) {
      var vm = this;
      // if ($stateParams.child) {
      //   alert($stateParams.child)
      // }




      function init() {

         partialCleanup.prepare(['BasicInfo', 'Contributors', 'Formats', 'Demographics', 'Marketing', 'Modals']);

         vm.BasicInfo = new BasicInfo(data.NewTitle.BasicInfo);
         vm.Contributors = new Contributors(data.NewTitle.Contributors.Contributors);
         vm.Formats = new Formats(data.NewTitle.Formats.Formats, $scope);
         vm.Demographics = new Demographics(data.NewTitle.Demographics, FixedReferences);
         vm.Marketing = new Marketing(data.NewTitle.Marketing);

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

      }

      $('[data-toggle="popover"]').popover();
      scriptLoader.loadScripts([
         'http://www.bookmasters.com/CDN/js/bootstrap-select/dist/js/bootstrap-select.min.js',
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
         "Title": "Comic Book People 2",
         "Subtitle": "Photographs from the 1990s",
         "Publisher": "h.f.ullmann",
         "Imprint": "Estrada INC",
         "ContentLanguage": "English",
         "Series": "Star Wars",
         "SeriesName": "",
         "NumberinSeries": "1",
         "MainDescription": "fsdfdsfdsf",
         "ShortDescription": "dsfdsfsdfsdfs"
      },
      "Contributors": {
         "Contributors": [
            {
               "FirstName": "Jackie",
               "MiddleName": "A",
               "LastName": "Estrada",
               "Prefix": "Mrs.",
               "Suffix": "4th",
               "Hometown": "Ashland",
               "Role": 'Author',
               "Biography": "<p>ASlkjdflkjdslkfjdslkfjdsflkdsflkjsd&nbsp;&nbsp;&nbsp;&nbsp;</p>",
               "IsRolePrimary": true,
               "IsTitlePrimary": true,
               "AdditionalTitles": [
                  {
                     "ISBN": "9780000000002",
                     "Title": "Cats"
                  }
               ]
            }
         ]
      },
      "Demographics": {
         "Bisacs": [
            {
               "BisacGroup": 3,
               "Code": 93
            }
         ]
      },
      "Formats": {
         "Formats": [
            {
               "ProductForm": "12 - Hardback",
               "ProductDetail": "4 - Printed Case",
               "ProductBinding": "",
               "ISBN13": "9780000000002",
               "Width": "4",
               "Height": "5",
               "Spine": "6",
               "Weight": "7",
               "PublicationDate": "2015/08/27",
               "Copyright": "2019",
               "StockDueDate": "2015/08/27",
               "TradeSales": true,
               "Pages": "512",
               "CartonQuantity": "32",
               "USPrice": "19.66",
               "DiscountCode": "TRT",
               "CustomsValue": "dsa",
               "Edition": "1",
               "EditionNumber": "2",
               "EditionType": "3",
               "CountryofOrigin": "Nigeria",
               "PublicationLocation": "United Kingdom",
               "ComparableTitles": [
                  {
                     "ISBN": "9780000000002",
                     "Title": "Cats"
                  }
               ]
            }
         ]
      },
      "Marketing": {
         "ReviewErrors": [
         ],
         "EndorsementErrors": [
         ],
         "AppearancesAndEvents": [
            {
               "Name": "dsf",
               "Date": "fds",
               "Location": "fds",
               "Description": "fdsfdsfd"
            }
         ],
         "Websites": [
            {
               "URL": "http://www.bookmasters.com/marktplc/04762.php",
               "Type": "2"
            }
         ],
         "MarketingandPublicities": [
            {
               "Type": "4",
               "Description": "fdssfdsfd"
            }
         ],
         "Endorsements": [
            {
               "Name": "fds",
               "Affiliation": "fds",
               "Text": "fds"
            }
         ],
         "Reviews": [
            {
               "Name": "fds",
               "Publication": "fds",
               "Text": "fds"
            }
         ]
      }
   },
   "IncompleteTitles": [
      {
         "BasicInfo": {
            "Title": "G8",
            "Subtitle": "Lolcats",
            "Publisher": "h.f.ullmann2",
            "Imprint": "Author Solutions",
            "ContentLanguage": "English",
            "Series": "",
            "SeriesName": "Star Wars",
            "NumberinSeries": "3",
            "MainDescription": "",
            "ShortDescription": "",
            "Errors": ""
         },
         "Contributors": {
            "Contributors": [
               {
                  "FirstName": "Sue",
                  "MiddleName": "Cats",
                  "LastName": "Bray",
                  "Prefix": "Mrs",
                  "Suffix": "3rd",
                  "Hometown": "Ashland",
                  "Role": "Authro",
                  "Biography": "Lol this bio tho",
                  "IsRolePrimary": false,
                  "IsTitlePrimary": false,
                  "AdditionalTitles": [
                     {
                        "ISBN": "fdgdfgdfg",
                        "Title": "dfgfdgdfg"
                     },
                     {
                        "ISBN": "312123",
                        "Title": "dfgf3213dgdfg"
                     }
                  ]
               },
               {
                  "FirstName": "Lelarino",
                  "MiddleName": "Lol",
                  "LastName": "Inorino",
                  "Prefix": "Mr",
                  "Suffix": "4th",
                  "Hometown": "Mansfield",
                  "Role": "CatsMcGhee",
                  "Biography": "Lelcatssssadasdasd",
                  "IsRolePrimary": false,
                  "IsTitlePrimary": false,
                  "AdditionalTitles": ""
               }
            ]
         }
      },
      {
         "BasicInfo": {
            "Title": "Comic Book People 2 ",
            "Subtitle": "Photographs from the 1990s",
            "Publisher": "h.f.ullmann2",
            "Imprint": "Estrada INC",
            "ContentLanguage": "English",
            "Series": "",
            "SeriesName": "Star Wards",
            "NumberinSeries": "3",
            "MainDescription": "",
            "ShortDescription": "",
            "Errors": ""
         },
         "Contributors": {
            "Contributors": [
               {
                  "FirstName": "Sue",
                  "MiddleName": "Cats",
                  "LastName": "Bray",
                  "Prefix": "Mrs",
                  "Suffix": "3rd",
                  "Hometown": "Ashland",
                  "Role": "Authro",
                  "Biography": "Lol this bio tho",
                  "IsRolePrimary": false,
                  "IsTitlePrimary": false,
                  "AdditionalTitles": [
                     {
                        "ISBN": "fdgdfgdfg",
                        "Title": "dfgfdgdfg"
                     },
                     {
                        "ISBN": "312123",
                        "Title": "dfgf3213dgdfg"
                     }
                  ]
               },
               {
                  "FirstName": "Lelarino",
                  "MiddleName": "Lol",
                  "LastName": "Inorino",
                  "Prefix": "Mr",
                  "Suffix": "4th",
                  "Hometown": "Mansfield",
                  "Role": "CatsMcGhee",
                  "Biography": "Lelcatssssadasdasd",
                  "IsRolePrimary": false,
                  "IsTitlePrimary": false,
                  "AdditionalTitles": ""
               }
            ]
         }
      }
   ]
}
