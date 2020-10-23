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
           
           
            $resultado = $stmt->fetchAll();

            return $resultado;
    
        }

    }






?>