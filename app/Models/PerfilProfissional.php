<?php

namespace App\Models;

use MF\Model\Model;

    class PerfilProfissional extends Model{

        private $id;
        private $ativo;
        private $cpf;
        private $data_nascimento;
        private $telefone;
        private $endereco_residencial;
        
        private $nome_publico;
        private $sobre;
        private $endereco_comercial;
        private $formas_pagamento;
        private $cidade_atuacao;

        private $usuario;
        private $avaliacao;
        private $ramo_atividade;



        public function __get($attr){
            return $this->$attr;
        }

        public function __set($attr, $valor){
            $this->$attr = $valor;
        }


        public function checkIdUsuario($idUsuario){

            $resultado = false;
            $query = "SELECT count(id) from perfil_profissional where
             usuario_id = ?";
    
             $stmt = $this->db->prepare($query);
            $stmt->bindValue(1, $idUsuario);
            $stmt->execute();
           

            if($stmt->fetchColumn() > 0)
            $resultado = true;
    
    echo $resultado;
            return $resultado;
    
        }

        
        public function getPerfisById($idUsuario){

            
            $query = "SELECT id, cidade_atuacao, nome_publico from perfil_profissional where
             usuario_id = ?";
    
             $stmt = $this->db->prepare($query);
            $stmt->bindValue(1, $idUsuario);
            $stmt->execute();
           
           
            $resultado = $stmt->fetch();

            return $resultado;
    
        }

        public function getPerfil($idUsuario){
            $query = "SELECT perfil_profissional.id,cid.nome as cidade,data_nascimento,telefone,endereco_comercial,nome_publico,sobre
            ,formas_pagamento,ativo FROM perfil_profissional 
            INNER JOIN cidade as cid on perfil_profissional.cidade_atuacao = cid.id
            WHERE usuario_id = ?";
        
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1, $idUsuario);
            $stmt->execute();
           
            return $stmt->fetch();
        
        }

        public function atualizarPerfil($perfil){

            $resultado = false;

            $query = "UPDATE perfil_profissional SET 
            nome_publico = ?, 
            telefone = ?, 
            endereco_comercial = ?, 
            sobre = ?, 
            formas_pagamento = ?, 
            cidade_atuacao = ?
            WHERE id = ?";

            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1, $perfil->__get('nome_publico'));
            $stmt->bindValue(2, $perfil->__get('telefone'));
            $stmt->bindValue(3, $perfil->__get('endereco_comercial'));
            $stmt->bindValue(4, $perfil->__get('sobre'));
            $stmt->bindValue(5, $perfil->__get('formas_pagamento'));
            $stmt->bindValue(6, $perfil->__get('cidade_atuacao'));
            $stmt->bindValue(7, $perfil->__get('id'));
            $stmt->execute();


            if($stmt->rowCount() > 0)
            $resultado = true;

            return $resultado;

        }


     
    }






?>