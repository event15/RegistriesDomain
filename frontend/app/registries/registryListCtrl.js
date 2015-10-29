(function() {
    "use strict";

    angular
        .module("registriesFrontend")
        .controller("RegistryListController", ["registryResource", RegistryListController]);

    function RegistryListController(registryResource) {
        var vm = this;

        registryResource.query(function (data) {
            vm.registries = data;
        });
    }
}());