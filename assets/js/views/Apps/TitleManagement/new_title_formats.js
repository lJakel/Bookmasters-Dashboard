var Formats = function (data, $scope) {

   var self = this;
   console.log('Formats', data)
   self.Formats = data || [];
   self.FormatModal = new Modals.FormatBSModal('');

   self.showDialog = false;

   self.showFormatModal = function (data, method) {
      $scope.$broadcast('show-errors-reset');
      console.log(data, method)
      self.FormatModal.Method = method || 'edit';
      self.FormatModal.entryData = data;
      $.each(data, function (k, v) {
         self.FormatModal[k] = data[k] || null;
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