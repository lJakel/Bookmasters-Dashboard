BMApp.register.factory('FixedReferences', ['$http', '$q', '$state', function ($http, $q, $state) {

    var url = 'http://api.bookmasters.com/references/';
    //var url = 'http://10.10.11.48/Sing/references.php';

    var factory = {
        getReferences: getReferences,
        references: undefined
    };

    return factory;

    function setReferences(references) {
        factory.references = references;
    }

    function loadReferences(get) {
        return $http.post(url, {withCredentials: false}).then(function (response) {

            setReferences({
                ContributorRoles: response.data.ContributorRoles,
                BisacGroups: response.data.BisacGroups,
                Editions: response.data.Editions,
                PublicationStatuses: response.data.PublicationStatuses,
                FixedProductTypes: response.data.MediaTypes,
                FixedProductForms: response.data.ProductForms,
                FixedProductFormDetails: response.data.ProductFormDetails,
                FixedProductFormDetailSpecifics: response.data.ProductFormDetailSpecifics,
            });

            if (get == true) {
                return factory.references;
            }

        }, function (response) {
            setReferences(null);
            console.log('Reference Factory Error, Would redirect  in production.')

            $state.go('error');

            return;
        });
    }

    function getReferences() {
        if (typeof (factory.references) == 'undefined') {
            return loadReferences(true);
        } else {
            return $q.when(factory.references);
        }
    }
}]);