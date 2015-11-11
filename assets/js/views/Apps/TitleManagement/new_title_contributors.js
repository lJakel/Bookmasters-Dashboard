var Contributors = function (data) {
   var vm = this;
   console.log('Contributors', data)
   vm.Contributors = data || [];
   vm.ContributorModal = new Modals.ContributorBSModal('');

   vm.showDialog = false;

   vm.showContributorModal = function (data, method) {
      console.log(data, method)
      vm.ContributorModal.Method = method || 'edit';
      vm.ContributorModal.entryData = data;
      $.each(data, function (k, v) {
         vm.ContributorModal[k] = data[k] || null;
      });
      vm.showDialog = true;
   };

   vm.onContributorModalAction = function () {
      $.each(vm.ContributorModal.entryData, function (k, v) {
         vm.ContributorModal.entryData[k] = vm.ContributorModal[k];
      });
      if (vm.ContributorModal.Method === 'add') {
         vm.Contributors.push(vm.ContributorModal.entryData);
      }
      vm.showDialog = false;
   };

   vm.addContributor = function () {
      vm.showContributorModal(new Components.Contributor(''), 'add');
   };

   vm.removeContributor = function (index) {
      vm.Contributors.splice(index, 1);
   };
}
