<?php

class usuario{
    private $pdo;

    //conexão com banco de dados
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
    //cadastrar informações do usuario no banco de dados
    public function cadastrar($n,$e,$s,$desc=null)
    {   
        //verificar se email já esta cadastrado
        $j = password_hash($s,PASSWORD_DEFAULT);
        $cmd = $this->pdo->prepare("SELECT id FROM usuarios WHERE email = :e");
        $cmd->bindValue(":e",$e);
        $cmd->execute();
        //caso nn esteja cadastrado cadastrar
        if($cmd->rowCount()==0)
        {
        $cmd = $this->pdo->prepare("INSERT INTO usuarios values(default,:n,:e,:s,'perfil.png',:d,default)");
        $cmd->bindValue(":n",$n);
        $cmd->bindValue(":e",$e);
        $cmd->bindValue(":s",$j);
        $cmd->bindValue(":d",$desc);
        $cmd->execute();
        return true;
        }else
        {
            return false;
        }
    }

    //verificar se usuario esta no banco de dados e efetuar o login
    public function entrar($e,$s)
    {   
        //verificar email
        $cmd = $this->pdo->prepare("SELECT * FROM usuarios WHERE email=:e");
        $cmd->bindValue(":e",$e);
        $cmd->execute();
        $j = $cmd->fetch();
        if($cmd->rowCount()>0){
            //verificar se a senha está correta
            if(password_verify($s,$j['senha']))
            {
                $cmd = $this->pdo->prepare("SELECT * FROM usuarios WHERE senha=:s AND email=:e");
                $cmd->bindValue(":e",$e);
                $cmd->bindValue(":s",$j['senha']);
                $cmd->execute();
                if($cmd->rowCount()>0)
                {
                    $dados = $cmd->fetch();
                    if($dados['id'] == 1){
                        //atribui o id para o id na session quando se é ADM
                        $_SESSION['id_master'] = 1;
                    }else
                    {
                        //atribui o id para o id na session quando se é PLEBE
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

    //busca todos os dados do usuario com base no id
    public function buscardados($id)
    {
       $cmd = $this->pdo->prepare("SELECT * FROM usuarios WHERE id = :id");
       $cmd->bindValue(":id",$id);
       $cmd->execute();
       $dados = $cmd->fetch(PDO::FETCH_ASSOC);
       return $dados;
    }

    //buscar usuarios e seus comentarios para mostrar em dados
    public function buscarusuarios()
    {
        $cmd = $this->pdo->prepare("SELECT a.id,a.nome,a.email,COUNT(b.id) as 'quantidade' FROM usuarios a LEFT JOIN comentarios b ON a.id = b.fk_id_usuraio GROUP BY a.id");
        $cmd->execute();
        $dados = $cmd->fetchAll(PDO::FETCH_ASSOC);
        return $dados;
    }
    
    //mudar nome no banco de dados com base no id
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
            $cmd = $this->pdo->prepare("SELECT * FROM usuarios WHERE nome = :n AND id = :id");
        $cmd->bindValue(":n",$nome);
        $cmd->bindValue(":id",$id);
        $cmd->execute();
        if($cmd->rowCount()>0){
            return true;
        }else{
            return false;
        }   
        }
    }

    //mudar senha no banco de dados com base no id
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

    //mudar descrição no banco de dados com base no id
    public function MudarInfoDesc($id,$desc)
    {
        $cmd = $this->pdo->prepare("UPDATE usuarios
        SET descricao = :d
        WHERE id = :id");
        $cmd->bindValue(":d",$desc);
        $cmd->bindValue(":id",$id);
        $cmd->execute();
        if($cmd->rowCount()>0){
            return true;
        }else{
            $cmd = $this->pdo->prepare("SELECT * FROM usuarios WHERE descricao = :d AND id = :id");
        $cmd->bindValue(":d",$desc);
        $cmd->bindValue(":id",$id);
        $cmd->execute();
        if($cmd->rowCount()>0){
            return true;
        }else{
            return false;
        }   
        }
    }

    //mudar foto no banco de dados com base no id
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

    //enviar para o banco de dados os pontos do usuario
    public function mandarleaderbd($id,$data)
    {
        $cmd = $this->pdo->prepare("UPDATE usuarios
        SET pontos = :p
        WHERE id = :id");
        $cmd->bindValue(":p",$data);
        $cmd->bindValue(":id",$id);
        $cmd->execute();
        if($cmd->rowCount()>0){
            return true;
        }else{
            return false;
        }
    }

    //busca os pontos de um usuario em especifico
    public function buscarpontos($id)
    {
        $cmd = $this->pdo->prepare('SELECT pontos FROM usuarios WHERE id = :id');
        $cmd->bindValue(':id',$id);
        $cmd->execute();
        $dados = $cmd->fetch();
        return $dados;
    }

    //mostrar quantos pontos cada usuario tem
    public function leaderboard(){
        $cmd = $this->pdo->prepare("SELECT nome,pontos FROM usuarios ORDER BY pontos DESC");
        $cmd->execute();
        $dados = $cmd->fetchAll(PDO::FETCH_ASSOC);
        return $dados;
    }
}
?>