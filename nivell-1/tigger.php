<?php

class Tigger {

    private static $instance;
    private static $rugits;

    private function __construct() {
            echo "Building character..." . PHP_EOL;
    }

    private function __clone(){}

    public function __sleep(){
        throw new Exception("No pots serialitzar Tigger!!!");
    }
    public function __wakeup(){
        throw new Exception("No pots deserialitzar Tigger!!!");
    }

    public function roar() {
            self::$rugits ++;
            echo "Grrr!" . PHP_EOL;
    }

    public static function getInstance() {

        // * No se como seria la mejor forma de comprobar la instancia, creo que el isset no seria realmente necesario aqui no?

        // if (!isset(self::$instance)){
        //     self::$instance = new static();
        // }

        if (!self::$instance){
            self::$instance = new static();
        }

        return self::$instance;
    }

    public function getCounter(){
        return self::$rugits;
    }

}

$tiggerReal = Tigger::getInstance();
$tiggerFake = Tigger::getInstance();

if ($tiggerReal === $tiggerFake){
    echo "There is only one Tigger!" . "\r\n";
}


$tiggerReal->roar();
$tiggerReal->roar();
$tiggerReal->roar();
$tiggerReal->roar();
$tiggerReal->roar();
echo $tiggerReal->getCounter();

?>