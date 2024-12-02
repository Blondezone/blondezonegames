<?php
	class Jogos
	{
		public function __construct(private int $id_jogo = 0, private string $titulo = "", private string $link = "", private string $descricao = "", private int $id_adm = 0){}
		
		public function getId_jogo()
		{
			return $this->id_jogo;
		}

		public function getTitulo()
		{
			return $this->titulo;
		}

        public function getLink()
		{
			return $this->link;
		}

		public function getDescricao()
		{
			return $this->descricao;
		}

        public function getId_adm()
        {
            return $this->id_adm;
        }

	}
?>