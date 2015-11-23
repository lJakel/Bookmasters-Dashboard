var Contributors = function (data) {
   var vm = this;
   console.log('Contributors', data)
   vm.Contributors = data || [];
   vm.ContributorModal = new Modals.ContributorBSModal('');

   vm.showDialog = false;


   vm.showContributorModal = showContributorModal;
   vm.onContributorModalAction = onContributorModalAction;
   vm.addContributor = addContributor;
   vm.removeContributor = removeContributor;



   function showContributorModal(data, method) {
      console.log(data, method)
      vm.ContributorModal.Method = method || 'edit';
      vm.ContributorModal.entryData = data;
      $.each(data, function (k, v) {
         vm.ContributorModal[k] = data[k] || null;
      });
      vm.showDialog = true;
   }
   function onContributorModalAction() {
      $.each(vm.ContributorModal.entryData, function (k, v) {
         vm.ContributorModal.entryData[k] = vm.ContributorModal[k];
      });
      if (vm.ContributorModal.Method === 'add') {
         vm.Contributors.push(vm.ContributorModal.entryData);
      }
      vm.showDialog = false;
   }
   function addContributor() {
      vm.showContributorModal(new Components.Contributor(''), 'add');
   }

   function removeContributor(index) {
      vm.Contributors.splice(index, 1);
   }
};