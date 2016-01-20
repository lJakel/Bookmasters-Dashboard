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
BMApp.register.factory('FixedReferences', ['$http', '$q', '$state', '$timeout', '$localStorage', 'AuthFactory', function ($http, $q, $state, $timeout, $localStorage, AuthFactory) {
      var self = this;
      self.factory = {
         getReferences: getReferences,
         getIsoCodes: getIsoCodes,
         getDiscountCodes: getDiscountCodes,
         lookupBisac: lookupBisac,
         References: undefined,
         IsoCodes: undefined,
         DiscountCodes: undefined,
      };
      return self.factory;


      function cacheInit() {

         var Today = Math.floor(Date.now() / 1000);
         var Days = 5;
         var CacheTime = Days * 24 * 60 * 60;
         $localStorage.FixedReferencesFactory = $localStorage.FixedReferencesFactory || {};
         $localStorage.FixedReferencesFactory.Cache = $localStorage.FixedReferencesFactory.Cache || null;
         if ($localStorage.FixedReferencesFactory.Cache == null || Today - $localStorage.FixedReferencesFactory.Cache >= CacheTime) {
            $localStorage.FixedReferencesFactory = {
               Cache: Math.floor(Date.now() / 1000), IsoCodes: null,
               References: null, DiscountCodes: null,
            }
         }
      }



      function setReferences(references) {
         self.factory.references = references;
         $localStorage.FixedReferencesFactory.References = references;
      }

      function setIsoCodes(IsoCodes) {
         self.factory.IsoCodes = IsoCodes;
         $localStorage.FixedReferencesFactory.IsoCodes = IsoCodes;
      }

      function loadIsoCodes(get) {
         return $http.post("api/IsoCodes/getAllCodes").then(function (response) {
            setIsoCodes(response.data.data);
            if (get == true) {
               return self.factory.IsoCodes;
            }
         }, function () {
            setIsoCodes(null);
            $state.go('error', {
               code: '500',
               message: 'An error occured loading the Country ISO Codes.'
            });
         });
      }

      function getIsoCodes() {
         cacheInit();
         if ($localStorage.FixedReferencesFactory.IsoCodes == null) {
            return loadIsoCodes(true);
         } else {
            self.factory.IsoCodes = $localStorage.FixedReferencesFactory.IsoCodes
            return $q.when(self.factory.IsoCodes);
         }
      }

      function getReferences() {
         cacheInit();
         if ($localStorage.FixedReferencesFactory.References == null) {
            return loadReferences(true);
         } else {
            self.factory.references = $localStorage.FixedReferencesFactory.References
            return $q.when(self.factory.references);
         }
      }
      function loadReferences(get) {

         return $http.post("api/test", {withCredentials: false}).then(function (response) {
            setReferences({
               ContributorRoles: response.data.ContributorRoles,
               BisacGroups: response.data.BisacGroups,
               Editions: response.data.EditionTypes,
               PublicationStatuses: response.data.PublicationStatuses,
               FixedProductTypes: response.data.MediaTypes,
               FixedProductForms: response.data.ProductForms,
               FixedProductFormDetails: response.data.ProductFormDetails,
               FixedProductFormDetailSpecifics: response.data.ProductFormDetailSpecifics,
               AudienceTypes: response.data.AudienceTypes,
            });
            if (get == true) {
               return self.factory.references;
            }

         }, function (response) {
            setReferences(null);
            $state.go('error', {
               code: '500',
               message: 'An error occured loading the fixed references.'
            });
            return;
         });
      }

      function lookupBisac(group, success, error) {

         $http.post("api/bisacs/getGroupCodes", {groupId: group}).then(function (response) {
            success(response.data);
         }, function (response) {
            $state.go('error', {
               code: '500',
               message: 'An error occured looking up the bisac code.'
            });
            return;
         });
      }


      function setDiscountCodes(DiscountCodes) {
         self.factory.DiscountCodes = DiscountCodes;
         $localStorage.FixedReferencesFactory.DiscountCodes = DiscountCodes;
      }

      function getDiscountCodes() {
         if ($localStorage.FixedReferencesFactory.DiscountCodes == null) {
            return AuthFactory.getInfo().then(function (response) {
               setDiscountCodes(response.clientinfo.DiscountCodes);
               return $q.when(self.factory.DiscountCodes);
            });
         } else {
            self.factory.DiscountCodes = $localStorage.FixedReferencesFactory.DiscountCodes
            return $q.when(self.factory.DiscountCodes);
         }
      }
   }]);
BMApp.register.factory('NewTitleDraftsFactory', ['$q', '$state', '$localStorage', 'AuthFactory', 'GuidCreator', '$timeout', function ($q, $state, $localStorage, AuthFactory, GuidCreator, $timeout) {
//      var self = this;
//      self.UserId = null;
//      self.Drafts = [];
//      self.Init = false;
//
//      self.factory = {
//         "Users": [
////            {
////               "UserID": 1,
////               "Drafts": [
////                  {
////                     "DraftId": "c0b589a1",
////                     "Created": 1449687962,
////                     "Data": "fdsfsdfsdfdsf"
////                  }
////               ]
////            },
//         ],
//         Cache: {},
//         SaveDraft: SaveDraft,
////         LoadDraft: LoadDraft,
//         GetDrafts: GetDrafts,
//      };
//      function cacheInit() {
//         return $q(function (resolve, reject) {
//            if (self.Init) {
//               resolve();
//               return;
//            }
//            $timeout(function () {
//               AuthFactory.getInfo().then(function (r) {
//                  self.UserId = r.credentials.userid;
//               });
//            }).then(function () {
//               var Today = Math.floor(Date.now() / 1000);
//               var Days = 5;
//               var CacheTime = Days * 24 * 60 * 60;
//               $localStorage.NewTitleDraftsFactory = $localStorage.NewTitleDraftsFactory || {};
//               $localStorage.NewTitleDraftsFactory.Cache = $localStorage.NewTitleDraftsFactory.Cache || null;
//               if ($localStorage.NewTitleDraftsFactory.Cache == null || Today - $localStorage.NewTitleDraftsFactory.Cache >= CacheTime) {
//                  $localStorage.NewTitleDraftsFactory = {
//                     Users: [], Cache: Math.floor(Date.now() / 1000)
//                  }
//               }
//               if (self.UserId != null) {
//                  self.Init = true;
//                  resolve();
//               } else {
//                  reject($state.go('error', {
//                     code: '500',
//                     message: 'An unknown error occured in NewTitleDraftsFactory. (Reject cacheInit() UserID was not returned)'
//                  }));
//               }
//            });
//         });
//      }
//
//
//      function SetStorage() {
//         return cacheInit().then(function () {
//            $localStorage.NewTitleDraftsFactory = self.factory;
//         })
//      }
//      function GetDrafts() {
//         return cacheInit().then(function () {
//            self.factory.Users = $localStorage.NewTitleDraftsFactory.Users || [];
//            
//            
//            if (self.factory.Users.length != 0) {
//               $.each(self.factory.Users, function (k, v) {
//                  if (v.UserID == self.UserId) {
//                     console.log(v)
//                     self.factory.Users = [v.Drafts];
//                  }
//               });
//            } else {
//               self.factory.Users = [];
//            }
//            console.log(typeof self.factory.Users, self.factory.Users);
//            return $q.when(self.factory.Users);
//         })
//      }
//
//      function ClearDrafts() {
//         return cacheInit().then(function () {
//            self.factory.Users[self.UserId] = [];
//            SetStorage();
//            return $q.when(self.factory.Users[self.UserId]);
//         });
//      }
//
//
//      function SaveDraft(data) {
//         return cacheInit().then(function () {
//
//            self.factory.Users = self.factory.Users || [];
//console.log(self.factory.Users)
//            var Draft = {
//               "UserID": self.UserId,
//               "Drafts": [
//                  {
//                     "DraftId": data.Form.DraftId,
//                     "Created": Math.floor(Date.now() / 1000),
//                     "Data": angular.toJson({
//                        form: data,
//                     })
//                  }
//               ]
//            }
//
//            if (self.factory.Users.length == 0) {
//               self.factory.Users.push(Draft)
//            } else {
//               $.each(self.factory.Users, function (k, v) {
//                  if (v.UserID == self.UserId) {
//                     v.Drafts.unshift(Draft.Drafts[0]);
//                  } else {
//                     self.factory.Users.push(Draft)
//                  }
//               });
//            }
//
//
////            if (self.factory.Users[self.UserId].length >= 4) {
////               self.factory.Users[self.UserId].length = 4;
////            }
//            SetStorage();
//            return $q.when(GetDrafts());
//         })
//      }
//      return self.factory;
   }]);

var Modals = {
   ContributorBSModal: function (data, Dependencies) {
      var self = this;
      self.entryData = undefined;
      self.Method = '';

      Dependencies.$timeout(function () {
         Dependencies.$scope.$watch(Dependencies.$scope.NTFNGForm.ContribModalForm.AdditionalTitleForm, function (newVal, oldVal) {
            console.log(newVal, oldVal);
         });
      })


      self.FirstName = '';
      self.MiddleName = '';
      self.LastName = '';
      self.Prefix = '';
      self.Suffix = '';
      self.Hometown = '';
      self.Role = '';
      self.Biography = '';

      self.FixedAuthorRoles = [];

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
   FormatBSModal: function (data, $scope) {
      var self = this;
      self.entryData = undefined;

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

      self.FixedProductTypes = [];
      self.FixedProductForms = [];
      self.FixedProductFormDetails = [];
      self.FixedProductFormDetailSpecifics = [];

      self.FixedIsoCodes = [];
      self.FixedIsoCodesPoop = [];

      self.FixedDiscountCodes = [];


      self.FixedEditionTypes = [];

      self.DynamicProductTypes = [];
      self.DynamicProductForms = [];
      self.DynamicProductFormDetails = [];
      self.DynamicProductFormDetailSpecifics = [];
      self.GetDynamicProductForms = GetDynamicProductForms;
      self.GetDynamicProductDetails = GetDynamicProductDetails;
      self.GetDynamicProductFormDetailSpecifics = GetDynamicProductFormDetailSpecifics;
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

      function GetDynamicProductForms() {

         if (typeof self.ProductType != 'undefined' || self.ProductType == '' || self.ProductType == null) {
            var SelectedProductType = self.ProductType;
            var newdata = self.FixedProductForms;
            self.DynamicProductForms = [];
            self.DynamicProductFormDetails = [];
            self.DynamicProductFormDetailSpecifics = [];
            self.ProductForm = "";
            self.ProductDetail = "";
            self.ProductBinding = "";
            self.DynamicProductForms = newdata.filter(function (el) {
               return el.MediaTypeId == SelectedProductType.Id;
            });
         }
      }

      function GetDynamicProductDetails() {
         if (typeof self.ProductForm != 'undefined' || self.ProductForm == '' || self.ProductForm == null) {
            var SelectedProductForm = self.ProductForm;
            var newdata = self.FixedProductFormDetails;
            self.DynamicProductFormDetails = [];
            self.DynamicProductFormDetailSpecifics = [];
            self.ProductDetail = "";
            self.ProductBinding = "";
            self.DynamicProductFormDetails = newdata.filter(function (el) {
               return el.FormId == SelectedProductForm.Id;
            });
         }
      }

      function GetDynamicProductFormDetailSpecifics() {
         if (typeof self.ProductDetail != 'undefined' || self.ProductDetail == '' || self.ProductDetail == null) {
            var SelectedProductFormDetail = self.ProductDetail;
            var newdata = self.FixedProductFormDetailSpecifics;
            self.DynamicProductFormDetailSpecifics = [];
            self.ProductBinding = "";
            self.DynamicProductFormDetailSpecifics = newdata.filter(function (el) {
               return el.FormDetailId == SelectedProductFormDetail.Id;
            });
         }
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
function BasicInfo(data) {
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
   }

}
var Contributors = function (data, Dependencies) {
   var vm = this;
   vm.Model = {
      Contributors: data || []
   };

   vm.ContributorModal = new Modals.ContributorBSModal('', Dependencies);

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
var Formats = function (data, Dependencies) {

   var self = this;
   self.Model = {
      Formats: data || []
   }
   self.FormatModal = new Modals.FormatBSModal('', Dependencies.$scope);

   self.showDialog = false;

   self.showFormatModal = function (data, method) {
      Dependencies.$scope.$broadcast('show-errors-reset');

      self.FormatModal.Method = method || 'edit';
      self.FormatModal.entryData = data;
      $.each(data, function (k, v) {
         self.FormatModal[k] = data[k] || null;
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
      Dependencies.$timeout(function () {
         self.FormatModal.GetDynamicProductFormDetailSpecifics();
      }).then(function () {
         self.FormatModal.ProductBinding = data.ProductBinding;
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
var Demographics = function (data, Dependencies) {

   var self = this;

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

   self.FixedList = [];
   self.FixedAudienceTypes = [];
   self.FixedIsoCodesPoop = [];


   Dependencies.$scope.$watchCollection(function () {
      return self.Model.Audience;
   }, function (newVal, oldVal) {
      if (newVal.Name == "Children/juvenile") {
         self.AgeRangeRequired = true;
         self.AgeRangeDisabled = false;

      } else {
         self.AgeRangeRequired = false;
         self.AgeRangeDisabled = true;


      }

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
function Covers(data, Dependencies) {
   var self = this;
   self.Model = {
      Covers: []
   }
   self.log = '';
   self.files = {};

   self.upload = function (file, isbn) {

      if (file) {
         var argisbn = isbn
         self.files[argisbn] = {};
         self.files[argisbn]['status'] = null;

       

         Dependencies.Upload.upload({
            url: 'http://api.bookmasters.com/Files/Cover',
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
   }

}
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
}
