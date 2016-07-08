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

    //se actualiza la coordenada($x,$y,$z)  con el valor de $w
    public function update($x, $y, $z, $w)
    {
        $this->cube[$x][$y][$z] = $w;
    }

    /*se suma todos los valores entre las coordenadas ($x1,$y1,$z1) y  ($x2,$y2,$z2) y se retorna la suma para la salida
    del ejercicio*/
    public function query($x1, $y1, $z1, $x2, $y2, $z2)
    {
        $sum = 0;
        $count = count($this->cube);
        for ($x = 1; $x <= $count; $x++) {
            for ($y = 1; $y <= $count; $y++) {
                for ($z = 1; $z <= $count; $z++) {
                    if (($x >= $x1 && $x <= $x2) && ($y >= $y1 && $y <= $y2) && ($z >= $z1 && $z <= $z2)) {
                        $sum = $this->cube[$x][$y][$z] + $sum;
                    }
                }
            }
        }
        return $sum;
    }
}