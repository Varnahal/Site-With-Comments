<?php

class comentarios{
    private $pdo;
    public function __construct($dbname,$host,$user,$pass) 
    {
        $opcoes = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8');
        
        try 
        {
            $this->pdo = new PDO("mysql:dbname=$dbname;host=$host;charset=utf8",$user,$pass,$opcoes);
        } catch (Exception $e) {
            echo"Erro por favor tente novamente. Erro:$e";
        }catch (PDOException $e) {
            echo"Erro por favor tente novamente. Erro:$e";
        }
    }
    public function buscarComentarios()
    {
        $cmd = $this->pdo->prepare("SELECT a.id,a.comentario,a.dia,a.horario,a.fk_id_usuraio,b.nome FROM comentarios a INNER JOIN usuarios b ON a.fk_id_usuraio = b.id ORDER BY a.id DESC");
        $cmd->execute();
        $dados = $cmd->fetchAll(PDO::FETCH_ASSOC);
        return $dados;
    }
}

?>