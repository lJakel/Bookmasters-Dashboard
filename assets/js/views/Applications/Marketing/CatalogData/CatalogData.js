BMApp.register.controller('GeneratedController', ['$state', '$timeout', '$http', 'toasty', function ($state, $timeout, $http, toasty) {
      console.log($state.params);
      var self = this;
      $timeout(function () {
         self.Catalogs = [];
         self.CreateCatalogModel = {
            Year: '2016',
            Season: 'Fall',
            Division: 'AtlasBooks'
         };

         self.CreateCatalog = function () {
            $http.post('Marketing/CatalogData/CreateCatalog', self.CreateCatalogModel).then(function (successResponse) {
               self.Catalogs = successResponse.data.data;
            }, function (errorResponse) {
               $.each(errorResponse.data.errors, function (k, item) {
                  toasty.error({title: 'Error!', msg: item.message, theme: 'bootstrap', timeout: 8000});
               });
            });
         };
         self.DeleteCatalog = function (id) {
            if (confirm('Are you sure you want to delete this catalog?')) {
               $http.post('Marketing/CatalogData/DeleteCatalog', {id: id}).then(function (successResponse) {
                  self.Catalogs = successResponse.data.data;
               }, function (errorResponse) {
                  $.each(errorResponse.data.errors, function (k, item) {
                     toasty.error({title: 'Error!', msg: item.message, theme: 'bootstrap', timeout: 8000});
                  });
               });
            }
         };

         $http.post('Marketing/CatalogData/GetAllCatalog').then(function (successResponse) {
            self.Catalogs = successResponse.data.data;
         }, function (errorResponse) {
            $.each(errorResponse.data.errors, function (k, item) {
               toasty.error({title: 'Error!', msg: item.message, theme: 'bootstrap', timeout: 8000});
            });
         });

      });
   }]);