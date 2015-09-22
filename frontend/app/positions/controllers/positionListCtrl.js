(function() {
    "use strict";

    angular
        .module("positionManagement")
        .controller("PositionListController", PositionListController);

    function PositionListController() {
        var vm = this;

        vm.positions = [
            {
                "id": 1,
                "brand": "Fiat",
                "model": "126p",
                "registerNo": "ZSD 12345",
                "description": "Mały samochodzik do wielkich rzeczy",
                "insurer": "PZU",
                "terms": {
                    "OC": "22/09/2015",
                    "AC": "23/09/2015",
                    "ASS": "24/09/2015",
                    "Review": "25/09/2015"
                }
            },
            {
                "id": 2,
                "brand": "Fiat",
                "model": "126p",
                "registerNo": "ZSD 12345",
                "description": "Mały samochodzik do wielkich rzeczy",
                "insurer": "PZU",
                "terms": {
                    "OC": "22/09/2015",
                    "AC": "23/09/2015",
                    "ASS": "24/09/2015",
                    "Review": "25/09/2015"
                }
            },
            {
                "id": 3,
                "brand": "Fiat",
                "model": "126p",
                "registerNo": "ZSD 12345",
                "description": "Mały samochodzik do wielkich rzeczy",
                "insurer": "PZU",
                "terms": {
                    "OC": "22/09/2015",
                    "AC": "23/09/2015",
                    "ASS": "24/09/2015",
                    "Review": "25/09/2015"
                }

            }
        ];
    }
}());