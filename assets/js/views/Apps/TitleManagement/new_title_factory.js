BMApp.register.factory('FixedReferences', ['$http', '$q', '$state', '$timeout', '$localStorage', function ($http, $q, $state, $timeout, $localStorage) {
      var self = this;



      var Today = Math.floor(Date.now() / 1000);
      var Days = 5;
      var CacheTime = Days * 24 * 60 * 60;
      if (typeof $localStorage.FixedReferencesFactory.Cache == 'undefined' || $localStorage.FixedReferencesFactory.Cache == null || Today - $localStorage.FixedReferencesFactory.Cache >= CacheTime) {
         $localStorage.$reset({FixedReferencesFactory: {
               Cache: null,
               IsoCodes: null,
               References: null,
            }});
         $localStorage.FixedReferencesFactory.Cache = Math.floor(Date.now() / 1000);
      }

      var factory = {
         getReferences: getReferences,
         getIsoCodes: getIsoCodes,
         lookupBisac: lookupBisac,
         References: undefined,
         IsoCodes: undefined,
      };
      return factory;

      function setReferences(references) {
         factory.references = references;
         $localStorage.FixedReferencesFactory.References = references;
      }

      function setIsoCodes(IsoCodes) {
         factory.IsoCodes = IsoCodes;
         $localStorage.FixedReferencesFactory.IsoCodes = IsoCodes;
      }

      function loadIsoCodes(get) {
         return $http.post("api/IsoCodes/getAllCodes").then(function (response) {
            setIsoCodes(response.data.data);
            if (get == true) {
               return factory.IsoCodes;
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
         if (typeof $localStorage.FixedReferencesFactory.IsoCodes == 'undefined' || $localStorage.FixedReferencesFactory.IsoCodes == null) {
            return loadIsoCodes(true);
         } else {
            factory.IsoCodes = $localStorage.FixedReferencesFactory.IsoCodes
            return $q.when(factory.IsoCodes);
         }
      }

      function getReferences() {

         if (typeof $localStorage.FixedReferencesFactory.References == 'undefined' || $localStorage.FixedReferencesFactory.References == null) {
            return loadReferences(true);
         } else {
            factory.references = $localStorage.FixedReferencesFactory.References
            return $q.when(factory.references);
         }
      }
      function loadReferences(get) {
         return $http.post("http://api.bookmasters.com/itemmaster/references/all", {withCredentials: false}).then(function (response) {

            setReferences({
               ContributorRoles: response.data.ContributorRoles,
               BisacGroups: response.data.BisacGroups,
               Editions: response.data.Editions,
               PublicationStatuses: response.data.PublicationStatuses,
               FixedProductTypes: response.data.MediaTypes,
               FixedProductForms: response.data.ProductForms,
               FixedProductFormDetails: response.data.ProductFormDetails,
               FixedProductFormDetailSpecifics: response.data.ProductFormDetailSpecifics,
               AudienceTypes: response.data.AudienceTypes,
            });
            if (get == true) {
               return factory.references;
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
   }]);