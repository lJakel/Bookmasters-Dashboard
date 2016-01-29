BMApp.register.factory('FixedReferences', ['$http', '$q', '$state', '$timeout', '$localStorage', 'AuthFactory',
   function ($http, $q, $state, $timeout, $localStorage, AuthFactory) {
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


      function setReference(reference, name) {
         self.factory[name] = reference;
         $localStorage.FixedReferencesFactory[name] = reference;
      }




      function loadIsoCodes(get) {
         return $http.post("API/ISOCodes/Get").then(function (response) {
            setReference(response.data.data, 'IsoCodes');
            if (get == true) {
               return self.factory.IsoCodes;
            }
         }, function () {
            setIsoCodes(null, 'IsoCodes');
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

         return $http.post("API/FixedReferences/GetAllReferences", {withCredentials: false}).then(function (response) {

            setReference({
               ContributorRoles: response.data.ContributorRoles,
               BisacGroups: response.data.BisacGroups,
               Editions: response.data.EditionTypes,
               PublicationStatuses: response.data.PublicationStatuses,
               FixedProductTypes: response.data.MediaTypes,
               FixedProductForms: response.data.ProductForms,
               FixedProductFormDetails: response.data.ProductFormDetails,
               FixedProductFormDetailSpecifics: response.data.ProductFormDetailSpecifics,
               AudienceTypes: response.data.AudienceTypes,
            }, 'References');
            if (get == true) {
               return self.factory.References;
            }

         }, function (response) {
            setReference(null, 'References');
            $state.go('error', {
               code: '500',
               message: 'An error occured loading the fixed references.'
            });
            return;
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

      function getDiscountCodes() {
         if ($localStorage.FixedReferencesFactory.DiscountCodes == null) {
            return AuthFactory.getInfo().then(function (response) {
               setReference(response.clientinfo.DiscountCodes, 'DiscountCodes');
               return $q.when(self.factory.DiscountCodes);
            });
         } else {
            self.factory.DiscountCodes = $localStorage.FixedReferencesFactory.DiscountCodes
            return $q.when(self.factory.DiscountCodes);
         }
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
