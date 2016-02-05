var Modals = {
   ContributorBSModal: function (data, Dependencies, References) {
      var self = this;
      self.entryData = undefined;
      self.Method = '';

      self.FirstName = '';
      self.MiddleName = '';
      self.LastName = '';
      self.Prefix = '';
      self.Suffix = '';
      self.Hometown = '';
      self.Role = '';
      self.Biography = '';

      self.FixedAuthorRoles = References.FixedAuthorRoles;

      self.IsRolePrimary = false;
      self.IsTitlePrimary = false;
      self.AdditionalTitles = [];
      self.addAdditionalTitle = addAdditionalTitle;
      self.removeAdditionalTitle = removeAdditionalTitle;

      function addAdditionalTitle() {
         self.AdditionalTitles.push(new Components.AdditionalTitle(''));
      }

      function removeAdditionalTitle(index) {
         self.AdditionalTitles.splice(index, 1);
      }
   },
   FormatBSModal: function (data, $scope, References) {
      var self = this;
      self.entryData = undefined;

      self.isEbook = false;

      self.Method = '';
      self.ProductType = data.ProductType || '';
      self.ProductForm = data.ProductForm || '';
      self.ProductDetail = data.ProductDetail || '';
      self.ProductBinding = data.ProductBinding || '';
      self.ISBN13 = data.ISBN13 || '';
      self.Width = data.Width || '';
      self.Height = data.Height || '';
      self.Spine = data.Spine || '';
      self.Weight = data.Weight || '';
      self.PublicationDate = data.PublicationDate || '';
      self.Copyright = data.Copyright || '';
      self.StockDueDate = data.StockDueDate || '';
      self.TradeSales = data.TradeSales || '';
      self.Pages = data.Pages || '';
      self.CartonQuantity = data.CartonQuantity || '';
      self.USPrice = data.USPrice || '';
      self.DiscountCode = data.DiscountCode || '';
      self.CustomsValue = data.CustomsValue || '';
      self.Edition = data.Edition || '';
      self.EditionNumber = data.EditionNumber || '';
      self.EditionType = data.EditionType || '';
      self.CountryofOrigin = data.CountryofOrigin || '';
      self.PublicationLocation = data.PublicationLocation || '';

      self.TerritoryRights = data.TerritoryRights || "world";

      self.ComparableTitles = data.ComparableTitles || [];
      self.Illustrations = data.Illustrations || [];

      self.FixedProductTypesNew = [];
      self.FixedProductTypes = References.FixedProductTypes;
      self.FixedProductForms = [];
      self.FixedProductFormDetails = [];
      self.FixedProductFormDetailSpecifics = [];

      self.FixedIsoCodes = References.FixedISOCountryCodes;
      self.FixedDiscountCodes = References.FixedDiscountCodes;


      self.FixedEditionTypes = References.FixedEditionTypes;

      self.DynamicProductTypes = [];
      self.DynamicProductForms = [];
      self.DynamicProductFormDetails = [];
      self.DynamicProductFormDetailSpecifics = [];
      self.GetDynamicProductForms = GetDynamicProductForms;
      self.GetDynamicProductDetails = GetDynamicProductDetails;

      self.addIllustration = addIllustration;
      self.removeIllustration = removeIllustration;
      self.addComparableTitle = addComparableTitle;
      self.removeComparableTitle = removeComparableTitle;
      self.uncheckAllSalesRights = uncheckAllSalesRights;
      self.checkAllSalesRights = checkAllSalesRights;




      self.openCalendar = function (e) {
         e.preventDefault();
         e.stopPropagation();

         self.CalendarIsOpen = true;
      };

      self.CalendarIsOpen = false;

      function uncheckAllSalesRights() {
         $.each(self.FixedIsoCodes, function (k, v) {
            v.checked = false;
         });
      }

      function checkAllSalesRights() {
         $.each(self.FixedIsoCodes, function (k, v) {
            v.checked = true;
         });
      }

      self.GetMediaTypes = function () {
         var ar = [];
         $.each(self.FixedProductTypes, function (k, item) {
            var elementpos = ar.map(function (x) {
               return x.MediaType;
            }).indexOf(item.MediaType);

            if (elementpos < 0) {
               item.MediaType !== null && ar.push({MediaType: item.MediaType});
            }
         });
         self.FixedProductTypesNew = ar;
      };
      $scope.$watch(function () {
         return self.ProductType
      }, function (newVal, oldVal) {

         if (newVal && newVal.MediaType == 'eBook') {
            self.isEbook = true;
         } else {
            self.isEbook = false;

         }
      })

      function GetDynamicProductForms() {


         var array = self.FixedProductTypes.filter(function (item) {
            return self.ProductType && item.MediaType == self.ProductType.MediaType;
         });
         var newArray = [];

         $.each(array, function (k, item) { //for each product type
            var elementpos = newArray.map(function (x) {
               return x.Form;
            }).indexOf(item.Form);
            if (elementpos < 0) {
               item.Form !== null && newArray.push({Form: item.Form});
            }
         });
         self.DynamicProductForms = newArray;
      }

      function GetDynamicProductDetails() {

         var array = self.FixedProductTypes.filter(function (item) {
            return self.ProductForm && item.Form == self.ProductForm.Form;
         });
         var newArray = [];

         $.each(array, function (k, item) { //for each product type
            var elementpos = newArray.map(function (x) {
               return x.Form;
            }).indexOf(item.Detail);
            if (elementpos < 0) {
               item.Detail !== null && newArray.push({Detail: item.Detail});
            }
         });
         self.DynamicProductFormDetails = newArray;
      }

      function addIllustration() {
         self.Illustrations.push(new Components.Illustration(''));
      }

      function removeIllustration(index) {
         self.Illustrations.splice(index, 1);
      }

      function addComparableTitle() {
         self.ComparableTitles.push(new Components.ComparableTitle(''));
      }

      function removeComparableTitle(index) {
         self.ComparableTitles.splice(index, 1);
      }
   },
   ReviewModal: function () {
      var self = this;
      self.entryData = undefined;
      self.Method = '';

      self.Method = '';
      self.Name = '';
      self.Publication = '';
      self.Text = '';

   },
   EndorsementModal: function () {
      var self = this;
      self.entryData = undefined;

      self.Method = '';
      self.Name = '';
      self.Affiliation = '';
      self.Text = '';

   },
   AppearanceAndEventModal: function () {
      var self = this;
      self.entryData = undefined;
      self.Method = '';

      self.Name = '';
      self.Date = '';
      self.Location = '';
      self.Text = '';
   }
};
function BasicInfo(data, Dependencies, References) {
   var self = this;
   self.Model = {
      ProductGroupId: data.ProductGroupId || null,
      Title: data.Title || '',
      Subtitle: data.Subtitle || '',
      Publisher: data.Publisher || '',
      Imprint: data.Imprint || '',
      ContentLanguage: data.ContentLanguage || '',
      Series: data.Series || '',
      NumberinSeries: data.NumberinSeries || '',
      MainDescription: data.MainDescription || '',
      ShortDescription: data.ShortDescription || '',
   };
   
   self.FixedLanguageCodes = References.FixedISOLanguageCodes;

}
var Contributors = function (data, Dependencies, References) {
   var vm = this;
   vm.Model = {
      Contributors: data || []
   };

   vm.ContributorModal = new Modals.ContributorBSModal('', Dependencies, References);

   vm.showDialog = false;

   vm.showContributorModal = showContributorModal;
   vm.onContributorModalAction = onContributorModalAction;
   vm.addContributor = addContributor;
   vm.removeContributor = removeContributor;


   function showContributorModal(data, method) {

      vm.ContributorModal.Method = method || 'edit';
      vm.ContributorModal.entryData = data;
      $.each(data, function (k, v) {
         vm.ContributorModal[k] = data[k] || null;
      });
      vm.showDialog = true;
   }

   function onContributorModalAction() {
      $.each(vm.ContributorModal.entryData, function (k, v) {
         vm.ContributorModal.entryData[k] = vm.ContributorModal[k];
      });
      if (vm.ContributorModal.Method === 'add') {
         vm.Model.Contributors.push(vm.ContributorModal.entryData);
      }
      vm.showDialog = false;
   }

   function addContributor() {
      vm.showContributorModal(new Components.Contributor(''), 'add');
   }

   function removeContributor(index) {
      vm.Model.Contributors.splice(index, 1);
   }
};
function Covers(data, Dependencies) {
   var self = this;
   self.Model = {
      Covers: []
   };
   self.log = '';
   self.files = {};

   self.upload = function (file, isbn) {

      if (file) {
         var argisbn = isbn;
         self.files[argisbn] = {};
         self.files[argisbn]['status'] = null;

         Dependencies.Upload.upload({
            url: '//api.bookmasters.com/Files/Cover',
            data: {
               username: 'poop',
               isbn13: isbn,
               CoverFile: file
            }
         }).then(function (resp) {

            self.files[argisbn]['name'] = resp.config.data.CoverFile.name;
            self.files[argisbn]['type'] = resp.config.data.CoverFile.type;
            self.files[argisbn]['size'] = resp.config.data.CoverFile.size;
            self.files[argisbn]['status'] = true;

            self.files[isbn]['progress'] = {
               percentage: "100%",
               width: 100,
               color: "progress-bar-success"

            };
         }, function (resp) {
            self.files[argisbn]['status'] = false;
            self.files[isbn]['progress'] = {
               percentage: "Error",
               width: 100,
               color: "progress-bar-danger"
            };
         }, function (evt) {
            var progressPercentage = parseInt(100.0 * evt.loaded / evt.total);
            self.files[isbn]['progress'] = {
               percentage: progressPercentage + "%",
               width: progressPercentage,
               color: "progress-bar-info"

            };
         });
      }
   };

   self.formatBytes = function (bytes, decimals) {
      if (bytes == 0)
         return '0 Byte';
      var k = 1000;
      var dm = decimals + 1 || 3;
      var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
      var i = Math.floor(Math.log(bytes) / Math.log(k));
      return (bytes / Math.pow(k, i)).toPrecision(dm) + ' ' + sizes[i];
   };

}
var Demographics = function (data, Dependencies, References) {

   var self = this;
   self.ValidSubject = false;

   self.ValidWatch = [
      'NTFNGForm.DemographicsFormPanel.$valid',
      'NTFNGForm.DemographicsFormPanel.AddBisacs.$valid',
      'NTFNGForm.DemographicsFormPanel.AddBisacs.AddBisacsRepeat.$valid',
      function () {
         return(self.Model.Bisacs.length > 0);
      },
   ];


   Dependencies.$scope.$watchGroup(self.ValidWatch, function (newValues) {
      if (newValues.indexOf(false) == -1) {
         self.ValidSubject = true;
      } else {
         self.ValidSubject = false;
      }
   });

   self.Model = {
      Audience: data.Audience || '',
      Bisacs: data.Bisacs || [],
      AgeRange: data.AgeFrom || '',
   };
   self.FixedBisacListContainer = [];

   self.AgeRangeRequired = false;
   self.AgeRangeDisabled = true;

   self.AudienceRequired = false;
   self.AudienceDisabled = false;

   self.FixedList = References.FixedBisacGroups;
   self.FixedAudienceTypes = References.FixedAudienceTypes;
   self.FixedAgeRanges = References.FixedAgeRanges;

   Dependencies.$scope.$watchCollection(function () {
      return self.Model.Audience;
   }, function (newVal, oldVal) {
      switch (newVal.Name) {
         case "Children/juvenile":
            self.AgeRangeRequired = true;
            self.AgeRangeDisabled = false;
            break;
         case "Young adult":
            self.AgeRangeRequired = true;
            self.AgeRangeDisabled = false;
            break;
         default :
            self.AgeRangeRequired = false;
            self.AgeRangeDisabled = true;
            break;
      }
      self.DynamicAgeRanges = self.FixedAgeRanges.filter(function (item) {
         return self.Model.Audience && item.AudienceTypeId == self.Model.Audience.Id;
      });

   });
   Dependencies.$scope.$watchCollection(function () {
      return self.Model.Bisacs;
   }, function (newVal, oldVal) {

      if (self.Model.Bisacs.length == 0) {
         self.CheckJuv();
      }

      $.each(self.Model.Bisacs, function (k, v) {
         Dependencies.$scope.$watchCollection(function () {
            return v;
         }, function (newVal, oldVal) {
            self.CheckJuv();
         });
      });
   });



   self.UpdateBisacCodes = function (index) {
      Dependencies.$timeout(function () {
         Dependencies.FixedReferences.lookupBisac(self.Model.Bisacs[index].BisacGroup.Id, function (response) {
            self.FixedBisacListContainer[index] = response.data;
         }, function (response) {
            alert();
         });
      });
   };

   //init values
   $.each(self.Model.Bisacs, function (k, v) {
      self.UpdateBisacCodes(k);
   });
   self.addBisac = function () {
      self.Model.Bisacs.push(new Components.Bisac(self.FixedList || ''));
   };

   self.removeBisac = function (index) {
      self.Model.Bisacs.splice(index, 1);
   };
   self.CheckJuv = function () {
      var found = false;
      $.each(self.Model.Bisacs, function (k, v) {
         if (v.BisacGroup.Prefix == "JUV" || v.BisacGroup.Prefix == "JNF") {
            found = true;
         }
      });

      if (found) {
         $.each(self.FixedAudienceTypes, function (k, v) {
            if (v.Name == "Children/juvenile") {
               self.Model.Audience = v;
            }
         });
         self.AudienceDisabled = true;
         self.AudienceRequired = false;
         self.AgeRangeRequired = true;
         self.AgeRangeDisabled = false;
      } else {
         self.AudienceDisabled = false;
         self.AudienceRequired = true;
         self.AgeRangeRequired = false;
         self.AgeRangeDisabled = true;
      }
   }
};
var Drafts = function (parent, Dependencies) {
   

   var self = this;
   self.Drafts = [];
   self.EmptyCache = function () {
      if (confirm('Are you sure you want to delete all your saved drafts?')) {
         Dependencies.NewTitleDraftsFactory.EmptyCache().then(function (r) {
            self.Drafts = [];
            self.Drafts = r.Drafts;
         });
      }
   };
   self.LoadDraft = function ($draft) {
      parent.LoadDraft($draft);
   };

   self.RemoveDraft = function ($index) {
      Dependencies.NewTitleDraftsFactory.RemoveDraft($index);
   };
   self.GetDrafts = function () {
      Dependencies.NewTitleDraftsFactory.GetDrafts().then(function (r) {
         self.Drafts = [];
         self.Drafts = r.Drafts;
      });
   };

   self.FormatDate = function (date, format) {
      return moment(date, "X").format("dddd, MMMM Do YYYY, h:mm:ss a");
   };
   self.GetDrafts();
   self.SaveDraft = function () {
      Dependencies.NewTitleDraftsFactory.SaveDraft(JSON.stringify({
         "DraftId": parent.Form.DraftId,
         "ProductGroupId": parent.Form.ProductGroupId,
         "CreationDate": parent.Form.CreationDate,
         "Content": {
            "BasicInfo": parent.BasicInfo.Model,
            "Contributors": parent.Contributors.Model,
            "Formats": parent.Formats.Model,
            "Demographics": parent.Demographics.Model,
            "Marketing": parent.Marketing.Model,
         }
      })).then(function (r) {
         self.Drafts = r.Drafts;
      });
   };
};
BMApp.register.factory('FixedReferences', ['$http', '$q', '$state', '$timeout', '$localStorage', 'AuthFactory',
   function ($http, $q, $state, $timeout, $localStorage, AuthFactory) {
      var self = this;
      self.factory = {
         GetDiscountCodes: GetDiscountCodes,
         lookupBisac: lookupBisac,
         GetFixedReferences: GetFixedReferences,
      };
      return self.factory;


      function cacheInit() {
         return $q(function (resolve, reject) {
            try {
               var Today = Math.floor(Date.now() / 1000);
               var Days = 2;
               var CacheTime = Days * 24 * 60 * 60;
               $localStorage.FixedReferencesFactory = $localStorage.FixedReferencesFactory || {};
               $localStorage.FixedReferencesFactory.Cache = $localStorage.FixedReferencesFactory.Cache || Math.floor(Date.now() / 1000);
               $localStorage.FixedReferencesFactory.References = $localStorage.FixedReferencesFactory.References || null;
               if (Today - $localStorage.FixedReferencesFactory.Cache >= CacheTime) {
                  $localStorage.FixedReferencesFactory = {
                     Cache: Math.floor(Date.now() / 1000),
                     References: null,
                     DiscountCodes: null,
                  };
               }
               resolve();
            } catch (err) {
               reject(err.message);
            }
         });
      }

      function GetFixedReferences() {
         return $q(function (resolve, reject) {
            cacheInit().then(function () {
               if ($localStorage.FixedReferencesFactory.References == null) {
                  $http.post("API/FixedReferences/GetAllReferences").then(function (successResponse) {
                     $localStorage.FixedReferencesFactory.References = successResponse.data.data;
                     resolve($localStorage.FixedReferencesFactory.References);
                  }, function (errorResponse) {
                     reject(errorResponse);
                     $state.go('error', {
                        code: '500',
                        message: 'An error occured loading the fixed references. '
                     });
                  });
               } else {
                  resolve($localStorage.FixedReferencesFactory.References);
               }

            }, function (errorResponse) {
               reject(errorResponse);
               $state.go('error', {
                  code: '500',
                  message: 'An error occured loading the fixed references. ' + errorResponse
               });

            });
         });


      }

      function lookupBisac(group, success, error) {
         $http.post("API/BisacCodes/GetGroupCodes", {groupId: group}).then(function (response) {
            success(response.data);
         }, function (response) {
            $state.go('error', {
               code: '500',
               message: 'An error occured looking up the bisac code.'
            });
            return;
         });
      }

      function GetDiscountCodes(successCallback, errorCallback) {
//         cacheInit(function () {
//            if ($localStorage.FixedReferencesFactory.DiscountCodes == null) {
//               AuthFactory.getInfo().then(function (response) {
//                  $localStorage.FixedReferencesFactory.DiscountCodes = response.clientinfo.DiscountCodes;
//                  successCallback($localStorage.FixedReferencesFactory.DiscountCodes);
//               });
//            } else {
//               console.log('cache');
//               successCallback($localStorage.FixedReferencesFactory.DiscountCodes);
//            }
//         });
      }

   }]);


BMApp.register.factory('NewTitleDraftsFactory', ['$q', '$state', '$localStorage', 'AuthFactory', 'GuidCreator', '$timeout', 'toasty', function ($q, $state, $localStorage, AuthFactory, GuidCreator, $timeout, toasty) {
      var self = this;
      self.UserId = null;
      self.Drafts = [];
      self.Init = false;
      self.DraftLocation = '';
      function User(data) {
         var su = this;
         su.UserId = data.UserId || self.UserId;
         su.Drafts = data.Drafts || [];
      }
      function Draft(data) {
         var sd = this;
         sd.DraftId = data.DraftId || '';
         sd.ProductGroupId = data.ProductGroupId || '';
         sd.Title = data.Content.BasicInfo.Title || '';
         sd.CreationDate = data.CreationDate || moment().format('X');
         sd.LastUpdated = data.LastUpdated || moment().format('X');
         sd.Content = JSON.stringify(data.Content) || '';
      }

      self.factory = {
         User: {},
         Cache: {},
         EmptyCache: EmptyCache,
         SaveDraft: SaveDraft,
//         LoadDraft: LoadDraft,
         GetDrafts: GetDrafts,
      };
      function cacheInit() {
         return $q(function (resolve, reject) {
            if (self.Init) {
               resolve();
               return;
            }
            $timeout(function () {
               AuthFactory.getInfo().then(function (r) {
                  self.UserId = r.credentials.userid;
               });
            }).then(function () {
               $localStorage.NewTitleDraftsFactory = $localStorage.NewTitleDraftsFactory || {};
               $localStorage.NewTitleDraftsFactory.Users = $localStorage.NewTitleDraftsFactory.Users || [];
               var result = $localStorage.NewTitleDraftsFactory.Users.filter(function (item) {
                  return (item.UserId == self.UserId);
               });
               if (result.length) {
                  self.factory.User = result[0];
               } else {
                  self.factory.User = $localStorage.NewTitleDraftsFactory.Users[$localStorage.NewTitleDraftsFactory.Users.push(new User('')) - 1];
               }

               if (self.UserId != null) {
                  self.Init = true;
                  resolve();
               } else {
                  reject($state.go('error', {
                     code: '500',
                     message: 'An unknown error occured in NewTitleDraftsFactory. (Reject cacheInit() UserID was not returned)'
                  }));
               }
            });
         });
      }
      function EmptyCache() {
         self.Init = false;
         self.factory.User = {};
         $localStorage.NewTitleDraftsFactory = {};
         return $q.when(self.factory.User);
      }


      function GetDrafts() {
         return cacheInit().then(function () {
            return $q.when(self.factory.User);
         });
      }

      function ClearDrafts() {
         return cacheInit().then(function () {
            self.factory.User['Drafts'] = [];
            return $q.when(self.factory.User);
         });
      }
      function SaveDraft(data) {
         return cacheInit().then(function () {
            var draft = new Draft(JSON.parse(data));

            var elementpos = self.factory.User['Drafts'].map(function (x) {
               return x.DraftId;
            }).indexOf(draft.DraftId);

            if (elementpos < 0) {
               self.factory.User['Drafts'].unshift(draft);
               toasty.success({title: 'Saved Draft!', msg: 'Your draft has been saved to your computer.', theme: 'bootstrap', timeout: 5000});
            } else {
               draft.LastUpdated = moment().format('X');
               self.factory.User['Drafts'][elementpos] = draft;
               toasty.info({title: 'Saved Draft!', msg: 'Your draft has been updated.', theme: 'bootstrap', timeout: 5000});
            }

            if (self.factory.User['Drafts'].length >= 4) {
               self.factory.User['Drafts'].length = 4;
            }

            return GetDrafts();
         });
      }
      return self.factory;
   }]);

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
                 vm.Notified = false;
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
var Formats = function (data, Dependencies, References) {

   var self = this;
   self.Model = {
      Formats: data || []
   };
   self.FormatModal = new Modals.FormatBSModal('', Dependencies.$scope, References);

   self.showDialog = false;

   self.showFormatModal = function (data, method) {
      Dependencies.$scope.$broadcast('show-errors-reset');

      self.FormatModal.Method = method || 'edit';
      self.FormatModal.entryData = data;
      $.each(data, function (k, v) {
         self.FormatModal[k] = data[k] || null;
      });

      Dependencies.$timeout(function () {
         self.FormatModal.GetMediaTypes();
      }).then(function () {
         self.FormatModal.ProductType = data.ProductType;
      });
      Dependencies.$timeout(function () {
         self.FormatModal.GetDynamicProductForms();
      }).then(function () {
         self.FormatModal.ProductForm = data.ProductForm;
      });
      Dependencies.$timeout(function () {
         self.FormatModal.GetDynamicProductDetails();
      }).then(function () {
         self.FormatModal.ProductDetail = data.ProductDetail;
      });

      self.showDialog = true;
   };

   self.onFormatModalAction = function () {
      $.each(self.FormatModal.entryData, function (k, v) {
         self.FormatModal.entryData[k] = self.FormatModal[k];
      });
      if (self.FormatModal.Method === 'add') {
         self.Model.Formats.push(self.FormatModal.entryData);
      }
      self.showDialog = false;
   };

   self.addFormat = function () {

      self.showFormatModal(new Components.Format(''), 'add');
   };

   self.removeFormat = function (index) {
      self.Model.Formats.splice(index, 1);
   };

};
var Marketing = function (data) {

   var self = this;

   self.Model = {
      Websites: data.Websites || [],
      MarketingAndPublicitys: data.MarketingAndPublicitys || [],
      Reviews: data.Reviews || [],
      Endorsements: data.Endorsements || [],
      AppearanceAndEvents: data.AppearanceAndEvents || [],
   }

   self.addSingleMarketingItem = addSingleMarketingItem;
   self.addMarketingItem = addMarketingItem;
   self.showMarketingItemModal = showMarketingItemModal;
   self.onMarketingItemModalAction = onMarketingItemModalAction;
   self.removeMarketingItem = removeMarketingItem;

   self.ReviewModal = new Modals.ReviewModal('');
   self.showReviewDialog = false;

   self.EndorsementModal = new Modals.EndorsementModal('');
   self.showEndorsementDialog = false;

   self.AppearanceAndEventModal = new Modals.AppearanceAndEventModal('');
   self.showAppearanceAndEventDialog = false;

   function addSingleMarketingItem(Component) {
      self.Model[Component + 's'].push(new Components[Component]());
   }

   function addMarketingItem(Component) {
      self.showMarketingItemModal(new Components[Component], Component, 'add');
   }

   function showMarketingItemModal(entryDataViewModel, Component, Method) {
      self[Component + 'Modal'].Method = Method || 'edit';
      self[Component + 'Modal'].entryData = entryDataViewModel;

      $.each(entryDataViewModel, function (k, v) {
         self[Component + 'Modal'][k] = entryDataViewModel[k] || null;
      });
      self['show' + Component + 'Dialog'] = true;
   }

   function onMarketingItemModalAction(Component) {
      $.each(self[Component + 'Modal'].entryData, function (k, v) {
         self[Component + 'Modal'].entryData[k] = self[Component + 'Modal'][k];
      });
      if (self[Component + 'Modal'].Method === 'add') {
         self.Model[Component + 's'].push(self[Component + 'Modal'].entryData);
      }
      self['show' + Component + 'Dialog'] = false;
   }

   function removeMarketingItem(Component, index) {
      self.Model[Component + 's'].splice(index, 1);
   }

};
var Components = {
   AdditionalTitle: function (data) {
      var vm = this;
      vm.ISBN = data.ISBN || '';
      vm.Title = data.Title || '';
   },
   Contributor: function (data) {
      var vm = this;
      vm.FirstName = data.FirstName || '';
      vm.MiddleName = data.MiddleName || '';
      vm.LastName = data.LastName || '';
      vm.Prefix = data.Prefix || '';
      vm.Suffix = data.Suffix || '';
      vm.Hometown = data.Hometown || '';
      vm.Role = data.Role || '';
      vm.Biography = data.Biography || '';
      vm.IsRolePrimary = data.IsRolePrimary || false;
      vm.IsTitlePrimary = data.IsTitlePrimary || false;
      vm.AdditionalTitles = data.AdditionalTitles || [];
   },
   Bisac: function (data) {
      var vm = this;
      vm.FixedList = [];
      vm.FixedList2 = [];
      vm.BisacGroup = '';
      vm.Code = '';
      vm.Text = '';
      vm.Group = '';
      vm.LongName = '';
      vm.BisacID = '';
   },
   Review: function () {
      var self = this;
      self.Name = '';
      self.Publication = '';
      self.Text = '';
   },
   MarketingAndPublicity: function () {
      var self = this;
      self.Type = '';
      self.Description = '';
   },
   AppearanceAndEvent: function () {
      var self = this;
      self.EventName = '';
      self.Date = '';
      self.Location = '';
      self.Description = '';
   },
   Website: function () {
      var self = this;

      self.URL = '';
      self.Type = '';
   },
   Endorsement: function () {
      var self = this;
      self.Name = '';
      self.Affiliation = '';
      self.Text = '';
   },
   Format: function (data) {
      var self = this;

      self.ProductType = data.ProductType || '';
      self.ProductForm = data.ProductForm || '';
      self.ProductDetail = data.ProductDetail || '';
      self.ProductBinding = data.ProductBinding || '';
      self.ISBN13 = data.ISBN13 || '';
      self.Width = data.Width || '';
      self.Height = data.Height || '';
      self.Spine = data.Spine || '';
      self.Weight = data.Weight || '';
      self.PublicationDate = data.PublicationDate || '';
      self.Copyright = data.Copyright || '';
      self.StockDueDate = data.StockDueDate || '';
      self.TradeSales = data.TradeSales || '';
      self.Pages = data.Pages || '';
      self.CartonQuantity = data.CartonQuantity || '';
      self.USPrice = data.USPrice || '';
      self.DiscountCode = data.DiscountCode || '';
      self.CustomsValue = data.CustomsValue || '';
      self.Edition = data.Edition || '';
      self.EditionNumber = data.EditionNumber || '';
      self.EditionType = data.EditionType || '';
      self.CountryofOrigin = data.CountryofOrigin || '';
      self.PublicationLocation = data.PublicationLocation || '';
      self.ComparableTitles = data.ComparableTitles || [];
   },
   ComparableTitle: function (data) {
      var self = this;
      self.ISBN = data.ISBN || '';
      self.Title = data.Title || '';
   },
   Illustration: function (data) {
      var self = this;
      self.Type = data.Type || '';
      self.Description = data.Description || '';
      self.Number = data.Number || '';

   }
};