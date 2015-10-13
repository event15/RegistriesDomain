(function() {
    "use strict";

    var app = angular
                .module("registriesFrontend", ["common.services", "ui.router"]);

    app.config(
        ["$stateProvider", "$urlRouterProvider",
            function($stateProvider, $urlRouterProvider) {

                $urlRouterProvider.otherwise("/");

                // TODO: modyfikuj wybrany rejestr i pozycję
                $stateProvider

                    /**
                     *   url: host/#/
                     */
                    .state("homeView", {

                        url: "/",
                        views: {
                            "sidebarView": {
                                templateUrl: "app/sidebarView.html",
                                controller: "RegistryListController as vm"
                            },
                            "contentView": {
                                templateUrl: "app/contentView.html"
                            }
                        }
                    })

                    /**
                     *   url: host/#/rejestry/dodaj
                     */
                    .state("homeView.registry", {
                        url: "rejestry/",
                        views:{
                            "registryListView": {
                                templateUrl: "app/registries/views/registryListView.html"
                            },
                            "addRegistryView": {
                                templateUrl: "app/registries/views/registryAddView.html"
                            }
                        }


                    })

                    /**
                     *   url: host/#/pozycje/dodaj
                     */
                    .state("homeView.positions", {
                        url: "pozycje/dodaj",
                        templateUrl: "app/positions/views/positionListView.html"

                    })
            }]
    );
}());
