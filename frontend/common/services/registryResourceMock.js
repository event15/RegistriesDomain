(function() {
    "use strict";

    var app = angular.module("registryResourceMock", [/*"ngMockE2E"*/]);

    app.run(function($http) {
        var registries = [
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

        var registryUrl = "/api/registries";
        //var registryUrl = "/registries/web/rejestry/";

        //$httpBackend.whenGET(registryUrl).respond(registries);
        $http.get("/registries/web/rejestry/");
       // $http.get(registryUrl); //.respond(registries);
    })
})();