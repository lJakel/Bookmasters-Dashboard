var Formats = function (data, Dependencies, References) {

   var self = this;
   self.Model = {
      Formats: data || []
   };
   self.FormatModal = new Modals.FormatBSModal('', Dependencies.$scope, References);

   self.showDialog = false;

   self.showFormatModal = function (data, method) {
      Dependencies.$scope.$broadcast('show-errors-reset');

      self.FormatModal.Method = method || 'edit';
      self.FormatModal.entryData = data;
      $.each(data, function (k, v) {
         self.FormatModal[k] = data[k] || null;
      });
      
      Dependencies.$timeout(function () {
         self.FormatModal.GetMediaTypes();
      }).then(function () {
         self.FormatModal.ProductType = data.ProductType;
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