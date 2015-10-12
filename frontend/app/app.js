(function() {
    "use strict";

    var app = angular
                .module("registriesFrontend", ["common.services", "ui.router"]);

    app.config(
        ["$stateProvider", "$urlRouterProvider",
            function($stateProvider, $urlRouterProvider) {

                $urlRouterProvider.otherwise("/");

                $stateProvider

                    /**
                     * Okno główne programu
                     *   - Widok listy rejestrów
                     *   - Widok listy pozycji w rejestrze
                     *
                     *   url: host/#/
                     */
                    .state("home", {
                        url: "/",
                        views: {
                            "sidebar": {
                                templateUrl: "app/registries/registryListView.html"
                                //controller: "RegistryListController as vm"
                            },
                            "main": {
                                templateUrl: "app/positions/positionListView.html"
                                //controller: "PositionListController as vm"
                            }
                        }

                    })

                    /**
                     *   Wysuwany panel dodawania rejestru
                     *
                     *   url: host/#/rejestry/dodaj
                     */
                    .state("home.registry", {
                        url: "rejestry/dodaj",
                        templateUrl: "app/registries/registryEditView.html"
                    })

                    /**
                     *   Wysuwany top dodawania pozycji w rejestrze.
                     *   W przyszłości musi być więcej
                     *
                     *   url: host/#/rejestry/dodaj
                     */
                    .state("home.positions", {
                        url: "pozycje/dodaj",
                        templateUrl: "app/positions/positionListView.html"
                    })
            }]
    );
}());
