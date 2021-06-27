<?php

    //Esta classe serve para processar e retornar a instância de uma OUTRA classe
    //Neste caso, uma instância da classe mainController

    namespace Instances;
    use Classes\Person;
    use Instances\instance_connection;

    class instance_person{

        //Serve para a condicional
        private static $instance;

        private function __construct(){}

        public static function getInstance(){

            if(!isset(self::$instance)){
                
                //É criada uma
                try{

                    //A classe pessoa é instanciada
                    //Recebe como argumento o objeto PDO também recuperado utilizando o padrão SINGLETON
                    self::$instance = new Person(instance_connection::getInstance()); 
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