<?php

namespace Cube_Summation;


class Cube
{
    //Matrix de 3 dimensiones
    public $cube;
    
    /*
     * En el método cosntructor cada vez que se instancie un cubo, se recibirá como parametro $n, el cual servirá
     * para saber cual será la última coordenada de la matrix, y luego con 3 ciclos for se inicializa todas las
     * coordenadas de la matrix en 0
     *
     */
    public function __construct($n)
    {
        for ($x = 1; $x <= $n; $x++) {
            for ($y = 1; $y <= $n; $y++) {
                for ($z = 1; $z <= $n; $z++) {
                    $this->cube[$x][$y][$z] = 0;
                }
            }
        }
    }
}