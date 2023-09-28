<?php

class Televizorius {
    private $gamintojas;
    private $kanalas;
    public $garsas;

    public function __construct($gamintojas) {
        $this->gamintojas = $gamintojas;
        $this->kanalas = 1; 
        $this->garsas = 50; 
    }

    public function didintiGarsa() {
        if ($this->garsas < 100) {
            $this->garsas++;
        }
    }

    public function sumazintiGarsa() {
        if ($this->garsas > 0) {
            $this->garsas--;
        }
    }

    public function changeChan($newKanalas) {
        if ($newKanalas >= 1 && $newKanalas <= 50) {
            $this->kanalas = $newKanalas;
        } else {
            
            $this->kanalas = 1;
        }
    }
    public function restoreGamParam() {
        $this->kanalas = 1;
        $this->garsas = 50;
    }
    public function info() {
        return "TV set '$this->gamintojas' showing now $this->kanalas channel, volume level $this->garsas.";
    }
}

$tv = new Televizorius('Samsung');
$tv->garsas=76;
$tv->changeChan(8);


echo $tv->info();


/*2 UZDUOTIS*/ 

class Vaisius {
    public $dydis;
    public $id;
    public $prakastas;

    public function __construct() {
        $this->dydis = rand(5, 25);
        $this->id = rand(1000000, 9999999);
        $this->prakastas = false;
    }

    public function prakasti() {
        $this->prakastas = true;
    }
}

class Krepšys {
    public static $vaisiai = [];

    public static function pripildyti() {
        while (count(self::$vaisiai) < 20) {
            $vaisius = new Vaisius();
            $vaisius->prakasti();
            self::$vaisiai[] = $vaisius;
        }

        usort(self::$vaisiai, function($a, $b) {
            return $b->dydis - $a->dydis;
        });
    }

    public static function isimti() {
        if (count(self::$vaisiai) > 0) {
            $vaisius = array_shift(self::$vaisiai);
            return $vaisius;
        }
        return null;
    }
}

class Grauztukai {
    public $vaisiai = [];

    public function pridetiVaisius($vaisius) {
        $this->vaisiai[$vaisius->id] = $vaisius;
    }
}

Krepšys::pripildyti();

$grauztukai = new Grauztukai();

while ($vaisius = Krepšys::isimti()) {
    $vaisius->prakasti();
    $grauztukai->pridetiVaisius($vaisius);
}

foreach ($grauztukai->vaisiai as $id => $vaisius) {
    echo "Vaisius ID: $id, Dydis: {$vaisius->dydis}, Prakastas: " . ($vaisius->prakastas ? 'Taip' : 'Ne') . "<br>";
}
?>