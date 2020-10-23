<?php

namespace App\Controllers;


use \MF\Controller\Action;
use \MF\Model\Container;



class AuthController extends Action{


	public function login() {

		$this->view->erroLogin = false;
		if(isset($_POST['login']) && isset($_POST['login'])){
			$usuario = Container::getModel('Usuario');

			$usuario->__set('login', $_POST['login']);
			$usuario->__set('senha', $_POST['senha']);
		

			if($usuario->validarLogin()){


				$usuario->autenticar();


					if($usuario->__get('id') != '' && $usuario->__get('nome') != ''){
					
						session_start();
						$_SESSION['id'] = $usuario->__get('id');
						$_SESSION['nome'] = $usuario->__get('nome');
						$_SESSION['acesso'] = $usuario->__get('acesso');
						$_SESSION['autenticado'] = true;
					
						header("Location: /");




						}	else{
						$this->view->erroLogin = true;
						$this->view->msgErro = "Usuário ou senha inválido(s).";

						$this->render('login');
					}


			}else{
				$this->view->erroLogin = true;
				$this->view->msgErro = "Erro na digitação dos campos.";
				$this->render('login');
			}
		
		}else{
			

			$this->render('login');
		}


		
		
	}


	public function logout(){

		session_start();
		
        //remover indices do array
        //unset($_SESSION['autenticado']);
    
    
        //destruir a variavel de session_abort
        session_destroy(); //efeito somente após mudar pagina
    
        //sugestao: forçar redirecionamento
		header("refresh:1 /");
		echo "Deslogado com sucesso. Redirecionando...";
        


	}


	// checa pela sessao
	public static function checkPermissao($acesso_minimo){

		$permissao = false;
		if(!isset($_SESSION)) 
		{ 
			session_start(); 
		} 

		
		if(isset($_SESSION['autenticado']) && isset($_SESSION['acesso'])){
			if($_SESSION['autenticado'] == 'true' && $_SESSION['acesso'] >= 0){
					echo "Usuario esta autenticado <hr>";
					echo "Usuario possui acesso -> ".$_SESSION['acesso']." <hr>";

					if($_SESSION['acesso'] >= $acesso_minimo){
						$permissao = true;
					
					}

					
			}
		}

		return $permissao;
	}

		// checa pela sessao
		public static function getIdSession(){

			$id = -1;
			if(!isset($_SESSION)) 
			{ 
				session_start(); 
			} 
	
			
			if(isset($_SESSION['autenticado']) && isset($_SESSION['id'])){
				if($_SESSION['autenticado'] == 'true' && $_SESSION['id'] > 0){
					
						echo "Usuario possui id -> ".$_SESSION['id']." <hr>";
						$id = $_SESSION['id'];
						return $id;
	
						
				}
			}
	
			return $id;
		}





}


?>