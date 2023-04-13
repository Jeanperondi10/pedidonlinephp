<?php
    namespace Comercio;

    require_once("CrudBase.php");

    class Categoria extends \CrudBase{
        public $descricao;
    }

    class Produto extends \CrudBase{
        public $categoria_id;
        public $anunciante_id;
        public $custo;
        public $preco;
        public $quantidade;
        public $datavalidade;
        public $relevancia;
        public $linkimagem;
    }
    class Pedido extends \CrudBase{
        public $situacao;
        public $usuario_id;
        public $produto_id;
        public $quantidade;
        public $data_criacao;
    }

