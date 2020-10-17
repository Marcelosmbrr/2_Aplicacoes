<?php


class Classe_pessoa {
    
    private $conn;
    
    function conexao($dsn, $username, $pass) {
        try {
            
           $this->conn = new PDO($dsn, $username, $pass);
           
        } catch (PDOException $e) {
            echo "Erro na conexão com o banco de dados: {$e}";
            exit();
        } catch (Exception $e){
            echo "Erro genérico: {$e}";
            exit();
        }  
    }
    
    public function cadastrarDados($nome, $cpf, $data_nascimento, $sexo, $email, $endereco, $cidade, $estado, $cep) {
        //prepare retorna o statment do comando SQL requisitado ao banco //statment = "declaração"
        $stmt = $this->conn->prepare("INSERT INTO `cadastros`(`nome`, `cpf`, `data_nasc`, `sexo`, `email`, `endereco`, `cidade`, `estado`, `cep`) VALUES (:nome, :cpf, :data_nasc, :sexo, :email, :endereco, :cidade, :estado, :cep)");
        
        //Atribuição de valor aos elementos do comando SQL
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":cpf", $cpf);
        $stmt->bindParam(":data_nasc", $data_nascimento);
        $stmt->bindParam(":sexo", $sexo);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":endereco", $endereco);
        $stmt->bindParam(":cidade", $cidade);
        $stmt->bindParam(":estado", $estado);
        $stmt->bindParam(":cep", $cep);
        
        //Executamos o statment, que retorna true se realizado com sucesso, ou false, no caso de falha
        if($stmt->execute()){
            return true;
            }
        else{
            return false;  
        }      
    }
    
    public function buscarDados($sql){
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        //Fetch retorna um array que será uma matriz, com linhas que possuem colunas //Registros e seus campos, do banco
        $array_registros = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //Matriz dos dados retornada
        return $array_registros;
    }
    
    public function excluirPessoa($codigo){
        $stmt = $this->conn->prepare("DELETE FROM `cadastros` WHERE `codigo` = :codigo");
        $stmt->bindParam(":codigo", $codigo);
        $stmt->execute();
    }

}
