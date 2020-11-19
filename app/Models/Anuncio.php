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
            INNER JOIN usuario as user on prof.usuario_id = ? and a.ativo = 1";

             $stmt = $this->db->prepare($query);
            $stmt->bindValue(1, $idUsuario);
            $stmt->execute();
           
            return $stmt->fetchAll();

        }
            public function checkUsuario($idUsuario, $idANuncio){

                $query = "select count(*) from usuario
inner join perfil_profissional on perfil_profissional.usuario_id = usuario.id
inner join anuncio on anuncio.perfil_profissional = perfil_profissional.id
where usuario.id = :userid and anuncio.id = :anuncioid";
                    $stmt = $this->db->prepare($query);
                     $stmt->bindValue(':userid', $idUsuario);
                     $stmt->bindValue(':anuncioid', $idAnuncio);
                      $stmt->execute();

                      if($stmt->fetchColumn() == 0){
                          return true;
                      }else{
                          return false;
                      }

            }

                public function excluirAnuncio($idAnuncio){
                    echo "to aqui" .$idAnuncio;
                    $resultado = false;
            $query = "UPDATE anuncio SET ativo = 0 WHERE anuncio.id = ?";

             $stmt = $this->db->prepare($query);
            $stmt->bindValue(1, $idAnuncio);
            $stmt->execute();


            if($stmt->rowCount() > 0)
            $resultado = true;

            return $resultado;

        }

        
        public function visualizarUltimos(){

            $query = "SELECT * from anuncio
            ORDER by data_inicio ASC";

             $stmt = $this->db->prepare($query);
            $stmt->execute();
           
            return $stmt->fetchAll();

        }

        public function buscarAnuncios($chave, $local){


          //   $query = "SELECT distinct
          //   anuncio.descricao,
          //   anuncio.id,
          //   anuncio.titulo,
          //   anuncio.data_inicio,
          //   perfil_profissional.nome_publico,
          //   perfil_profissional.sobre,
          //   perfil_profissional.telefone,
          //   perfil_profissional.endereco_comercial,
          //   ramo_atividade.descricao
          // FROM anuncio
          //   INNER JOIN perfil_profissional
          //     ON anuncio.perfil_profissional = perfil_profissional.id
          //   INNER JOIN perfil_has_cidades
          //     ON perfil_has_cidades.id_perfil = perfil_profissional.id
          //   INNER JOIN cidade
          //     ON perfil_has_cidades.id_cidade = cidade.id
          //   INNER JOIN ramo_atividade
          //     ON perfil_profissional.ramo_atividade_id = ramo_atividade.id
          //      WHERE anuncio.descricao LIKE ? 
          //      AND cidade.nome like ?  
          //      AND anuncio.ativo = 1 
          //      AND perfil_profissional.ativo = 1 ORDER by anuncio.data_inicio ASC;";

            // $query = "SELECT * from anuncio
            // WHERE descricao like ?
            // ORDER by data_inicio ASC";

            $query = "SELECT anuncio.id, 
            anuncio.titulo, 
            anuncio.descricao,
            anuncio.data_inicio, 
            anuncio.fotos_trabalhos, 
            perfil_profissional.endereco_comercial
            ,perfil_profissional.nome_publico,
            perfil_profissional.sobre,
            ramo_atividade.descricao, 
            cidade.nome, 
            perfil_profissional.formas_pagamento
            ,fotoperfil.url 
            FROM anuncio 
            INNER JOIN perfil_profissional on perfil_profissional.id = anuncio.perfil_profissional 
            inner join ramo_atividade on perfil_profissional.ramo_atividade_id = ramo_atividade.id 
            inner join cidade on perfil_profissional.cidade_atuacao = cidade.id 
            inner join usuario on perfil_profissional.usuario_id = usuario.id 
            left join fotos_trabalhos on anuncio.id = fotos_trabalhos.id_anuncio 
            left join foto on fotos_trabalhos.id_foto = foto.id 
            left join foto as fotoperfil on foto.id = usuario.foto_perfil_id 
            where ramo_atividade.descricao like ? 
            and (cidade.nome like ? or cidade.estado like ?);";

             $stmt = $this->db->prepare($query);
             $stmt->bindValue(1, "%$chave%");
             $stmt->bindValue(2, "%$local%");
             $stmt->bindValue(3, "%$local%");
    
            $stmt->execute();
           
            return $stmt->fetchAll();

        }


        public function visualizarPorAnuncio($idAnuncio){


$query = "SELECT
  anuncio.titulo,
  anuncio.descricao,
  anuncio.id AS anuncio_id,
  perfil_profissional.nome_publico,
  perfil_profissional.sobre,
  perfil_profissional.endereco_comercial,
  usuario.nome,
  usuario.login,
  usuario.email,
  foto.url,
 perfil_profissional.formas_pagamento,
  cidade.nome,
  ramo_atividade.descricao,
  usuario.ativo from anuncio
    INNER JOIN perfil_profissional on perfil_profissional.id = anuncio.perfil_profissional 
            inner join ramo_atividade on perfil_profissional.ramo_atividade_id = ramo_atividade.id 
            inner join cidade on perfil_profissional.cidade_atuacao = cidade.id 
            inner join usuario on perfil_profissional.usuario_id = usuario.id 
            left join fotos_trabalhos on anuncio.fotos_trabalhos = fotos_trabalhos.id_anuncio 
            left join foto on fotos_trabalhos.id_foto = foto.id 
            left join foto as fotoperfil on foto.id = usuario.foto_perfil_id 
            WHERE anuncio.id = ?
           AND anuncio.ativo = 1
AND usuario.ativo = 1
AND perfil_profissional.ativo = 1";


// $query = "SELECT distinct
// anuncio.titulo,
// anuncio.descricao,
// anuncio.id AS anuncio_id,
// perfil_profissional.nome_publico,
// perfil_profissional.sobre,
// perfil_profissional.endereco_comercial,
// usuario.nome,
// usuario.login,
// usuario.email,
// foto.url,
// formas_pagamento.descricao as formas_pagamento,
// cidade.nome,
// ramo_atividade.descricao,
// usuario.ativo
// FROM anuncio
// INNER JOIN perfil_profissional
//   ON anuncio.perfil_profissional = perfil_profissional.id
// INNER JOIN usuario
//   ON perfil_profissional.usuario_id = usuario.id
// INNER JOIN foto
//   ON usuario.foto_perfil_id = foto.id
// INNER JOIN perfil_has_formas_pagamento
//   ON perfil_has_formas_pagamento.id_perfil = perfil_profissional.id
// INNER JOIN formas_pagamento
//   ON perfil_has_formas_pagamento.id_formas_pagamento = formas_pagamento.id
// INNER JOIN perfil_has_cidades
//   ON perfil_has_cidades.id_perfil = perfil_profissional.id
// INNER JOIN cidade
//   ON perfil_has_cidades.id_cidade = cidade.id
// INNER JOIN ramo_atividade
//   ON perfil_profissional.ramo_atividade_id = ramo_atividade.id
// WHERE anuncio.id = ?
// AND usuario.ativo = 1
// AND perfil_profissional.ativo = 1";

             $stmt = $this->db->prepare($query);
            $stmt->bindValue(1, $idAnuncio);
            $stmt->execute();
          
            return $stmt->fetchAll();

        }




    }




?>