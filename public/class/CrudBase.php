<?php

interface InterfaceBasica  {
    public function getProperty($index);
    public function setID($idval);
    public function setValues($dados);

    public function getRegistros();
    public function getSingleRegistro();
    public function createRegistro();
    public function updateRegistro();
    public function deleteRegistro();
}

abstract class CrudBase implements InterfaceBasica{
    public $conn;
    public $db_table;
    public $id;
    public $nome;
    public function __construct($db){
        $this->conn = $db;
    }
    public function getProperty($index){
        return $this->{$index};
    }
    public function setID($idval){      
        $this->id = $idval;
    }
    public function setNameTable($name){    
        $this->db_table = $name;
    }
    public function setValues($dados){
        foreach ($dados as $chave => $valor) {
            $this->$chave=$valor;
        }
    }
    public function getColums(){
        $sqlQuery = "DESCRIBE " . $this->db_table;
        $stmt = $this->conn->prepare($sqlQuery);
        try {
            if ($stmt->execute()) {
                $dataRow = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return ['status'=>true, 'data'=>$dataRow];
            }
        } catch (PDOException $e) {
            return ['status'=>false,'message' =>$e->errorInfo[2]];
        }

    }
    public function getRegistros(){
        $sqlQuery = "SELECT * FROM " . $this->db_table;
        $stmt = $this->conn->prepare($sqlQuery);
        try {
            if ($stmt->execute()) {
                $dataRow = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return ['status'=>true, 'data'=>$dataRow];
            }
        } catch (PDOException $e) {
            return ['status'=>false,'message' =>$e->errorInfo[2]];
        }
    } 

    public function getSingleRegistro(){ 
        $sqlQuery = "SELECT * FROM ". $this->db_table ." WHERE id = ?LIMIT 0,1";

        $stmt = $this->conn->prepare($sqlQuery);

        $stmt->bindParam(1, $this->id);

        
        try {
            if ($stmt->execute()) {
                $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
                $this->setValues($dataRow);
                return ['status'=>true, 'data'=>$dataRow];
            }
        } catch (PDOException $e) {
            return ['status'=>false,'msg' =>$e->errorInfo[2]];
        }
    }  

    function deleteRegistro(){
        $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
        $stmt = $this->conn->prepare($sqlQuery);
    
        $this->id=htmlspecialchars(strip_tags($this->id));
    
        $stmt->bindParam(1, $this->id);
        
        try {
            if ($stmt->execute()) {
                return ['status'=>true];
            }
        } catch (PDOException $e) {
            return ['status'=>false,'message' =>$e->errorInfo[2]];
        }
    }

    public function filtrarArray($arrayDados, $arrayCampos){
        //Remove valores passados segundo parametro
        foreach ($arrayCampos as $valor) {
            if(isset($arrayDados[$valor])){
                unset($arrayDados[$valor]);
            }
        }
        //Remove valores indefinidos (NULL)
        foreach ($arrayDados as $chave=>$valor) {
            if(is_null($arrayDados[$chave])){
                unset($arrayDados[$chave]);
            }
        }
        return $arrayDados;
    }

    public function createRegistro(){
        /*
            Obtem propriedades da Classe e valores respectivamnete
            Retorna em um array com chaves e valores
            Remove campos indefinidos(NULL) e passados por parametro
        */
        $propriedades=$this->filtrarArray(get_object_vars($this),["conn","db_table","id","cadastro"]);
        
        $arrayConsulta=array();
        foreach ($propriedades as $chave => $valor) {
            array_push($arrayConsulta, "$chave = :$chave");
        }
        $campsConsulta=implode(',', $arrayConsulta);

        $sqlQuery = "INSERT INTO ". $this->db_table ." SET $campsConsulta";
        $stmt = $this->conn->prepare($sqlQuery); 
        
        foreach (array_keys($propriedades) as $chave) {
            $stmt->bindParam(':' . $chave, $propriedades[$chave]);
        }

        try {
            if ($stmt->execute()) {
                return ['status'=>true];
            }
        } catch (PDOException $e) {
            return ['status'=>false,'message' =>$e->errorInfo[2]];
        }
    }

    public function updateRegistro(){ 
        $propriedades=$this->filtrarArray(get_object_vars($this),["conn","db_table","id","cadastro"]);

        $arrayConsulta=array();
        foreach ($propriedades as $chave => $valor) {
            array_push($arrayConsulta, "$chave = :$chave");
        }
        $campsConsulta=implode(',', $arrayConsulta);

        $sqlQuery = "UPDATE ". $this->db_table ." SET $campsConsulta 
                    WHERE id = :id";
    
        $stmt = $this->conn->prepare($sqlQuery); 

        foreach (array_keys($propriedades) as $chave) {
            $stmt->bindParam(':' . $chave, $propriedades[$chave]);
        }
        $stmt->bindParam(':id', $this->id);
    
        try {
            if ($stmt->execute()) {
                return ['status'=>true];
            }
        } catch (PDOException $e) {
            if(isset($e->errorInfo[2])){
                $e=$e->errorInfo[2];
            }
            return ['status'=>false,'message' =>$e];
        }
    }
}