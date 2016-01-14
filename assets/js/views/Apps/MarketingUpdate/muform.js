BMApp.register.controller('MarketingUpdateCtrl', ['scriptLoader', '$stateParams', '$http', function (scriptLoader, $stateParams, $http) {
      var self = this;


      self.entries = [];

      $http.post('http://10.10.11.48/Bookmasters-Dashboard/marketingupdate/api', {}).then(function (e) {
         console.log(e.data.data);
         self.entries = e.data.data;
      }, function (e) {
         console.log(e);

      });

   }]);