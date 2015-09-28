(function() {
    "use strict";

    var app = angular
                .module("registriesFrontend", ["common.services", "ui.router", "registryResourceMock", "positionResourceMock"]);

    app.config(
        ["$stateProvider", "$urlRouterProvider",
            function($stateProvider, $urlRouterProvider) {

                $urlRouterProvider.otherwise("/");

                $stateProvider
                    .state("main", {
                        url: "/",
                        views: {
                            "showRegistries": {
                                templateUrl: "app/registries/registryListView.html",
                                controller: "RegistryListController as vm"
                            },
                            "showPositions": {
                                templateUrl: "app/positions/positionListView.html",
                                controller: "PositionListController as vm"
                            }
                        }

                    })
                    .state("main.addRegistry", {
                            url: "/dodaj",
                            templateUrl: "app/registries/registryEditView.html",
                            controller: "RegistryListController as vm"
                    })
            }]
    );

}());
