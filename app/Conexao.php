<?php

namespace App;


    class Conexao{

        static $host = 'localhost';
        static $user = 'root';
        static $pass = 'root';
        static $dbname = 'jobbs';

        static function getConexao(){

            try {

                $pdo = new \PDO('mysql:
                host='.self::$host.';
                dbname='.self::$dbname.'',
                ''.self::$user.'',
                ''.self::$pass.'');
                
                $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                $pdo->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
                return $pdo; 
    } catch (\PDOException $e) {
        echo "Falha na comunicaçao com o BD. </br>" .$e->getCode() . ' mensagem> ' . $e->getMessage();
    }


        }



    }





?>