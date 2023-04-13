<?php

    function verificaArrayInfoVazio($arrayData){
        foreach ($arrayData as $valor) {
            if(empty($valor)&&$valor!="0"){
                return false;
            }
        }
        return true;
    }

    function removedoArray($arrayDados, $arrayCampos){
        //Remove valores passados segundo parametro
        foreach ($arrayCampos as $valor) {
            foreach ($arrayDados as $chave=>$valor2) {
                if($valor==$valor2||$valor==$chave){
                    unset($arrayDados[$chave]);
                }
            }
        }
        //var_dump($arrayDados);
        return $arrayDados;
    }
    
    function obtemBancoDados(){
        include_once(__DIR__ .'/../config/database.php');
        $database = new Database();
        return $database->getConnection();
    }

    function objetoTable($tabela){
        $db=obtemBancoDados();

        $namesSpaces=['Acesso','Negocio','Comercio'];
        $objetosArray=[
            'usuario'=>$namesSpaces[0],
            'grupousuario'=>$namesSpaces[0],
            'ramo'=>$namesSpaces[1],
            'anunciante'=>$namesSpaces[1],
            'categoria'=>$namesSpaces[2],
            'produto'=>$namesSpaces[2],
            'pedido'=>$namesSpaces[2]
        ];

        if(isset($objetosArray[$tabela])){
            require_once(__DIR__ .'/../class/'.$objetosArray[$tabela].'.php');
            switch ($tabela) {
                case 'usuario':
                    return new Acesso\Usuario($db);
                    break;
                case 'grupousuario':
                    return new Acesso\GrupoUsuario($db);
                    break;
                case 'ramo':
                    return new Negocio\Ramo($db);
                    break;
                case 'anunciante':
                    return new Negocio\Anunciante($db);
                    break;
                case 'categoria':
                    return new Comercio\Categoria($db);
                    break;
                case 'produto':
                    return new Comercio\Produto($db);
                    break;
                case 'pedido':
                    return new Comercio\Pedido($db);
                    break;
                default:
                    return false;
                    break;
            }
        }else{
            return false;
        }
    }
