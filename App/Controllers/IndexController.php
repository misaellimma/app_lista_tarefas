<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class IndexController extends Action {

	public function index() {

		$this->view->login = isset($_GET['login']) ? $_GET['login'] : '';

		$this->view->home = false;

		$this->render('index');
	}

	public function inscreverse(){

		$this->view->usuario = [
			'nome' => '',
			'email' => ''
		];

		$this->view->erroCadastro = false;


		if(isset($_GET['cadastro']) ? $_GET['cadastro'] : ''){
			$this->view->erroCadastro = true;
		}

		$this->view->home = false;


		$this->render('inscreverse');

	}

	public function registrar() {
		$usuario = Container::getModel('Usuario');

		$usuario->__set('nome', $_POST['nome']);
		$usuario->__set('email', $_POST['email']);
		$usuario->__set('senha', md5($_POST['senha']));

		if($usuario->validaCadastro() && count($usuario->getUsuarioPorEmail()) == 0){
			$usuario->salvar();

			header('Location: /');


		}else{

			$this->view->usuario = [
				'nome' => $_POST['nome'],
				'email' => $_POST['email']
			];

			$this->view->erroCadastro = true;

			header('Location: /inscreverse?cadastro=erro');
		}
	}
}
?>