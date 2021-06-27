<?php  

    //Esta classe serve para processar e retornar a instância de uma OUTRA classe
    //Neste caso, uma instância da classe PDO
    
    namespace Instances;
    use PDO;

    class instance_connection{

        //Serve para a condicional
        private static $instance;

        private function __construct(){}

        public static function getInstance(){

            //$this e self //https://pt.stackoverflow.com/questions/575/quando-usar-self-vs-this-em-php
            //Quando não existir uma instância
            if(!isset(self::$instance)){
                
                //É criada uma
                try{

                     self::$instance = new PDO("mysql:host=localhost;dbname=login_cadastro", "root", "");
                     return self::$instance;
                    
                }
                catch(PDOException $e){
                    echo "Erro com o banco de dados:" .$e->getMessage();
                    echo "Código de erro: " .$e->getCode();
                }
                catch(PDOException $e){
                    echo "Erro genérico:" .$e->getMessage();
                    echo "Código de erro: " .$e->getCode();
                } 

            }else{ 
                 //Se existir, a mesma é retornada
                return self::$instance;
            }
        }
        
    }

?>