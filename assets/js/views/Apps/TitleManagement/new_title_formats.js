var Formats = function (data, $scope) {

    var vm = this;
    console.log('Formats', data)
    vm.Formats = data || [];
    vm.FormatModal = new Modals.FormatBSModal('');

    /*
    $scope.$watch('NTF.Formats.FormatModal.ProductForm', function (newvalue, oldvalue) {
        vm.FormatModal.GetDetails();
    });


    $scope.$watch('NTF.Formats.FormatModal.ProductDetail', function (newvalue, oldvalue) {
        vm.FormatModal.GetBindings();
    });
    */
    vm.showDialog = false;

    vm.showFormatModal = function (data, method) {
        console.log(data, method)
        vm.FormatModal.Method = method || 'edit';
        vm.FormatModal.entryData = data;
        $.each(data, function (k, v) {
            vm.FormatModal[k] = data[k] || null;
        });
        vm.showDialog = true;
    };

    vm.onFormatModalAction = function () {
        $.each(vm.FormatModal.entryData, function (k, v) {
            vm.FormatModal.entryData[k] = vm.FormatModal[k];
        });
        if (vm.FormatModal.Method === 'add') {
            vm.Formats.push(vm.FormatModal.entryData);
        }
        vm.showDialog = false;
    };

    vm.addFormat = function () {
        console.log('sad')
        vm.showFormatModal(new Components.Format(''), 'add');
    };

    vm.removeFormat = function (index) {
        vm.Formats.splice(index, 1);
    };

};