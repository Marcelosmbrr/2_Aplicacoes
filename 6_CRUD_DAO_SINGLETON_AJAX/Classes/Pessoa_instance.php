<?php

    //Esta classe serve para processar e retornar a instância de uma OUTRA classe
    //Neste caso, uma instância da classe Sql_DAO

    namespace Classes;
    use Classes\Pessoa_DAO;

    class Pessoa_instance{

        //Serve para a condicional
        private static $instance;

        private function __construct(){}

        public static function getInstance(){

            if(!isset(self::$instance)){
                
                //É criada uma
                try{

                    self::$instance = new Pessoa_DAO();
                    return self::$instance;
                    
                }
                catch(Exception $e){
                    echo "Erro: " .$e->getMesssage();
                } 

            }else{ 
                 //Se existir, a mesma é retornada
                return self::$instance;
            }
        }
    }

?>