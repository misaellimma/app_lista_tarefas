<?php

namespace App;

use MF\Init\Bootstrap;

class Route extends Bootstrap {

	protected function initRoutes() {

		$routes['home'] = array(
			'route' => '/',
			'controller' => 'indexController',
			'action' => 'index'
		);

		$routes['inscreverse'] = array(
			'route' => '/inscreverse',
			'controller' => 'indexController',
			'action' => 'inscreverse'
		);

		$routes['registrar'] = array(
			'route' => '/registrar',
			'controller' => 'indexController',
			'action' => 'registrar'
		);

		$routes['autenticar'] = array(
			'route' => '/autenticar',
			'controller' => 'AuthController',
			'action' => 'autenticar'
		);

		$routes['tarefas_pendentes'] = array(
			'route' => '/tarefas_pendentes',
			'controller' => 'AppController',
			'action' => 'tarefasPendentes'
		);

		$routes['nova_tarefa'] = array(
			'route' => '/nova_tarefa',
			'controller' => 'AppController',
			'action' => 'novaTarefa'
		);

		$routes['criar_tarefa'] = array(
			'route' => '/criar_tarefa',
			'controller' => 'AppController',
			'action' => 'criarTarefa'
		);

		$routes['todas_tarefas'] = array(
			'route' => '/todas_tarefas',
			'controller' => 'AppController',
			'action' => 'todasTarefas'
		);

		$routes['sair'] = array(
			'route' => '/sair',
			'controller' => 'AuthController',
			'action' => 'sair'
		);

		$this->setRoutes($routes);
	}

}

?>