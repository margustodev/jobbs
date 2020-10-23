<?php

namespace App\Models;
use MF\Model\Model;

class Usuario extends Model{

    private $id;
    private $nome;
    private $login;
    private $senha;
    private $email;
    private $foto_perfil;
    private $acesso;
    private $ativo;

    public function __get($attr){
        return $this->$attr;
    }

    public function __set($attr, $valor){
        $this->$attr = $valor;
    }

    public function salvar(){

        try{

            $stmt = $this->db->beginTransaction();

            $queryExist = "select count(*) from usuario where login = :login or email = :email";


        $stmt = $this->db->prepare($queryExist);
        $stmt->bindValue(':login', $this->__get('login'));
        $stmt->bindValue(':email', $this->__get('senha'));

        $stmt->execute();
        $resultado = $stmt->fetchColumn();
        if($resultado > 0){
            $this->db->rollback();
            print_r("Registro já existe: ". $resultado);
            return false;
        }
        

        $query = "INSERT INTO usuario (nome, login, senha, email, acesso, ativo) 
        VALUES (?, ?, ?,?, 1, 1 )"; 

        $query2 = "INSERT INTO perfil_profissional 
        (ativo,usuario_id, cpf,data_nascimento,telefone,endereco_residencial,nome_publico,
        sobre,endereco_comercial,formas_pagamento, cidade_atuacao, ramo_atividade_id) 
        VALUES (1,:id_usuario,:cpf,:data_nascimento,:telefone,:endereco_residencial,:nome_publico, :sobre,
        :endereco_comercial,:formas_pagamento,:cidade_atuacao, :ramo_atividade) ";

      


        
        $stmt = $this->db->prepare($query);
 
        $stmt->bindValue(1, $this->__get('nome'));
        $stmt->bindValue(2, $this->__get('login'));
        $stmt->bindValue(3, $this->__get('senha'));
        $stmt->bindValue(4, $this->__get('email'));


         $stmt->execute();
         $id_inserido = $this->db->lastInsertId();

     
        $stmt = $this->db->prepare($query2);

        $stmt->bindValue(':cpf', $this->perfilProfissional->__get('cpf'));
        $stmt->bindValue(':id_usuario', $id_inserido);
        $stmt->bindValue(':data_nascimento', $this->perfilProfissional->__get('data_nascimento'));
        $stmt->bindValue(':telefone', $this->perfilProfissional->__get('telefone'));
        $stmt->bindValue(':endereco_residencial', $this->perfilProfissional->__get('endereco_residencial'));
        $stmt->bindValue(':nome_publico', $this->perfilProfissional->__get('nome_publico'));
        $stmt->bindValue(':sobre', $this->perfilProfissional->__get('sobre'));
        $stmt->bindValue(':endereco_comercial', $this->perfilProfissional->__get('endereco_comercial'));
        $stmt->bindValue(':formas_pagamento', $this->perfilProfissional->__get('formas_pagamento'));
        $stmt->bindValue(':cidade_atuacao', $this->perfilProfissional->__get('cidade_atuacao'));
        $stmt->bindValue(':ramo_atividade', $this->perfilProfissional->__get('ramo_atividade'));
      
        $stmt->execute();
      
        $this->db->commit();
        print_r("Ultimo id usuario:".$id_inserido);
        return true;

        }catch(\PDOException $e){
            $this->db->rollback();
            echo "Deu bug: ".$e->getMessage();
            return false;
        }





     }


     public function autenticar(){


        // $query = "select id, nome,acesso from usuario where email = :email and senha = :senha";
         $query = "select id, nome,acesso from usuario where login = :login and senha = :senha";
         $stmt = $this->db->prepare($query);
        // $stmt->bindValue(':email', $this->__get('email'));
         $stmt->bindValue(':login', $this->__get('login'));
         $stmt->bindValue(':senha', $this->__get('senha'));
         $stmt->execute();


         $usuario = $stmt->fetch(\PDO::FETCH_ASSOC);

         print_r($usuario);
         if(isset($usuario['id']) && isset($usuario['nome']) && isset($usuario['acesso']))
         if($usuario['id'] != '' && $usuario['nome'] != ''&& $usuario['acesso'] != '') {
             $this->__set('id', $usuario['id']);
             $this->__set('nome', $usuario['nome']);
             $this->__set('acesso', $usuario['acesso']);
         }

         return $this;

     }

     public function getUsuarioPorEmail(){
         $query = "SELECT nome, email FROM usuario WHERE email = :email;";
         $stmt = $this->db->prepare($query);
         $stmt->bindValue(':email', $this->__get('email'));
         $stmt->execute();
         return $stmt->fetchAll(\PDO::FETCH_ASSOC);

     }

     public function getUsuarioPorLogin(){
        $query = "SELECT nome, login FROM usuario WHERE login = :login;";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':login', $this->__get('login'));
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);

    }



     public function validarLogin(){

         $valido = true;
 
            //  if(strlen($this->__get('email')) < 5){
            //      echo strlen($this->__get('email'));
            //  $valido = false;
            //  }
             if(strlen($this->__get('senha')) < 3){
                 $valido = false;
             }
             if(strlen($this->__get('login')) < 3){
                $valido = false;
            }
 

         return $valido;
     }



}




?>