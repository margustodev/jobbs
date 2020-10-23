<?php

namespace App\Controllers;


use \MF\Controller\Action;
use \MF\Model\Container;


use App\Models;

class IndexController extends Action{



	/*
		Traz o que esta no phtml para essa class atraves do require(para esse contexto)
		Chama o método render, que vai fazer o require na view phtml
		Esses métodos serão chamados pelo Route.php
	*/
	public function index() {

		
		$anuncio = Container::getModel('Anuncio');
		$ultimos_anuncios = $anuncio->visualizarUltimos();

		$this->view->ultimos_anuncios = $ultimos_anuncios;

		$this->render('index','layout');
	}

	public function detalharAnuncio() {

	
		$anuncio = Container::getModel('Anuncio');
		$id = $_GET['id'];
		
		$anuncio = $anuncio->visualizarPorAnuncio($id);
	
		$this->view->anuncio = $anuncio;
		
		$this->render('detalha_anuncio','layout');
	}

	public function signup() {

		$cidade = Container::getModel('Cidade');
		$cidades = $cidade->getCidades();

		$ramo_atividade = Container::getModel('RamoAtividade');
		$ramo_atividades = $ramo_atividade->getRamoAtividades();

		$this->view->cidades = $cidades ;
		$this->view->ramo_atividades = $ramo_atividades;
		$this->render('signup','layout');
		
	}

	public function processa_registro() {
		print_r($_POST);
		if(isset($_POST['nome']) 
		&& isset($_POST['email'])
		&& isset($_POST['login'])
		&& isset($_POST['senha'])
		&& isset($_POST['cpf'])
		&& isset($_POST['data_nascimento'])
		&& isset($_POST['nome_publico'])
		&& isset($_POST['ramo_atividade_id'])
		&& isset($_POST['cidade_atuacao_id'])
	){

		$usuario = Container::getModel('Usuario');
		$perfilProfissional = Container::getModel('PerfilProfissional');
		
		$usuario->__set('nome', $_POST['nome']);
		$usuario->__set('email', $_POST['email']);
		$usuario->__set('login', $_POST['login']);
		$usuario->__set('senha', $_POST['senha']);
		


		$perfilProfissional->__set('ramo_atividade', $_POST['ramo_atividade_id']);

		$usuario->__set('acesso', 0);
		$usuario->__set('ativo', 1);
		$perfilProfissional->__set('ativo', 1);


		$perfilProfissional->__set('cpf', $_POST['cpf']);
		$perfilProfissional->__set('data_nascimento', $_POST['data_nascimento']);
		$perfilProfissional->__set('telefone', $_POST['telefone']);
		$perfilProfissional->__set('endereco_residencial', $_POST['endereco_residencial']);
		$perfilProfissional->__set('nome_publico', $_POST['nome_publico']);
		$perfilProfissional->__set('sobre', $_POST['sobre']);
		$perfilProfissional->__set('endereco_comercial', $_POST['endereco_comercial']);
		$perfilProfissional->__set('formas_pagamento', $_POST['formas_pagamento']);
		$perfilProfissional->__set('cidade_atuacao', $_POST['cidade_atuacao_id']);

		$usuario->__set('perfilProfissional', $perfilProfissional);

		echo "Setado";
		if($usuario->salvar()){
			echo "Criado com sucesso";
			header("refresh:3 /");
			
		}else{
			echo "Falha na criação do usuário";

			header("refresh:3 /signup?msg=erro");
		}

	}else{
		echo "Falha na criação do usuário";
		header("refresh:3 /signup?msg=erro");
	}
	



		
	}




}


?>