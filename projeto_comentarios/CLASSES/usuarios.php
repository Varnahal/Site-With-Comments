<?php

class usuario{
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
    public function cadastrar($n,$e,$s)
    {   
        $j = password_hash($s,PASSWORD_DEFAULT);
        $cmd = $this->pdo->prepare("SELECT id FROM usuarios WHERE email = :e");
        $cmd->bindValue(":e",$e);
        $cmd->execute();
        if($cmd->rowCount()==0)
        {
        $cmd = $this->pdo->prepare("INSERT INTO usuarios values(default,:n,:e,:s,'perfil.png')");
        $cmd->bindValue(":n",$n);
        $cmd->bindValue(":e",$e);
        $cmd->bindValue(":s",$j);
        $cmd->execute();
        return true;
        }else
        {
            return false;
        }
    }
    public function entrar($e,$s)
    {   
        $cmd = $this->pdo->prepare("SELECT * FROM usuarios WHERE email=:e");
        $cmd->bindValue(":e",$e);
        $cmd->execute();
        $j = $cmd->fetch();
        if($cmd->rowCount()>0){
            if(password_verify($s,$j['senha']))
            {
                $cmd = $this->pdo->prepare("SELECT * FROM usuarios WHERE senha=:s AND email=:e");
                $cmd->bindValue(":e",$e);
                $cmd->bindValue(":s",$j['senha']);
                $cmd->execute();
                if($cmd->rowCount()>0)
                {
                    $dados = $cmd->fetch();
                    //session_start();
                    if($dados['id'] == 1){
                        //ADM
                        $_SESSION['id_master'] = 1;
                    }else
                    {
                        //PLEBE
                        $_SESSION['id_user'] = $dados['id'];
                    }
                    return true;
                }
                else
                {
                    return false;
                }
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }

        
    }
    public function buscardados($id)
    {
       $cmd = $this->pdo->prepare("SELECT * FROM usuarios WHERE id = :id");
       $cmd->bindValue(":id",$id);
       $cmd->execute();
       $dados = $cmd->fetch(PDO::FETCH_ASSOC);
       return $dados;
    }
    public function buscarusuarios()
    {
        $cmd = $this->pdo->prepare("SELECT a.id,a.nome,a.email,COUNT(b.id) as 'quantidade' FROM usuarios a LEFT JOIN comentarios b ON a.id = b.fk_id_usuraio GROUP BY a.id");
        $cmd->execute();
        $dados = $cmd->fetchAll(PDO::FETCH_ASSOC);
        return $dados;
    }
    
        public function MudarInfoNome($id,$nome)
    {
        $cmd = $this->pdo->prepare("UPDATE usuarios
        SET nome = :n
        WHERE id = :id");
        $cmd->bindValue(":n",$nome);
        $cmd->bindValue(":id",$id);
        $cmd->execute();
        if($cmd->rowCount()>0){
            return true;
        }else{
            return false;
        }
    }
    public function MudarInfoSenha($id,$senha)
    {   
        $j = password_hash($senha,PASSWORD_DEFAULT);
        $cmd = $this->pdo->prepare("UPDATE usuarios
        SET senha = :s
        WHERE id = :id");
        $cmd->bindValue(":s",$j);
        $cmd->bindValue(":id",$id);
        $cmd->execute();
        if($cmd->rowCount()>0){
            return true;
        }else{
            return false;
        }
    }
    public function MudarInfoFoto($id,$foto)
    {   
        $cmd = $this->pdo->prepare("UPDATE usuarios
        SET foto = :f
        WHERE id = :id");
        $cmd->bindValue(":f",$foto);
        $cmd->bindValue(":id",$id);
        $cmd->execute();
        if($cmd->rowCount()>0){
            return true;
        }else{
            return false;
        }
    }
}

?>