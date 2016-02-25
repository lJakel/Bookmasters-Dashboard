BMApp.register.controller('CatalogDescriptionsController', ['toasty', '$http', '$timeout', '$sce', 'TitleCase', function (toasty, $http, $timeout, $sce, TitleCase) {
      var self = this;
      $timeout(function () {


         self.LoadedTitle = {};
         self.Titles = [];
         self.DescriptionSets = [];
         self.showTitleDialog = false;

         self.Set = {"ID": "1", "Year": "2016", "Name": "Christian Catalog"};

         self.TitleModal = new modal('', TitleCase);
         self.ShowComplete = false;


         self.showItemModal = function (entryDataViewModel, Component, Method) {
            self[Component + 'Modal'].Method = Method || 'edit';
            self[Component + 'Modal'].entryData = entryDataViewModel;
            $.each(entryDataViewModel, function (k, v) {
               self[Component + 'Modal'][k] = entryDataViewModel[k] || null;
            });
            self['show' + Component + 'Dialog'] = true;
         };

         self.onItemModalAction = function (Component) {
            $.each(self[Component + 'Modal'].entryData, function (k, v) {
               self[Component + 'Modal'].entryData[k] = self[Component + 'Modal'][k];
            });
            self['show' + Component + 'Dialog'] = false;

            var url = './Marketing/CatalogDescriptions/';
            if (self[Component + 'Modal'].Method == 'add') {
               url = url + 'Create';
            } else {
               url = url + 'Update';
            }

            $http.post(url, self[Component + 'Modal'].entryData).then(function (response) {
               toasty.success({title: 'Success!', msg: 'Title updated successfully.', theme: 'bootstrap', timeout: 5000});

            }, function (response) {
               self.MapTitles(response.data.data);
               $.each(response.data.errors, function (k, v) {
                  toasty.error({title: 'Error!', msg: v.message, theme: 'bootstrap', timeout: 8000});
               });
            }).then(function () {
               self.LoadTitles();
            });
         };

         self.DeleteItem = function (data) {
            if (confirm('Are you sure you want to delete this title?')) {
               $http.post('./Marketing/CatalogDescriptions/Delete', data).then(function (response) {
                  toasty.success({title: 'Success!', msg: 'Title deleted successfully', theme: 'bootstrap', timeout: 5000});

               }, function (response) {
                  toasty.error({title: 'Error!', msg: 'A database error has occured.', theme: 'bootstrap', timeout: 8000});
               }).then(function () {
                  self.LoadTitles();
               });
            }
         };
         self.AddTitle = function (component) {
            self.showItemModal(new Title, component, 'add');
         };
         self.LoadMe = function (data, index) {
            self.LoadedTitle = data;
         };
         self.MapTitles = function (data) {
            self.Titles = $.map(data, function (item) {
               return new Title(item);
            });
         };


         self.LoadSets = function () {
            return $http.post('./Marketing/CatalogDescriptions/GetAllSets').then(function (response) {
               self.DescriptionSets = response.data.data;
               console.log(response.data.data);
            }, function (response) {

               $.each(response.data.errors, function (k, v) {
                  toasty.error({title: 'Error!', msg: v.message, theme: 'bootstrap', timeout: 8000});
               });

            });
         }
         self.LoadTitles = function () {
            $http.post('./Marketing/CatalogDescriptions/GetAll', {Set: self.Set.ID}).then(function (response) {
               self.MapTitles(response.data.data);
            }, function (response) {

               $.each(response.data.errors, function (k, v) {
                  toasty.error({title: 'Error!', msg: v.message, theme: 'bootstrap', timeout: 8000});
               });

            });
         };
         self.LoadSets().then(function () {
            self.LoadTitles();
         });

         function Title(data) {
            data = data || '';
            var t = this;
            t.ID = data.ID || '';
            t.Title = data.Title || '';
            t.SubTitle = data.SubTitle || '';
            t.ISBN = data.ISBN || '';
            t.Authors = data.Authors || '';
            t.Publisher = data.Publisher || '';
            t.MainDescription = data.MainDescription || '';
            t.AuthorBios = data.AuthorBios || '';
            t.MainDescriptionSafe = $sce.trustAsHtml(data.MainDescription || '');
            t.AuthorBiosSafe = $sce.trustAsHtml(data.AuthorBios || '');

            t.Complete = (data.Complete == 0 ? false : true);
            t.Catalog = self.DescriptionSets.filter(function (item) {
               return (item.ID == data.Catalog);
            })[0];
            t.Updated = data.Updated || 0;
            t.UpdatedDisplay = moment(data.Updated, "YYYY-MM-DD hh:mm:ss").format("dddd, MMMM Do YYYY, h:mm:ss a");
         }

         function modal(data, TitleCase) {
            var self = this;
            self.entryData = undefined;
            self.Method = '';
            self.ID = data.ID || '';
            self.Title = data.Title || '';
            self.SubTitle = data.SubTitle || '';
            self.ISBN = data.ISBN || '';
            self.Authors = data.Authors || '';
            self.Publisher = data.Publisher || '';
            self.MainDescription = data.MainDescription || '';
            self.AuthorBios = data.AuthorBios || '';
            self.Complete = data.Complete || 0;
            self.Catalog = data.Catalog || {"ID": "", "Year": "", "Name": ""};

            self.Updated = data.Updated || 0;



            self.ToTitleCase = function (model) {
               self[model] = TitleCase.ToTitleCase(self[model]);
            };
         }
      });
   }]);
