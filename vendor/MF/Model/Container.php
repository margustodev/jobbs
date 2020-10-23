<?php


namespace MF\Model;
use \App\Conexao;


/* 
    Instancia a classe de modelo para os controllers, assim como a conexao.
*/
    class Container{


        public static function getModel($model){

            $class = "\\App\\Models\\".$model;
            $conexao= Conexao::getConexao();

            return new $class($conexao);

        }





    }









?>