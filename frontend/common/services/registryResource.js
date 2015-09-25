(function() {
    "use strict";

    angular
        .module("common.services")
        .factory("registryResource",
        ["$resource",
            registryResource]);

    function registryResource($resource) {
        return $resource("/registry/:registryId");
    }
})();