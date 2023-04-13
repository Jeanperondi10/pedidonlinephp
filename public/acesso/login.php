<?php
   // Lê o corpo da requisição
   $json = file_get_contents('php://input');
   $data = json_decode($json,true);

   if (isset($data['email']) && isset($data['senha'])){
      if(!empty($data['email']) && !empty($data['senha'])){
         require_once('../class/Acesso.php');
         include_once('../config/database.php');
         ob_start();
         $retorno=array();
         
         $database = new Database();
         $db = $database->getConnection();
         
         $usuario = new Acesso\Usuario($db);

         $credenciais=array();
         $credenciais['email']=$data['email'];
         $credenciais['senha']=sha1($data['senha']);

         $usuario->setValues($credenciais);
         $usuario->setNameTable('usuario');
         $consultaUser=$usuario->loginAcesso();
         
         if($consultaUser['status']){//Consulta OK
            if($consultaUser['data']!=false){//Se tiver sucesso e retornar usuario
               session_start();
               $dadosUser=$consultaUser['data'];
               foreach ($dadosUser as $chave => $valor) {
                  $_SESSION[$chave]=$valor;
               }
               $retorno=array('status' => true, 'msg' => 'Sucesso! feito login', 'redirect'=>'/adm/index.php');
            }else{
               $retorno=array('status' => false, 'msg' => 'Acesso Negado! credenciais incorretas');
            }
         }else{
            $retorno=array('status' => false, 'msg' => 'Ops! houve um problema ao executar a consulta');
         }
      }else{
         $retorno=array('status' => false, 'msg' => 'Ops! Algum dos campos estão vazios');
      }
   }else{
      $retorno=array('status' => false, 'msg' => 'Ops! campos POST indefinidos "email" e "senha"');
   }
   echo(json_encode($retorno));