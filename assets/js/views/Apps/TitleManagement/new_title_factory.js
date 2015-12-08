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

      function lookupBisac(group) {
         return $http.post("api/bisacs/getGroupCodes", {groupId: group}).then(function (response) {
            return response.data;
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
      var self = this;
      self.Drafts = [];
      self.UserId = null;
      self.Init = false;
      self.factory = {
         Drafts: [],
         SaveDraft: SaveDraft,
//         LoadDraft: LoadDraft,
         GetDrafts: GetDrafts,
      };

      function cacheInit() {
         return $q(function (resolve, reject) {
            AuthFactory.getInfo().then(function (r) {

               self.UserId = r.credentials.userid;
               var Today = Math.floor(Date.now() / 1000);
               var Days = 5;
               var CacheTime = Days * 24 * 60 * 60;

               $localStorage.NewTitleDraftsFactory = $localStorage.NewTitleDraftsFactory || {};
               $localStorage.NewTitleDraftsFactory.Cache = $localStorage.NewTitleDraftsFactory.Cache || null;

               if ($localStorage.NewTitleDraftsFactory.Cache == null || Today - $localStorage.NewTitleDraftsFactory.Cache >= CacheTime) {
                  $localStorage.NewTitleDraftsFactory = {
                     Drafts: [], Cache: Math.floor(Date.now() / 1000)
                  }
               }
               resolve();
            }, function () {
               $state.go('error', {
                  code: '500',
                  message: 'An unknown error occured in NewTitleDraftsFactory.'
               });
               reject();
            });
         });
      }


      function SetStorage() {
         $localStorage.NewTitleDraftsFactory.Drafts[self.UserId] = self.factory.Drafts[self.UserId];
      }
      function GetDrafts() {
         return cacheInit().then(function () {
            self.factory.Drafts[self.UserId] = $localStorage.NewTitleDraftsFactory.Drafts[self.UserId] || [];
            return $q.when(self.factory.Drafts[self.UserId]);
         })
      }

      function ClearDrafts() {
         return cacheInit().then(function () {
            self.factory.Drafts[self.UserId] = [];
            SetStorage();
            return $q.when(self.factory.Drafts[self.UserId]);
         });
      }


      function SaveDraft(data) {
         return cacheInit().then(function () {

            self.factory.Drafts[self.UserId] = self.factory.Drafts[self.UserId] || [];

            self.factory.Drafts[self.UserId].unshift(angular.toJson({
               DraftId: GuidCreator.CreateGuid(),
               form: data,
               created: Math.floor(Date.now() / 1000),
            }));

            if (self.factory.Drafts[self.UserId].length >= 4) {
               self.factory.Drafts[self.UserId].length = 4;
            }

            SetStorage();
            return $q.when(GetDrafts());
         })


      }
      return self.factory;
   }]);
