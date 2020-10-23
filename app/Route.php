<?php

namespace App;


use MF\Init\Bootstrap;
/*
                Route > Controller
                        Controller > (require) > view
*/
    class Route extends Bootstrap{

   

        // Vai chamar os métodos 'action' nos 'controller', na pasta app/Controllers
        public function initRoutes(){
            $routes['home'] = array(
                'route' => '/',
                'controller' => 'IndexController',
                'action' => 'index'
            );

            $routes['login'] = array(
                'route' => '/login',
                'controller' => 'AuthController',
                'action' => 'login'
            );

            $routes['/logout'] = array(
                'route' => '/logout',
                'controller' => 'AuthController',
                'action' => 'logout'
            );

            
            $routes['/signup'] = array(
                'route' => '/signup',
                'controller' => 'IndexController',
                'action' => 'signup'
            );

            $routes['/processa_registro'] = array(
                'route' => '/processa_registro',
                'controller' => 'IndexController',
                'action' => 'processa_registro'
            );

            $routes['/novo_anuncio'] = array(
                'route' => '/novo_anuncio',
                'controller' => 'AppController',
                'action' => 'anuncioView'
            );

            $routes['/publica_anuncio'] = array(
                'route' => '/publica_anuncio',
                'controller' => 'AppController',
                'action' => 'publicarAnuncio'
            );

            $routes['/meus_anuncios'] = array(
                'route' => '/meus_anuncios',
                'controller' => 'AppController',
                'action' => 'meusAnuncios'
            );

            $routes['/meu_perfil'] = array(
                'route' => '/meu_perfil',
                'controller' => 'AppController',
                'action' => 'meuPerfilProfissional'
            );

            $routes['/criar_perfil'] = array(
                'route' => '/criar_perfil',
                'controller' => 'AppController',
                'action' => 'criarPerfil'
            );

            
            $routes['/processar_perfil'] = array(
                'route' => '/processar_perfil',
                'controller' => 'AppController',
                'action' => 'processarPerfil'
            );



            $this->setRoutes($routes);

        }
                            


    }


?>