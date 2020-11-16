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

            //Página inicial do site
            $routes['home'] = array(
                'route' => '/',
                'controller' => 'IndexController',
                'action' => 'index'
            );

            $routes['detalhar'] = array(
                'route' => '/detalhar',
                'controller' => 'IndexController',
                'action' => 'detalharAnuncio'
            );

            $routes['pesquisar'] = array(
                'route' => '/pesquisar',
                'controller' => 'IndexController',
                'action' => 'pesquisarAnuncio'
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

            //Tela de Cadastro do profissional
            $routes['/signup'] = array(
                'route' => '/signup',
                'controller' => 'IndexController',
                'action' => 'signup'
            );
                //Faz a validacao e insercao do usuario novo no sistema
            $routes['/processa_registro'] = array(
                'route' => '/processa_registro',
                'controller' => 'IndexController',
                'action' => 'processa_registro'
            );
                //Tela de novo registro de anuncio
                //TODO Upload de imagens
            $routes['/novo_anuncio'] = array(
                'route' => '/novo_anuncio',
                'controller' => 'AppController',
                'action' => 'anuncioView'
            );

            //Processa o anuncio
            //TODO passar url da foto
            $routes['/publica_anuncio'] = array(
                'route' => '/publica_anuncio',
                'controller' => 'AppController',
                'action' => 'publicarAnuncio'
            );

            //Tela onde exibe os proprios anuncios
            //Ta sem layout, sem fotos, etc
            $routes['/meus_anuncios'] = array(
                'route' => '/meus_anuncios',
                'controller' => 'AppController',
                'action' => 'meusAnuncios'
            );

                //Exibe a tela para alterar o perfil
                //TODO pré selecionar os campos que veio do usuario(formas de pgto e cidade de atuacao)
            $routes['/meu_perfil'] = array(
                'route' => '/meu_perfil',
                'controller' => 'AppController',
                'action' => 'meuPerfilProfissional'
            );

            //Vai receber os dados, e fazer um update nas
            //TODO
                        $routes['/editar_perfil'] = array(
                'route' => '/editar_perfil',
                'controller' => 'AppController',
                'action' => 'editarPerfilProfissional'
            );



            $this->setRoutes($routes);

        }
                            


    }


?>