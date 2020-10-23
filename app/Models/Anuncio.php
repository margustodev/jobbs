<?php



namespace App\Models;
use MF\Model\Model;

    class Anuncio extends Model{

        private $id;
        private $titulo;
        private $descricao;
        private $data_inicio;
        private $data_fim;
        private $ativo;
        private $fotos_trabalhos;
        
        private $perfilProfissional;
        private $cidades_atendidas; //cidade
        
        public function __get($attr){
            return $this->$attr;
        }
    
        public function __set($attr, $valor){
            $this->$attr = $valor;
        }



        public function salvar(){

            $resultado = false;
            $query = "INSERT INTO anuncio (titulo,descricao,data_inicio,ativo,fotos_trabalhos,perfil_profissional)
            VALUES (?,?,?,?,?,?);";


             $stmt = $this->db->prepare($query);
            $stmt->bindValue(1, $this->titulo);
            $stmt->bindValue(2, $this->descricao);
            $stmt->bindValue(3, $this->data_inicio);
            $stmt->bindValue(4, 1);
            $stmt->bindValue(5, $this->fotos_trabalhos);
            $stmt->bindValue(6, $this->perfilProfissional->id);

            $stmt->execute();

            if($this->db->lastInsertId() > 0)
            $resultado = true;

            return $resultado;

        }


        public function visualizarPorId($idUsuario){

            $query = "select distinct a.id, a.titulo, a.descricao,a.data_inicio,a.data_fim,a.ativo,a.fotos_trabalhos from anuncio as a
            INNER JOIN perfil_profissional as prof on a.perfil_profissional = prof.id
            INNER JOIN usuario as user on prof.usuario_id = ?";

             $stmt = $this->db->prepare($query);
            $stmt->bindValue(1, $idUsuario);
            $stmt->execute();
           
            return $stmt->fetchAll();

        }

        
        public function visualizarUltimos(){

            $query = "SELECT * from anuncio
            ORDER by data_inicio DESC";

             $stmt = $this->db->prepare($query);
            $stmt->execute();
           
            return $stmt->fetchAll();

        }






    }




?>