BMApp.register.controller('GeneratedController', ['$state', '$stateParams', '$http', 'toasty', '$timeout', '$rootScope', 'Upload', '$sce', function ($state, $stateParams, $http, toasty, $timeout, $rootScope, Upload, $sce) {
      var self = this;
      self.showTitleDialog = false;
      self.PaginationModel = {
         Catalog: $state.params.params && $state.params.params.Catalog ? $state.params.params.Catalog : 18,
         TitleCount: 0,
         CurrentPage: 1,
         Limit: 40,
         PagesNum: []
      };


      self.EditTitleModal = function (data) {
         var m = this;
      };
      self.showEditTitleModal = function (data) {

         self.EditTitleModal.entryData = data;
         $.each(data, function (k, v) {
            self.EditTitleModal[k] = data[k] || null;
         });
         //self.Titles[title]
         self.showTitleDialog = true;
      };

      self.onEditTitleModalAction = function () {
         $.each(self.EditTitleModal.entryData, function (k, v) {
            self.EditTitleModal.entryData[k] = self.EditTitleModal[k] || null;
         });
      
         self.showTitleDialog = false;
      };

      self.ReloadCatalog = function () {
         console.log($state.current, $stateParams);
         $state.transitionTo('bm.app.page', {folder: 'Marketing', app: 'CatalogData', page: 'Index2', child: null, params: {Catalog: self.PaginationModel.Catalog}}, {reload: 'bm.app.page'});
      };

      self.Title = function (data) {
         var t = this;
         data = data || '';
         t.ID = data.ID || '';
         t.Page = data.Page || '';
         t.PageRank = data.PageRank || '';
         t.PerPage = data.PerPage || '';
         t.Title = data.Title || '';
         t.Subtitle = data.Subtitle || '';
         t.Publisher = data.Publisher || '';
         t.Imprint = data.Imprint || '';
         t.ISBN = data.ISBN || '';
         t.Format = data.Format || '';
         t.USPrice = data.USPrice || '';
         t.CANPrice = data.CANPrice || '';
         t.TrimW = data.TrimW || '';
         t.TrimH = data.TrimH || '';
         t.Pages = data.Pages || '';
         t.BisacCode = data.BisacCode || '';
         t.BisacDesc = data.BisacDesc || '';
         t.PublicationDate = data.PublicationDate || '';
         t.IllustrationsCount = data.IllustrationsCount || '';
         t.IllustrationsType = data.IllustrationsType || '';
         t.AgeFrom = data.AgeFrom || '';
         t.AgeTo = data.AgeTo || '';
         t.MainDesc = data.MainDesc || '';
         t.MainDescSafe = function () {
            return $sce.trustAsHtml(data.MainDesc)
         } || function () {
            return $sce.trustAsHtml('')
         };
         t.Author1Name = data.Author1Name || '';
         t.Author1Bio = data.Author1Bio || '';
         t.Author1BioSafe = function () {
            return $sce.trustAsHtml(data.Author1Bio)
         } || function () {
            return $sce.trustAsHtml('')
         };
         t.Author2Name = data.Author2Name || '';
         t.Author2Bio = data.Author2Bio || '';
         t.Author3Name = data.Author3Name || '';
         t.Author3Bio = data.Author3Bio || '';
         t.Author4Name = data.Author4Name || '';
         t.Author4Bio = data.Author4Bio || '';
         t.Author5Name = data.Author5Name || '';
         t.Author5Bio = data.Author5Bio || '';
         t.Discount = data.Discount || '';
         t.Catalog = data.Catalog || '';
         t.Updated = data.Updated || '';
         t.Random = Date.now();

      }

      $timeout(function () {

         self.UploadCover = function (files, isbn) {
            if (files && files.length) {
               for (var i = 0; i < files.length; i++) {
                  var file = files[i];
                  if (!file.$error) {
                     Upload.upload({
                        url: './Marketing/CatalogData/UploadCover',
                        method: 'POST',
                        data: {
                           file: file,
                           isbn: isbn,
                           catalog: self.PaginationModel.Catalog
                        },
                     }).then(function (resp) {
                        toasty.success({title: 'Success!', msg: 'Cover uploaded successfully.', theme: 'bootstrap', timeout: 3000});
                     }, null, function (evt) {
                     });
                  }
               }
            }

         };
         self.Pages = [];
         self.Titles = [0, 102, 30];
         self.AddPage = function () {
            self.Pages.push(new self.Page(''));
         };
         self.RefreshJSON = function () {
            self.JSON = JSON.stringify(self.Pages);
         };
         self.Collapse = function () {
            app.state["sidebar-left"] = !app.state["sidebar-left"];
         }

         self.UpdateTitle = function (title) {

            $http.post('Marketing/CatalogData/UpdateTitle', self.Titles[title]).then(function (successResponse) {
               self.Titles[title] = new self.Title(successResponse.data.data.Result[0]);
               toasty.success({title: 'Success!', msg: 'Title saved successfully.', theme: 'bootstrap', timeout: 5000});
            }, function (errorResponse) {
               $.each(errorResponse.data.errors, function (k, item) {
                  toasty.error({title: 'Error!', msg: item.message, theme: 'bootstrap', timeout: 8000});
               });
            });
         };

         self.ChangePage = function (Page) {
            $timeout(function () {
               toasty.info({title: 'Please Wait!', msg: 'Please wait while I load the information', theme: 'bootstrap', timeout: 2000});
            }, 500).then(function () {
               self.PaginationModel.CurrentPage = Page || 1;
               self.LoadTitles();
            });
         };
         self.LoadTitles = function () {
            $http.post('Marketing/CatalogData/GetAllTitles', self.PaginationModel).then(function (successResponse) {

               self.PaginationModel.Catalog = successResponse.data.data.Pagination.Catalog || 0;
               self.PaginationModel.TitleCount = successResponse.data.data.Pagination.TitleCount || 0;
               self.PaginationModel.CurrentPage = successResponse.data.data.Pagination.CurrentPage || 1;
               self.PaginationModel.Limit = successResponse.data.data.Pagination.Limit || 50;
               self.PaginationModel.PagesNum = successResponse.data.data.Pagination.PagesNum || [];
               self.Titles = $.map(successResponse.data.data.Result, function (item, i) {
                  return new self.Title(item);
               });
            }, function (errorResponse) {
               $.each(errorResponse.data.errors, function (k, item) {
                  toasty.error({title: 'Error!', msg: item.message, theme: 'bootstrap', timeout: 8000});
               });
            });
         }

         $http.post('Marketing/CatalogData/GetAllTitles', self.PaginationModel).then(function (successResponse) {

            self.PaginationModel.Catalog = successResponse.data.data.Pagination.Catalog || 0;
            self.PaginationModel.TitleCount = successResponse.data.data.Pagination.TitleCount || 0;
            self.PaginationModel.CurrentPage = successResponse.data.data.Pagination.CurrentPage || 1;
            self.PaginationModel.Limit = successResponse.data.data.Pagination.Limit || 50;
            self.PaginationModel.PagesNum = successResponse.data.data.Pagination.PagesNum || [];
            self.Titles = $.map(successResponse.data.data.Result, function (item, i) {
               return new self.Title(item);
            });
         }, function (errorResponse) {
            $.each(errorResponse.data.errors, function (k, item) {
               toasty.error({title: 'Error!', msg: item.message, theme: 'bootstrap', timeout: 8000});
            });
         });
      }, 1000);
   }]);
