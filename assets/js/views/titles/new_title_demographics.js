var Demographics = function (data) {
    console.log('Demographics', data)
    var vm = this;
    //juv and jnf forces (children audience, makes age range required)  young adult, age range required
    vm.AgeFrom = data.AgeFrom || '';
    vm.AgeTo = data.AgeTo || '';
    vm.GradeFrom = data.GradeFrom || '';
    vm.GradeTo = data.GradeTo || '';
    vm.Bisacs = data.Bisacs || [];

    vm.FixedList = [];

    vm.UpdateBisacCodes = function (index) {
        vm.Bisacs[index].FixedList2 = [
            {
                "Index": index,
                "Name": "FICTION "
            }, {
                "Index": index + 1,
                "Name": "FICTION "
            },
        ]
    };

    vm.addBisac = function () {
        vm.Bisacs.push(new Components.Bisac(vm.FixedList || ''));
    };

    vm.removeBisac = function (index) {
        vm.Bisacs.splice(index, 1);
    };
}
