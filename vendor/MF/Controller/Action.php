<?php


    namespace MF\Controller;

    abstract class Action{

	// Dados devem ser atribuidos aqui para aparecer na view.
	protected $view;

	// Cria obj standart para receber qualquer tipo de dado trabalhado nos metodos
	public function __construct(){
		$this->view = new \stdClass();
    }
    

	// Pode-se abstrair esse método para dentro do MF
	protected function render($view,$layout = 'layout'){
		$this->view->page = $view;
		require_once "../App/Views/".$layout.".phtml";


	}

	protected function content(){
		//Pega o diretório(index) de acordo com o nome da classe.
		$classeAtual = get_class($this);
		$classeAtual = str_replace('App\\Controllers\\', '', $classeAtual);
		$classeAtual = strtolower(str_replace('Controller', '', $classeAtual));


		require_once "../App/Views/".$classeAtual."/".$this->view->page.".phtml"; 

	}



    }
    


?>