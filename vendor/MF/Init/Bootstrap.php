<?php


    namespace MF\Init;


    /*
        Abstrair a Routes
    */
    abstract class Bootstrap{


  

        /* 
            Inicia o array de rotas criado.
            Pega a url (path) que o usuario esta, e passa para a funcao run,
            que vai comparar com o array de rotas para chamar o controlador especifico
            Já faz o trabalho apenas em instanciar essa classe
        */
        public function __construct(){
            $this->initRoutes();
            $this->run($this->getUrl());
        }

        public function getRoutes(){
            return $this->routes;
        }
    
        public function setRoutes(array $routes){
            $this->routes = $routes;
        }

/*      Pega o array de rotas, e compara com a url atual do usuario
            Se for igual, vai instanciar a classe controller dinamicamente
            de acordo com o nome que esta no array, e chamar o metodo que esta no action  */
        public function run($url){

            foreach ($this->getRoutes() as $path => $route) {

                if($url == $route['route']){
                    $class = "App\\Controllers\\".$route['controller'];

                    $controller = new $class;
                    $action = $route['action'];

                    $controller->$action();
                }
            }
        }

        /* 
            Pega dinamicamente o path que o usuario esta acessando
        */
        public function getUrl(){
            return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        }



    }



?>