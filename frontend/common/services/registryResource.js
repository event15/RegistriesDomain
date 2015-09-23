(function() {
    "use strict";

    angular
        .module("common.services")
        .factory("registryResource",
            ["$resource", registryResource]);


    function registryResource($resource) {
        //return $resource("/api/registries/:registryId");
        return $resource("/registries/web/rejestry/:registryId");
    }
})();