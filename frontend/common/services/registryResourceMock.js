(function() {
    "use strict";

    var app = angular.module("registryResourceMock", [/*"ngMockE2E"*/]);

    app.run(function($http) {
        var registryUrl = "/registries/web/rejestry/";

        $http.get(registryUrl);
    });
})();