<?php  

    //Esta classe serve para processar e retornar a instância de uma OUTRA classe
    //Neste caso, uma instância da classe sql_execute

    namespace Instances;
    use Classes\sql_execute;

    class instance_sql{

        //Serve para a condicional
        private static $instance;

        private function __construct(){}

        public static function getInstance(){

            //$this e self //https://pt.stackoverflow.com/questions/575/quando-usar-self-vs-this-em-php
            //Quando não existir uma instância
            if(!isset(self::$instance)){
                
                //É criada uma
                try{

                     self::$instance = new sql_execute();
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