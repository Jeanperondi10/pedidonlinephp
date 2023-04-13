<?php
    $json = file_get_contents('php://input');
    $data = json_decode($json,true);

    if(isset($data['cadastro'])){
        require_once('lib.php');
        //Verifica se algum valor enviado está vazio
        if(verificaArrayInfoVazio($data)){
            $tabela=$data['cadastro'];
            $objetoClasse = objetoTable($tabela);
            if($objetoClasse){
                $objetoClasse->setNameTable($tabela);
                $objetoClasse->setValues($data);
                $consultaUser=$objetoClasse->createRegistro();
                if($consultaUser['status']){
                    $retorno=array('status' => true, 'msg' => 'Sucesso! '.$tabela.' cadastrado');
                }else{
                    $retorno=array('status' => false, 'msg' => $consultaUser['message']);
                }
            }else{
                $retorno=array('status' => false, 'msg' => 'Ops! tipo "cadastro" inexistente');
            }
        }else{
            $retorno=array('status' => false, 'msg' => 'Ops! Algum dos campos enviados estão vazios');
        }
    }else{
        $retorno=array('status' => false, 'msg' => 'Erro! Não foi enviado o parametro "cadastro"');
    }
    echo(json_encode($retorno));