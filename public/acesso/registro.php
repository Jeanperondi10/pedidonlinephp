<?php
   $retorno=array();

   // Lê o corpo da requisição
   $json = file_get_contents('php://input');

   // Converte o JSON em objeto PHP
   $data = json_decode($json,true);


   if (isset($data['nome']) && isset($data['email']) && isset($data['senha']) && isset($data['confirmasenha'])){
        if(!empty($data['nome']) &&!empty($data['email']) && !empty($data['senha']) && !empty($data['confirmasenha'])){
            if($data['senha']==$data['confirmasenha']){
                require_once('../class/Acesso.php');
                include_once('../config/database.php');
                //$status = $db->getAttribute(PDO::ATTR_CONNECTION_STATUS);
                //echo "Status da conexão: $status\n";
                
                $database = new Database();
                $db = $database->getConnection();
                
                
                

                $usuario = new Acesso\Usuario($db);
                $usuario->setNameTable('usuario');

                $credenciais=array();
                $credenciais['nome']=$data['nome'];
                $credenciais['email']=$data['email'];
                $credenciais['senha']=sha1($data['senha']);
                $usuario->setValues($credenciais);
                $consultaUser=$usuario->createRegistro();
                if($consultaUser['status']){
                    $retorno=array('status' => true, 'msg' => 'Sucesso! usuario criado');
                }else{
                    $retorno=array('status' => false, 'msg' => $consultaUser['message']);
                }
            }else{
                $retorno=array('status' => false, 'msg' => 'Ops! a confirmação da senha não equivale');
            }
        }else{
            $retorno=array('status' => false, 'msg' => 'Ops! Algum dos campos estão vazios');
        }
    }else{
      $retorno=array('status' => false, 'msg' => 'Ops! campos POST indefinidos "email" e "senha"');
    }

   echo(json_encode($retorno));