<?php

class Duck {

    public function quack() {
        echo "Quack \n";
    }

    public function fly() {
        echo "I'm flying \n";
    }
}

class Turkey {

    public function gobble() {
        echo "Gobble gobble \n";
    }

    public function fly() {
        echo "I'm flying a short distance \n";
    }
}

class TurkeyAdapter extends Duck {

    private $turkey;

    public function __construct(Turkey $turkey){
        $this->turkey = $turkey;
    }

    public function quack(){
        return $this->turkey->gobble();
    }

    public function fly(){

        // * 3 maneras de devolver multiples metodos del fly, pero sinceramente no me gusta ninguno, el último parece un poco mas limpio y agradable de ver. Habría otro forma mejor de hacerlo?

        // return $this->turkey->fly() . $this->turkey->fly() . $this->turkey->fly() . $this->turkey->fly() . $this->turkey->fly();

        // $arr = [];
        // for ($i=0; $i < 5; $i++) { 
        //     array_push($arr, $this->turkey->fly());
        // }
        // return $arr;

        return array($this->turkey->fly(), 
                     $this->turkey->fly(), 
                     $this->turkey->fly(), 
                     $this->turkey->fly(),
                     $this->turkey->fly());
    }

}

function duck_interaction($duck) {
    $duck->quack();
    $duck->fly();
}

$duck = new Duck;
$turkey = new Turkey;
$turkey_adapter = new TurkeyAdapter($turkey);
echo "The Turkey says...\n";
$turkey->gobble();
$turkey->fly();
echo "The Duck says...\n";
duck_interaction($duck);
echo "The TurkeyAdapter says...\n";
duck_interaction($turkey_adapter);

?>