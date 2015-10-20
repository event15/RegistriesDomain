(function () {
    "use strict";

    angular
        .module("common.services")
        .factory("positionResource",
        ["$resource",
            positionResource]);

    function positionResource($resource) {
        return $resource("/registries/web/rejestry/1/pozycje/:positionId");
    }
})();