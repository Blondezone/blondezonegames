<?php 
    class Admin
    {
        public function __construct(
            private int $id_adm = 0,
            private string $adm = "",
            private string $email = "",
            private string $senha = "",
        ){}

        public function getId_adm()
		{
			return $this->id_adm;
		}

		public function getAdm()
		{
			return $this->adm;
		}

        public function getEmail()
		{
			return $this->email;
		}
        
        public function getSenha()
		{
			return $this->senha;
		}
    }
?>