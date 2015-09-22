(function() {
    "use strict";

    angular
        .module("registryManagement")
        .controller("RegistryListController", RegistryListController);

    function RegistryListController() {
        var vm = this;

        vm.registries = [
            {
                "id": 1,
                "name": "Rejestr samochodów 2015",
                "type": "samochody",
                "typeName": "Rejestr samochodów",
                "selected": "selected"
            },
            {
                "id": 2,
                "name": "Rejestr samochodów 2014",
                "type": "samochody",
                "typeName": "Rejestr samochodów",
                "selected": ""
            },
            {
                "id": 3,
                "name": "Rejestr samochodów 2013",
                "type": "samochody",
                "typeName": "Rejestr samochodów",
                "selected": ""
            },
            {
                "id": 4,
                "name": "Rejestr samochodów 2012",
                "type": "samochody",
                "typeName": "Rejestr samochodów",
                "selected": ""
            }
        ];
    }
}());