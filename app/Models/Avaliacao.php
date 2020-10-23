<?php

namespace \App\Models;

use MF\Model\Model;

    class Avaliacao extends Model{

        private $id;
        private $ativo;
        private $data_avaliacao;
        private $usuario;               // quem fez a avaliacao
        private $perfilProfissional;        //quem recebeu a avaliacao

        private $qualidade_servico;
        private $pontualidade;
        private $organização;

        private $comentario;

        public function __get($attr){
            return $this->$attr;
        }

        public function __set($attr, $valor){
            $this->$attr = $valor;
        }

    }



?>