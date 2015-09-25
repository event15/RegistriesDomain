(function() {
    "use strict";

    angular
        .module("common.services")
        .factory("positionResource",
                    ["$resource",
                        positionResource]);

    function positionResource($resource) {
        return $resource("/positions/:positionId");
    }
})();