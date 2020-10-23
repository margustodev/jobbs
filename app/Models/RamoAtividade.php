<?php

namespace App\Models;

use MF\Model\Model;

    class RamoAtividade extends Model{

        private $id;
        private $descricao;


        public function __get($attr){
            return $this->$attr;
        }

        public function __set($attr, $valor){
            $this->$attr = $valor;
        }


        public function getRamoAtividades(){

            $query = "Select id, descricao FROM ramo_atividade;";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);

        }

    }

