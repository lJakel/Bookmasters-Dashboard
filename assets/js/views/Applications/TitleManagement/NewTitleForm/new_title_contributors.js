var Contributors = function (data, Dependencies, References) {
   var vm = this;
   vm.Model = {
      Contributors: data || []
   };

   vm.ContributorModal = new Modals.ContributorBSModal('', Dependencies, References);

   vm.showDialog = false;

   vm.showContributorModal = showContributorModal;
   vm.onContributorModalAction = onContributorModalAction;
   vm.addContributor = addContributor;
   vm.removeContributor = removeContributor;


   function showContributorModal(data, method) {

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
         vm.Model.Contributors.push(vm.ContributorModal.entryData);
      }
      vm.showDialog = false;
   }

   function addContributor() {
      vm.showContributorModal(new Components.Contributor(''), 'add');
   }

   function removeContributor(index) {
      vm.Model.Contributors.splice(index, 1);
   }
};