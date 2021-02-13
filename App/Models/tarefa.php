<?php
	namespace App\Models;

	use MF\Model\Model;

	class Tarefa extends Model{
		private $id;
		private $id_status;
		private $id_usuario;
		private $tarefa;
		private $data_tarefa;

		public function __get($atributo){
			return $this->$atributo;
		}

		public function __set($atributo, $valor){
			$this->$atributo = $valor;
		}

		public function salvar(){
			$query = 'insert into tb_tarefas(tarefa, id_usuario)values(:tarefa, :id_usuario)';
			$stmt = $this->db->prepare($query);
			$stmt->bindValue(':tarefa', $this->__get('tarefa'));
			$stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
			$stmt->execute();

			return true;
		}

		public function recuperarPendentes(){
			$query = '
				select 
					tr.id, 
					st.status,
					tr.tarefa, 
					tr.data_cadastrado 
				from 
					tb_tarefas as tr left join tb_status as st
					on (tr.id_status = st.id)
				where
					tr.id_usuario = :id_usuario and id_status = 1
			';
			$stmt = $this->db->prepare($query);
			$stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
			$stmt->execute();

			return $stmt->fetchAll(\PDO::FETCH_ASSOC);
		}

		public function recuperarTodas(){
			$query = '
				select 
					tr.id, 
					st.status,
					tr.tarefa, 
					tr.data_cadastrado 
				from 
					tb_tarefas as tr left join tb_status as st
					on (tr.id_status = st.id)
				where
					tr.id_usuario = :id_usuario
			';
			$stmt = $this->db->prepare($query);
			$stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
			$stmt->execute();

			return $stmt->fetchAll(\PDO::FETCH_ASSOC);
		}

		public function verificaAcao($acao){
			if($acao){
				if($acao['acao'] == 'remover' && isset($acao['id'])){
					$query = 'delete from tb_tarefas where id = :id and id_usuario = :id_usuario';
					$stmt = $this->db->prepare($query);
					$stmt->bindValue(':id', $acao['id']);
					$stmt->bindValue(':id_usuario', $this->__get('id_usuario'));

					$stmt->execute();

					return true;
				}

				if($acao['acao'] == 'marcarRealizado' && isset($acao['id'])){
					$query = 'update tb_tarefas set id_status = 2 where id = :id and id_usuario = :id_usuario';
					$stmt = $this->db->prepare($query);
					$stmt->bindValue(':id', $acao['id']);
					$stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
					$stmt->execute();

					return true;
				}
			}
		}
	}
?>