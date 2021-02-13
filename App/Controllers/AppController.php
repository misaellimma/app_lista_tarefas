<?php

	namespace App\Controllers;

	use MF\Controller\Action;
	use MF\Model\Container;

	class AppController extends Action {

		public function tarefasPendentes(){
			session_start();

			print_r($_SESSION);

			if(!isset($_SESSION['id']) || empty($_SESSION['id'])){
				header('Location: /?login=erro');
			}
			if(!isset($_SESSION['nome']) || empty($_SESSION['nome'])){
				header('Location: /?login=erro');
			}
			$this->view->home = true;

			$tarefa = Container::getModel('Tarefa');
			$tarefa->__set('id_usuario', $_SESSION['id']);
			$tarefa->verificaAcao(isset($_GET) ? $_GET : '');

			$tarefas = $tarefa->recuperarPendentes();
			$this->view->tarefas = $tarefas;

			$this->render('tarefasPendentes');
		}

		public function novaTarefa(){

			session_start();
			
			if(!isset($_SESSION['id'])){
				header('Location: /?login=erro');
			}
			if(!isset($_SESSION['nome'])){
				header('Location: /?login=erro');
			}
			print_r($_SESSION);

			$this->view->home = true;

			$this->render('novaTarefa');
		}

		public function criarTarefa(){
			session_start();
			
			if(!isset($_SESSION['id']) || empty($_SESSION['id'])){
				header('Location: /?login=erro');
			}
			if(!isset($_SESSION['nome']) || empty($_SESSION['nome'])){
				header('Location: /?login=erro');
			}

			print_r($_SESSION);

			$tarefa = Container::getModel('Tarefa');
			$tarefa->__set('tarefa', $_POST['tarefa']);
			$tarefa->__set('id_usuario', $_SESSION['id']);
			$tarefa->salvar();

			$this->view->home = true;

			header('Location: /nova_tarefa');
		}

		public function todasTarefas(){
			session_start();

			$this->view->home = true;
			
			if(!isset($_SESSION['id']) || empty($_SESSION['id'])){
				header('Location: /?login=erro');
			}
			if(!isset($_SESSION['nome']) || empty($_SESSION['nome'])){
				header('Location: /?login=erro');
			}

			print_r($_SESSION);
			print_r($_POST);


			$tarefa = Container::getModel('Tarefa');
			$tarefa->__set('id_usuario', $_SESSION['id']);
			$tarefa->verificaAcao(isset($_GET) ? $_GET : '');

			$tarefas = $tarefa->recuperarTodas();
			$this->view->tarefas = $tarefas;

			$this->render('todasTarefas');
		}

		public function validaAutenticacao(){

			//print_r($_SESSION);

			$this->view->home = true;

			if(!isset($_SESSION['id']) || $_SESSION['id'] = ''){
				header('Location: /?login=erro');
			}
			if(!isset($_SESSION['nome']) || $_SESSION['nome'] = ''){
				header('Location: /?login=erro');
			}
		}
	}