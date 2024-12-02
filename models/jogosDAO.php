<?php
class jogosDAO extends Conexao {

    // Método para verificar se a empresa já está cadastrada
    public function verificar($jogos) {
        $sql = "SELECT * FROM jogos WHERE link = ?";
        $stm = $this->db->prepare($sql);  // Usando $this->db
        $stm->bindValue(1, $jogos->getLink());
        $stm->execute();

        // Se encontrar um registro, a empresa já existe
        return $stm->rowCount() > 0;
    }

    public function cadastrar($jogos) {
        $this->db->beginTransaction(); // Inicia a transação
    
        try {
            // Cadastro da jogos
            $sql = "INSERT INTO jogos (titulo, link, descricao, id_adm) VALUES (?, ?, ?, ?)";
            $stm = $this->db->prepare($sql);
            $stm->bindValue(1, $jogos->getTitulo());
            $stm->bindValue(2, $jogos->getLink());
            $stm->bindValue(3, $jogos->getDescricao());
            $stm->bindValue(4, $jogos->getId_adm());
            $stm->execute();
    
            $this->db->commit(); // Confirma a transação

            //return "jogos cadastrada com sucesso!";
        } catch (PDOException $e) {
            $this->db->rollBack(); // Reverte a transação em caso de erro
            return "Erro ao cadastrar jogos: " . $e->getMessage();
        }
    }

}
?>
