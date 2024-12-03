<?php
class adminDAO extends Conexao
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getLastInsertedId() {
        return $this->db->lastInsertId();
    }    

    public function cadastrar(Admin $admin)
    {
        $sql = "INSERT INTO admins (adm, email, senha) VALUES (?, ?, ?)";
        try {
            $stm = $this->db->prepare($sql);
            $stm->bindValue(1, $admin->getAdm());
            $stm->bindValue(2, $admin->getEmail());
            $stm->bindValue(3, $admin->getSenha());
            $stm->execute();
        } catch (PDOException $e) {
            echo "Erro ao cadastrar administrador: " . $e->getMessage();
            echo "Código do erro: " . $e->getCode();
            die();
        }
    }

    public function login($adm)
		{
			$sql = "SELECT id_adm, adm FROM admins WHERE email = ? AND senha = ?";
			try
			{
				$stm = $this->db->prepare($sql);
				$stm->bindValue(1, $adm->getEmail());
				$stm->bindValue(2, $adm->getSenha());
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
}

?>