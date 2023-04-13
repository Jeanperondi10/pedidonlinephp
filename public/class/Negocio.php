<?php
    namespace Negocio;

    require_once("CrudBase.php");

    class Ramo extends \CrudBase{
        public $descricao;
        public $percimpos;
    }

    class Anunciante extends \CrudBase{
        public $cnpj;
        public $ramo_id;
        public $email;
        public $telefone;
        public $celular;
        public $endereco;
        public $referencia;
        public $complemento;
        public $cep;
        public $cidade;
        public $uf;
        public $numero;
        public $linklogo;
    }

