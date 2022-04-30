<?php

class usuario{
    private $pdo;
    public function __construct($dbname,$host,$user,$pass) 
    {
        
        try 
        {
            $this->pdo = new PDO("mysql:dbname=$dbname;host=$host",$user,$pass);
        } catch (Exception $e) {
            echo"Erro por favor tente novamente. Erro:$e";
        }catch (PDOException $e) {
            echo"Erro por favor tente novamente. Erro:$e";
        }
    }
    public function cadastrar($n,$e,$s)
    {   
        $j = password_hash($s,PASSWORD_DEFAULT);
        $cmd = $this->pdo->prepare("SELECT id FROM varnahal.usuarios WHERE email = :e");
        $cmd->bindValue(":e",$e);
        $cmd->execute();
        if($cmd->rowCount()==0)
        {
        $cmd = $this->pdo->prepare("INSERT INTO varnahal.usuarios values(default,:n,:e,:s)");
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
        $cmd = $this->pdo->prepare("SELECT * FROM varnahal.usuarios WHERE email=:e");
        $cmd->bindValue(":e",$e);
        $cmd->execute();
        $j = $cmd->fetch();
        if($cmd->rowCount()>0){
            if(password_verify($s,$j['senha']))
            {
                $cmd = $this->pdo->prepare("SELECT * FROM varnahal.usuarios WHERE senha=:s AND email=:e");
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

}

?>