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


        // visualizar proprio perfil
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
        public function editarPerfilProfissional(){

 if(AuthController::checkPermissao(1)){
        
        $idUsuario = AuthController::getIdSession();
   
		if(isset($_POST['nome_publico']) 
		&& isset($_POST['telefone'])
        && isset($_POST['endereco_comercial'])
        && isset($_POST['sobre'])
        && isset($_POST['formas_pagamento'])
        && isset($_POST['cidade_atuacao'])
        
	){

        $pgtos = $_POST['formas_pagamento'];
        $formas_pagamento_all = "";
        
        $perfilProfissional = Container::getModel('PerfilProfissional');

        $idPerfil = $perfilProfissional->getPerfisById($idUsuario);

        $perfilProfissional->__set('id',$idPerfil['id']);
        $perfilProfissional->__set('nome_publico',$_POST['nome_publico']);
        $perfilProfissional->__set('telefone',$_POST['telefone']);
        $perfilProfissional->__set('endereco_comercial',$_POST['endereco_comercial']);
        $perfilProfissional->__set('sobre',$_POST['sobre']);
        $perfilProfissional->__set('formas_pagamento',$_POST['formas_pagamento']);
        $perfilProfissional->__set('cidade_atuacao',$_POST['cidade_atuacao']);

		if($perfilProfissional->atualizarPerfil($perfilProfissional)){
			echo "Perfil Atualizado com sucesso";
			header("refresh:3 /");
			//$this->render('index','layout');
		}else{
			echo "Falha na atualizacao do perfil";

			header("Location: /meu_perfil?msg=erroB");
		}

	}else{
		echo "Falha na atualizacao do perfil";
		header("Location: /meu_perfil?msg=erroC");
    }

}else{
    echo "Você precisa fazer login";
    header("Location: /login?msg=erro");

}


        }

              //TODO upload de foto
        public function uploadFoto(){     
            
$target_dir = $_SERVER['DOCUMENT_ROOT']. "\\imagens\\";
$nome = rand();
$target_file = $target_dir . $nome . basename($_FILES["userFile"]["name"]);

$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image

  $check = getimagesize($_FILES["userFile"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }


// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["userFile"]["size"] > 5000000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["userFile"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $target_file)). " has been uploaded.";
    $url = $target_file;
    $this->view->$url = $url ;

    //TODO vai salvar foto no bd e pegar o id, ou vai só usar a url ?
    header("Location: /signup?data=".$target_file);
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}

        }



                            
                     






}