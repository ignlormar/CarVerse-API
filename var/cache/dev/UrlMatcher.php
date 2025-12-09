<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/_profiler' => [[['_route' => '_profiler_home', '_controller' => 'web_profiler.controller.profiler::homeAction'], null, null, null, true, false, null]],
        '/_profiler/search' => [[['_route' => '_profiler_search', '_controller' => 'web_profiler.controller.profiler::searchAction'], null, null, null, false, false, null]],
        '/_profiler/search_bar' => [[['_route' => '_profiler_search_bar', '_controller' => 'web_profiler.controller.profiler::searchBarAction'], null, null, null, false, false, null]],
        '/_profiler/phpinfo' => [[['_route' => '_profiler_phpinfo', '_controller' => 'web_profiler.controller.profiler::phpinfoAction'], null, null, null, false, false, null]],
        '/_profiler/open' => [[['_route' => '_profiler_open_file', '_controller' => 'web_profiler.controller.profiler::openAction'], null, null, null, false, false, null]],
        '/' => [[['_route' => 'index', '_controller' => 'App\\Controller\\DefaultController::index'], null, null, null, false, false, null]],
        '/usuarios' => [[['_route' => 'getUsuarios', '_controller' => 'App\\Controller\\UsuarioController::getUsuarios'], null, ['GET' => 0], null, false, false, null]],
        '/usuario/registro' => [[['_route' => 'registro', '_controller' => 'App\\Controller\\UsuarioController::createUsuario'], null, ['POST' => 0], null, false, false, null]],
        '/vehiculos' => [[['_route' => 'getVehiculos', '_controller' => 'App\\Controller\\VehiculosController::getVehiculos'], null, ['GET' => 0], null, false, false, null]],
        '/vehiculo/create' => [[['_route' => 'createVehiculo', '_controller' => 'App\\Controller\\VehiculosController::createVehiculo'], null, ['POST' => 0], null, false, false, null]],
        '/dispositivo/create' => [[['_route' => 'createDispositivo', '_controller' => 'App\\Controller\\DispositivosController::createDispositivo'], null, ['POST' => 0], null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_(?'
                    .'|error/(\\d+)(?:\\.([^/]++))?(*:38)'
                    .'|wdt/([^/]++)(*:57)'
                    .'|profiler/([^/]++)(?'
                        .'|/(?'
                            .'|search/results(*:102)'
                            .'|router(*:116)'
                            .'|exception(?'
                                .'|(*:136)'
                                .'|\\.css(*:149)'
                            .')'
                        .')'
                        .'|(*:159)'
                    .')'
                .')'
                .'|/usuario/([^/]++)/(?'
                    .'|update(*:196)'
                    .'|config/update(*:217)'
                    .'|vehiculos(*:234)'
                .')'
                .'|/vehiculo/([^/]++)(?'
                    .'|(*:264)'
                .')'
                .'|/dispositivo/([^/]++)(*:294)'
            .')/?$}sD',
    ],
    [ // $dynamicRoutes
        38 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        57 => [[['_route' => '_wdt', '_controller' => 'web_profiler.controller.profiler::toolbarAction'], ['token'], null, null, false, true, null]],
        102 => [[['_route' => '_profiler_search_results', '_controller' => 'web_profiler.controller.profiler::searchResultsAction'], ['token'], null, null, false, false, null]],
        116 => [[['_route' => '_profiler_router', '_controller' => 'web_profiler.controller.router::panelAction'], ['token'], null, null, false, false, null]],
        136 => [[['_route' => '_profiler_exception', '_controller' => 'web_profiler.controller.exception_panel::body'], ['token'], null, null, false, false, null]],
        149 => [[['_route' => '_profiler_exception_css', '_controller' => 'web_profiler.controller.exception_panel::stylesheet'], ['token'], null, null, false, false, null]],
        159 => [[['_route' => '_profiler', '_controller' => 'web_profiler.controller.profiler::panelAction'], ['token'], null, null, false, true, null]],
        196 => [[['_route' => 'updateUsuario', '_controller' => 'App\\Controller\\UsuarioController::updateUsuario'], ['id'], ['PUT' => 0], null, false, false, null]],
        217 => [[['_route' => 'updateConfig', '_controller' => 'App\\Controller\\UsuarioController::updateConfig'], ['idUsuario'], ['PUT' => 0], null, false, false, null]],
        234 => [[['_route' => 'getVehiculosByUser', '_controller' => 'App\\Controller\\VehiculosController::getVehiculosByUser'], ['userId'], ['GET' => 0], null, false, false, null]],
        264 => [
            [['_route' => 'deleteVehiculo', '_controller' => 'App\\Controller\\VehiculosController::deleteVehiculos'], ['id'], ['DELETE' => 0], null, false, true, null],
            [['_route' => 'updateVehiculo', '_controller' => 'App\\Controller\\VehiculosController::updateVehiculos'], ['id'], ['PUT' => 0], null, false, true, null],
        ],
        294 => [
            [['_route' => 'updateDispositivo', '_controller' => 'App\\Controller\\DispositivosController::updateDispositivo'], ['id'], ['PUT' => 0], null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
