<?php

namespace App\Controllers;


use \MF\Controller\Action;
use \MF\Model\Container;

use App\Models;


class AppController extends Action{


//tela inicial
    public function anuncioView(){
        if(AuthController::checkPermissao(1)){

            //$perfilProfissional = Container::getModel('PerfilProfissional');
           // $idUsuario = AuthController::getIdSession();
           // $resultado = $perfilProfissional->getPerfisById($idUsuario);
          //  $this->view->perfis = $resultado;
        $this->render('novo_anuncio','layout2');

    }else{
        echo "Você precisa fazer login";
        header("Location: /login?msg=erro");
    
    }



    }

    public function publicarAnuncio(){

   
        if(AuthController::checkPermissao(1)){
        
        $idUsuario = AuthController::getIdSession();
   
		if(isset($_POST['titulo']) 
		&& isset($_POST['descricao'])
        && isset($_POST['fotos'])
	){

		$anuncio = Container::getModel('Anuncio');
        $perfilProfissional = Container::getModel('PerfilProfissional');
        $usuario = Container::getModel('Usuario');
        $usuario->__set('id',$idUsuario);
		
		$anuncio->__set('titulo', $_POST['titulo']);
		$anuncio->__set('descricao', $_POST['descricao']);
        $anuncio->__set('fotos_trabalhos', $_POST['fotos']);
        $anuncio->__set('data_inicio', date("y-m-d"));

/*         if($perfilProfissional->checkIdUsuario($idUsuario)){
        $perfilProfissional->__set('id',$_POST['id_perfil']);


        echo "perfil bate";
        }else{
            echo "Falha na criação do anuncio";

			//header("Location: /novo_anuncio?msg=erroA");
        } */

        $idPerfil = $perfilProfissional->getPerfisById($idUsuario);

        $perfilProfissional->__set('id',$idPerfil['id']);
        $anuncio->__set('perfilProfissional',$perfilProfissional);
	
		if($anuncio->salvar()){
			echo "Criado com sucesso";
			header("refresh:3 /");
			//$this->render('index','layout');
		}else{
			echo "Falha na criação do anuncio";

			header("Location: /novo_anuncio?msg=erroB");
		}

	}else{
		echo "Falha na criação do anúncio";
		header("Location: /novo_anuncio?msg=erroC");
    }

}else{
    echo "Você precisa fazer login";
    header("Location: /login?msg=erro");

}
	



		
	}



    // visualizar proprio anuncios
    public function meusAnuncios(){

        if(AuthController::checkPermissao(1)){
        
        $idUsuario = AuthController::getIdSession();
        $anuncio = Container::getModel('Anuncio');
        $resultadoAnuncios = $anuncio->visualizarPorId($idUsuario);

        $this->view->anuncios = $resultadoAnuncios;
        


        $this->render('meus_anuncios','layout2');

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
            		$cidade = Container::getModel('Cidade');
		$cidades = $cidade->getCidades();

		$ramo_atividade = Container::getModel('RamoAtividade');
		$ramo_atividades = $ramo_atividade->getRamoAtividades();

		$this->view->cidades = $cidades ;
		$this->view->ramo_atividades = $ramo_atividades;
    
        
            $idUsuario = AuthController::getIdSession();
            $perfil = Container::getModel('PerfilProfissional');
 
                $perfil = $perfil->getPerfil($idUsuario);
                $this->view->perfil = $perfil;
            $this->render('meu_perfil','layout2');
    
            }else{
                echo "Você precisa fazer login";
                header("Location: /login?msg=erro");
            
            }
    
        }

        //TODO vai processar a alteração de perfil profissional do usuario e salvar no banco
        public function alterarPerfil(){




        }


                            
                     






}