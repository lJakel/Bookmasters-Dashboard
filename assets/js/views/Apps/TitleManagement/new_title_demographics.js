var Demographics = function (data, FixedReferences) {

   var vm = this;
   //juv and jnf forces (children audience, makes age range required)  young adult, age range required
   vm.AgeFrom = data.AgeFrom || '';
   vm.AgeTo = data.AgeTo || '';
   vm.GradeFrom = data.GradeFrom || '';
   vm.GradeTo = data.GradeTo || '';
   vm.Bisacs = data.Bisacs || [];

   vm.FixedList = [];
   vm.FixedAudienceTypes = [];
   vm.FixedIsoCodesPoop = [];

   vm.UpdateBisacCodes = function (index) {
      FixedReferences.lookupBisac(vm.Bisacs[index].BisacGroup.Id).then(function (response) {
         vm.Bisacs[index].FixedList2 = response.data;
      });
   };

   vm.addBisac = function () {
      vm.Bisacs.push(new Components.Bisac(vm.FixedList || ''));
   };

   vm.removeBisac = function (index) {
      vm.Bisacs.splice(index, 1);
   };
};