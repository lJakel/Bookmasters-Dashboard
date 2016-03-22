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
         self.Titles = [];
         self.PaginationModel = {
            Catalog: 0,
            TitleCount: 0,
            CurrentPage: 1,
            Limit: 50,
            PagesNum: []
         };

         self.ChangePage = function (Page) {
            self.PaginationModel.CurrentPage = Page || 1;
            self.LoadTitles();
         };

         self.ChangeCatalog = function (Catalog) {
            self.PaginationModel.CurrentPage = 1;
            self.PaginationModel.Catalog = Catalog.id;
            self.LoadTitles();
         };

         self.LoadCatalogEditor = function () {
            toasty.info({title: 'Redirection!', msg: 'Loading the catalog editor. Please wait', theme: 'bootstrap', timeout: 8000});
            $timeout(function () {
               $state.go('bm.app.page', {folder: 'Marketing', app: 'CatalogData', page: 'Index2', child: null, params: {Catalog: self.PaginationModel.Catalog}});
            }, 2000)
         };

         self.LoadTitles = function () {

            $http.post('Marketing/CatalogData/GetAllTitles', self.PaginationModel).then(function (successResponse) {
               self.Titles = successResponse.data.data.Result;

               self.PaginationModel.Catalog = successResponse.data.data.Pagination.Catalog || 0;
               self.PaginationModel.TitleCount = successResponse.data.data.Pagination.TitleCount || 0;
               self.PaginationModel.CurrentPage = successResponse.data.data.Pagination.CurrentPage || 1;
               self.PaginationModel.Limit = successResponse.data.data.Pagination.Limit || 50;
               self.PaginationModel.PagesNum = successResponse.data.data.Pagination.PagesNum || [];

            }, function (errorResponse) {
               $.each(errorResponse.data.errors, function (k, item) {
                  toasty.error({title: 'Error!', msg: item.message, theme: 'bootstrap', timeout: 8000});
               });
            });

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