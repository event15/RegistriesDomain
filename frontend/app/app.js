(function() {
    "use strict";

    var app = angular
                .module("registriesFrontend", ["common.services", "ui.router", "registryResourceMock"/*, "positionResourceMock"*/]);

    app.config(
        ["$stateProvider", "$urlRouterProvider",
            function($stateProvider, $urlRouterProvider) {

                $urlRouterProvider.otherwise("/");

                $stateProvider
                    .state("home", {
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

                    .state("home.registry", {
                        url: "rejestry/dodaj",
                        templateUrl: "app/registries/registryEditView.html"
                    })


                    .state("home.positions", {
                        url: "pozycje/",
                        templateUrl: "app/positions/positionListView.html"
                    })


            }]
    );

}());
