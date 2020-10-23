<?php


namespace App\Models;
use MF\Model\Model;

    class Cidade extends Model{

        private $id;
        private $nome;
        private $estado;
    
        public function __get($attr){
            return $this->$attr;
        }
    
        public function __set($attr, $valor){
            $this->$attr = $valor;
        }


        public function getCidades(){

            $query = "Select id, nome, estado FROM Cidade;";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);

        }



    }




?>