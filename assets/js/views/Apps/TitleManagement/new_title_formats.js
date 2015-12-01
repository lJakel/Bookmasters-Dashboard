var Formats = function (data, $scope, $timeout) {

   var self = this;
   console.log('Formats', data)
   self.Formats = data || [];
   self.FormatModal = new Modals.FormatBSModal('', $scope);

   self.showDialog = false;

   self.showFormatModal = function (data, method) {
      $scope.$broadcast('show-errors-reset');

      self.FormatModal.Method = method || 'edit';
      self.FormatModal.entryData = data;
      $.each(data, function (k, v) {
         self.FormatModal[k] = data[k] || null;
      });
      $timeout(function () {
         self.FormatModal.GetDynamicProductForms();
      }).then(function () {
         self.FormatModal.ProductForm = data.ProductForm;
      });
      $timeout(function () {
         self.FormatModal.GetDynamicProductDetails();
      }).then(function () {
         self.FormatModal.ProductDetail = data.ProductDetail;
      });
      $timeout(function () {
         self.FormatModal.GetDynamicProductFormDetailSpecifics();
      }).then(function () {
         self.FormatModal.ProductBinding = data.ProductBinding;
      });
      self.showDialog = true;
   };

   self.onFormatModalAction = function () {
      $.each(self.FormatModal.entryData, function (k, v) {
         self.FormatModal.entryData[k] = self.FormatModal[k];
      });
      if (self.FormatModal.Method === 'add') {
         self.Formats.push(self.FormatModal.entryData);
      }
      self.showDialog = false;
   };

   self.addFormat = function () {
      console.log('sad')
      self.showFormatModal(new Components.Format(''), 'add');
   };

   self.removeFormat = function (index) {
      self.Formats.splice(index, 1);
   };

};