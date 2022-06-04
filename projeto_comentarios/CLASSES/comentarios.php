<?php
date_default_timezone_set('America/Sao_Paulo');
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
        $cmd = $this->pdo->prepare("SELECT a.id,a.comentario,a.dia,a.horario,a.fk_id_usuraio,a.editado,b.nome,b.foto FROM comentarios a INNER JOIN usuarios b ON a.fk_id_usuraio = b.id ORDER BY a.id DESC");
        $cmd->execute();
        $dados = $cmd->fetchAll(PDO::FETCH_ASSOC);
        return $dados;
    }
    public function excluir($id_com,$id_user)
    {
        if($id_user == 1)//adm
        {
            $cmd = $this->pdo->prepare("DELETE FROM comentarios WHERE id = :id");
        $cmd->bindValue(":id",$id_com);
        $cmd->execute();
        }else
        {
            $cmd = $this->pdo->prepare("DELETE FROM comentarios WHERE id = :id_com AND fk_id_usuraio = :id_user");
            $cmd->bindValue(":id_com",$id_com);
            $cmd->bindValue(":id_user",$id_user);
            $cmd->execute();
        }
        
    }
    public function publicar($id,$com)
    {
        $cmd = $this->pdo->prepare("INSERT INTO comentarios(comentario, dia, horario, fk_id_usuraio,editado) VALUES (:c,:d,:h,:fk,0)");
        $cmd->bindValue(":c",$com);
        $cmd->bindValue(":d",date('Y-m-d'));
        $cmd->bindValue(":h",date('H:i'));
        $cmd->bindValue(":fk",$id);
        $cmd->execute();
    }
    public function editar($id_user,$com,$id_com){
        $cmd = $this->pdo->prepare("SELECT a.id,a.comentario,a.dia,a.horario,a.fk_id_usuraio,b.nome,b.foto,b.id FROM comentarios a INNER JOIN usuarios b ON a.fk_id_usuraio = b.id WHERE a.fk_id_usuraio = :fkid AND a.id = :id");
        $cmd->bindValue(':fkid',$id_user);
        $cmd->bindValue(':id',$id_com);
        $cmd->execute();
        if($cmd->rowCount() == 0){
            return false;
        }else{
            $p = $this->pdo->prepare("UPDATE comentarios SET comentario=:c,dia=:d,horario=:h,fk_id_usuraio=:fk,editado=1 WHERE id = :id AND fk_id_usuraio = :fkuser");
            $p->bindValue(':c',$com);
            $p->bindValue(':d',date('Y-m-d'));
            $p->bindValue(':h',date('H:i'));
            $p->bindValue(':fk',$id_user);
            $p->bindValue(':id',$id_com);
            $p->bindValue(':fkuser',$id_user);
            $p->execute();
        }
    }
}
?>