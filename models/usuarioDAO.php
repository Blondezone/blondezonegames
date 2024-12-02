<?php
	class usuarioDAO extends Conexao
	{
		public function __construct()
		{
			parent:: __construct();
		}

		//Verifica as credenciais do usuario com base no e-mail e senha.
		public function login($usuario)
		{
			$sql = "SELECT id_usuario, nome FROM usuario WHERE email = ? AND senha = ?";
			try
			{
				$stm = $this->db->prepare($sql);
				$stm->bindValue(1, $usuario->getEmail());
				$stm->bindValue(2, $usuario->getSenha());
				$stm->execute();
				$this->db = null;
				return $stm->fetchAll(PDO::FETCH_OBJ);
			}
			catch(PDOException $e)
			{
				$this->db = null;
				echo $e->getMessage();
				echo $e->getCode();
				die();
			}
		}

		//Insere um novo usuario no banco com os dados fornecidos
		public function cadastrar($usuario)
		{
			$sql = "INSERT INTO usuario (nome, email, senha) VALUES (?,?,?)";
			try {
				$stm = $this->db->prepare($sql);
				$stm->bindValue(1, $usuario->getNome());
				$stm->bindValue(2, $usuario->getEmail());
				$stm->bindValue(3, $usuario->getSenha());
				$stm->execute();
			} catch (PDOException $e) {
				echo $e->getMessage();
				echo $e->getCode();
				die();
			}
		}
        
		//Verifica a existência de um usuario com o e-mail e celular fornecidos.
		public function verificar($usuario)
		{
			$sql = "SELECT email FROM usuario WHERE email = ?";
			
			try {
				$stm = $this->db->prepare($sql);
				$stm->bindValue(1, $usuario->getEmail());
				$stm->execute();
				return $stm->fetchAll(PDO::FETCH_OBJ);
			} catch (PDOException $e) {
				echo $e->getMessage();
				echo $e->getCode();
				die();
			}
		}


	}
?>