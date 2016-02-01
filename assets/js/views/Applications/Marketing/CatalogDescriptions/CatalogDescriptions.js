BMApp.register.controller('CatalogDescriptionsController', ['toasty', '$http', function (toasty, $http) {
      var self = this;
      self.LoadedTitle = {};
      self.Titles = [];
      self.showTitleDialog = false;
      self.TitleModal = new modal('');
      self.PerPage = 6;
      
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
         if (self[Component + 'Modal'].Method === 'add') {
            self.Model[Component + 's'].push(self[Component + 'Modal'].entryData);
         }
         self['show' + Component + 'Dialog'] = false;

         $http.post('./Marketing/CatalogDescriptions/Update', self[Component + 'Modal'].entryData).then(function (response) {

         }, function (response) {

         });

      };

      self.LoadMe = function (data, index) {
         self.LoadedTitle = data;
      };
      self.LoadTitles = function () {
         $http.post('./Marketing/CatalogDescriptions/GetAll').then(function (resp) {
            self.Titles = $.map(resp.data.data, function (item) {
               return new Title(item);
            })
         }, function (resp) {
         });
      };
      self.LoadTitles();
   }]);
function Title(data) {
   var t = this;
   t.ID = data.ID || '';
   t.Title = data.Title || '';
   t.SubTitle = data.SubTitle || '';
   t.ISBN = data.ISBN || '';
   t.Authors = data.Authors || '';
   t.MainDescription = data.MainDescription || '';
   t.AuthorBios = data.AuthorBios || '';
   t.Complete = data.Complete || 0;
   t.Updated = data.Updated || 0;
}
function modal(data) {
   var self = this;
   self.entryData = undefined;
   self.Method = '';
   self.ID = data.ID || '';
   self.Title = data.Title || '';
   self.SubTitle = data.SubTitle || '';
   self.ISBN = data.ISBN || '';
   self.Authors = data.Authors || '';
   self.MainDescription = data.MainDescription || '';
   self.AuthorBios = data.AuthorBios || '';
   self.Complete = data.Complete || 0;
   self.Updated = data.Updated || 0;
}