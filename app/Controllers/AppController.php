<?php

namespace App\Controllers;


use \MF\Controller\Action;
use \MF\Model\Container;

use App\Models;


class AppController extends Action{



    public function anuncioView(){
        if(AuthController::checkPermissao(1)){

            $perfilProfissional = Container::getModel('PerfilProfissional');
            $idUsuario = AuthController::getIdSession();
            $resultado = $perfilProfissional->getPerfisById($idUsuario);
            $this->view->perfis = $resultado;
        $this->render('novo_anuncio','layout');

    }else{
        echo "Você precisa fazer login";
        header("Location: /login?msg=erro");
    
    }



    }

    public function publicarAnuncio(){

        $autenticado = false;
        if(AuthController::checkPermissao(1)){
        
        $idUsuario = AuthController::getIdSession();
   
		if(isset($_POST['titulo']) 
		&& isset($_POST['descricao'])
        && isset($_POST['fotos'])
        && isset($_POST['id_perfil'])
	){

		$anuncio = Container::getModel('Anuncio');
		$perfilProfissional = Container::getModel('PerfilProfissional');
		
		$anuncio->__set('titulo', $_POST['titulo']);
		$anuncio->__set('descricao', $_POST['descricao']);
        $anuncio->__set('fotos_trabalhos', $_POST['fotos']);
        $anuncio->__set('data_inicio', date("y-m-d"));

        if($perfilProfissional->checkIdUsuario($idUsuario)){
        $perfilProfissional->__set('id',$_POST['id_perfil']);
        $perfilProfissional->__set('usuario',$idUsuario);
        $anuncio->__set('perfilProfissional',$perfilProfissional);
        echo "perfil bate";
        }else{
            echo "Falha na criação do anuncio";

			//header("Location: /novo_anuncio?msg=erroA");
        }


	
		if($anuncio->salvar()){
			echo "Criado com sucesso";
			header("refresh:3 /index");
			//$this->render('index','layout');
		}else{
			echo "Falha na criação do anuncio";

			header("Location: /novo_anuncio?msg=erroB");
		}

	}else{
		echo "Falha na criação do usuário";
		header("Location: /novo_anuncio?msg=erroC");
    }

}else{
    echo "Você precisa fazer login";
    header("Location: /login?msg=erro");

}
	



		
	}






    // visualizar proprio anuncio
    public function meusAnuncios(){

        if(AuthController::checkPermissao(1)){
        
        $idUsuario = AuthController::getIdSession();
        $anuncio = Container::getModel('Anuncio');
        $resultadoAnuncios = $anuncio->visualizarPorId($idUsuario);

        $this->view->anuncios = $resultadoAnuncios;
        


        $this->render('meus_anuncios','layout');

        }else{
            echo "Você precisa fazer login";
            header("Location: /login?msg=erro");
        
        }

    }


    public function alterarAnuncio(){






        
    }

    public function removerAnuncio(){






        
    }


        // visualizar proprio perfis
        public function meuPerfilProfissional(){

            if(AuthController::checkPermissao(1)){
            
            $idUsuario = AuthController::getIdSession();
            $perfil = Container::getModel('PerfilProfissional');
                $perfis = $perfil->getPerfisById($idUsuario);
                $this->view->perfis = $perfis;
            $this->render('meu_perfil','layout');
    
            }else{
                echo "Você precisa fazer login";
                header("Location: /login?msg=erro");
            
            }
    
        }

                // TODO
                public function criarPerfil(){

                    if(AuthController::checkPermissao(1)){
                    
                    $idUsuario = AuthController::getIdSession();
                    $perfil = Container::getModel('PerfilProfissional');
                        $perfis = $perfil->getPerfisById($idUsuario);
                        $this->view->perfis = $perfis;
                    $this->render('meu_perfil','layout');
            
                    }else{
                        echo "Você precisa fazer login";
                        header("Location: /login?msg=erro");
                    
                    }
            
                }

                                //TODO
                                public function processarPerfil(){

                                    if(AuthController::checkPermissao(1)){
                                    
                                    $idUsuario = AuthController::getIdSession();
                                    $perfil = Container::getModel('PerfilProfissional');
                                        $perfis = $perfil->getPerfisById($idUsuario);
                                        $this->view->perfis = $perfis;
                                    $this->render('meu_perfil','layout');
                            
                                    }else{
                                        echo "Você precisa fazer login";
                                        header("Location: /login?msg=erro");
                                    
                                    }
                            
                                }






}