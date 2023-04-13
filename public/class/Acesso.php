<?php
    namespace Acesso;

    require_once("CrudBase.php");

    class Usuario extends \CrudBase{
        public $email;
        public $senha;
        public $situacao;
        public $linkimagem;
        public $grupousuario_id;
        public $endereco;
        public $referencia;
        public $complemento;
        public $cep;
        public $cidade;
        public $uf;
        public $data_criacao;
        
        public function loginAcesso(){ 
            $sqlQuery = "SELECT * FROM ". $this->db_table ." WHERE email = ? AND senha = ? LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->email);
            $stmt->bindParam(2, $this->senha);

            if($stmt->execute()){
                $dataRow = $stmt->fetch(\PDO::FETCH_ASSOC);
                if(!is_bool($dataRow)){
                    $dataRow=$this->filtrarArray($dataRow,["senha"]);
                    $this->setValues($dataRow);
                }
                return ['status'=>true, 'data'=>$dataRow];
            }else{
                return ['status'=>false];
            }
        }
    }

    class GrupoUsuario extends \CrudBase{
        public $data_criacao;
        public $descricao;
        public $permpost;
        public $permget;
        public $permput;
        public $permdel;
    }
