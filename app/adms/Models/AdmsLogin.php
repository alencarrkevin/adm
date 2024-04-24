<?php

namespace App\adms\Models;

use App\adms\Models\helper\AdmsConn;
use PDO;

class AdmsLogin extends AdmsConn
{
    private array|null $data;
    private object $conn;
    private $resultBd;
    private $result;

    function getResult(){
        return $this->result;
    }

    public function login(array $data = null)
    {
        $this->data = $data;
       // var_dump($this->data);  

        // Instanciar o metodo quando a classe he abstrata e a classe AdmsLogin é filha da classe AdmsConn
        $this->conn = $this->connectDb();
        
        $query_val_login = "SELECT id, name, nickname, email, password, image 
                        FROM adms_users
                        WHERE user =:user
                        LIMIT 1";
        $result_val_login = $this->conn->prepare($query_val_login);
        $result_val_login->bindParam(':user', $this->data['user'], PDO::PARAM_STR);
        $result_val_login->execute();

        $this->resultBd = $result_val_login->fetch();
        if($this->resultBd){
            //var_dump($this->resultBd);
            $this->valPassword();
        }else{
            //$_SESSION['msg'] = "<p style='color: #f00;'>Erro: Usuário não encontrado!</p>";
            $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Usuário ou a senha incorreta!</p>";
            $this->result = false;
            //echo $_SESSION['msg'];
        }
    }

    private function valPassword()
    {
        if(password_verify($this->data['password'], $this->resultBd['password'])){
            //$_SESSION['msg'] = "<p style='color: green;'>Login realizado com sucesso!</p>";
            $_SESSION['user_id'] = $this->resultBd['id'];
            $_SESSION['user_name'] = $this->resultBd['name'];
            $_SESSION['user_nickname'] = $this->resultBd['nickname'];
            $_SESSION['user_email'] = $this->resultBd['email'];
            $_SESSION['user_image'] = $this->resultBd['image'];
            $this->result = true;
            //echo $_SESSION['msg'];
        }else{
            //$_SESSION['msg'] = "<p style='color: #f00;'>Erro: Senha incorreta!</p>";
            $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Usuário ou a senha incorreta!</p>";
            $this->result = false;
            //echo $_SESSION['msg'];
        }
    }
} 