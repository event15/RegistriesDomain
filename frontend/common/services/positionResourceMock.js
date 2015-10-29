(function() {
    "use strict";

    var app = angular.module("positionResourceMock", [/*"ngMockE2E"*/]);

    app.run(function($http) {

        var positionUrl = "/registries/web/rejestry/:registryId/pozycje/";

        $http.get(positionUrl);

        var editingRegex = new RegExp(positionUrl + "/[0-9][0-9]*", '');
        $httpBackend.whenGET(editingRegex).respond(function(method, url, data) {
            var position = { "id": 0 };
            var parameters = url.split('/');
            var length = parameters.length;
            var id = parameters[length - 1];

            if (id > 0) {
                for (var i = 0; i < positions.length; i++) {
                    if(positions[i].id == id) {
                        position = positions[i];
                        break;
                    }
                }
            }

            return [200, position, {}];
        });

        $httpBackend.whenPOST(editingRegex).respond(function(method, url, data) {
            var position = angular.fromJson(data);

            if (!position.positionId) {
                position.positionId = positions[positions.length - 1].positionId + 1;
                positions.push(position);
            } else {
                for (var i = 0; i < positions.length; i++) {
                    if (positions[i].positionId == position.positionId) {
                        positions[i] = position;
                    }
                }
            }

            return [201, position, {}];
        });

    });
})();