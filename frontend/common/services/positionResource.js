(function() {
    "use strict";

    angular
        .module("common.services")
        .factory("positionResource",
            ["$resource", positionResource]);


    function positionResource($resource) {
        return $resource("/rejestry/:registerId/pozycje/:positionId");
    }
})();