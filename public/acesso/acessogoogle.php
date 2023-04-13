<?php
    $token = $_POST["textjwt"];
    $data=json_decode(json_decode(json_encode(base64_decode(str_replace('_', '/', str_replace('-','+',explode('.', $token)[1]))))),true);
    $sit="";
    $consultalogin="";
    //echo var_dump($data);

    //echo "<br>------------<br>";
    //echo $data["name"];
    if(isset($data["sub"])){
            require_once("connectionbd.php");
            $idgoogle=sha1($data["sub"]);
            //echo("ID do Google: ".$idgoogle);
            $consultalogin="SELECT * FROM usuario WHERE idgoogle='$idgoogle'";

            $result = mysqli_fetch_assoc(mysqli_query($conexao, $consultalogin));

            if($result==null){//Não encontrou um cadastro, cria um novo
                if($data["email_verified"]==true){//E-mail verificado
                    $consulta="INSERT INTO `usuario` (`id`, `nome`, `type`, `email`, `fotoperfil`, `senha`, `idgoogle`) VALUES (NULL, '".$data["name"]."', 'comumgoogle', '".$data["email"]."', '".$data["picture"]."', NULL, '".$idgoogle."')";
                    //$consulta="SELECT * FROM usuarios WHERE email='$login'";
                    $result = mysqli_query($conexao, $consulta);
                    $sit="cadastro";
                }else{
                    $sit="email";
                }
            }else{//Encontrou um cadastro
                $sit="login";
            }
    }else{
        $sit="interno";
    }

    if($sit=="login" or $sit=="cadastro"){//inicia seção
        $result = mysqli_fetch_assoc(mysqli_query($conexao, $consultalogin));
        //var_dump($result);
        if($result!=false){
            session_start();
            $_SESSION["id"]=$result["id"];
            $_SESSION["nome"]=$result["nome"];
            $_SESSION["email"]=$result["email"];
            $_SESSION["fotoperfil"]=$result["fotoperfil"];
            $_SESSION["senha"]=$result["senha"];
            $_SESSION["idgoogle"]=$result["idgoogle"];
        }else{
            $sit="interno2";
        }
        echo $sit;
    }