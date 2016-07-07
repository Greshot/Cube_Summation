<?php

namespace Cube_Summation\Http\Controllers;

use Illuminate\Http\Request;
use Cube_Summation\Cube;

use Cube_Summation\Http\Requests;
use PhpParser\Node\Stmt\Break_;

class CubeController extends Controller
{

    private $input;
    private $lineCounter = 0;
    private $cube;
    private $output;
    private $errors = [];
    private $update = "UPDATE";
    private $query = "QUERY";


    public function solve(Request $request)
    {
       // $cube = new Cube(4);
        $input = $request["input"];
        $this->input = explode(PHP_EOL, $input);
        /*se valida que la variable $this->input haya quedado con más de una posición, de no ser así, la constante
        PHP_EOL no funciono para dividir el string por cada salto de linea, entonces se hace uso nuevamente de la
        función explode pero pasandole como primer parametro "\n", para asegurar que se divida por cada salto de linea
        */
        if (count($this->input) <= 1) {
            $this->input = explode("\n", $input);
        }

        //Se llama al método de validación para comprobar que la entrada esté correcta y poder proceder con el restro del código
        $this->validateInput();

        //Se comprueba si se encontraron errores
        if (count($this->errors)>0) {
            dd($this->errors);
        } else {
            echo "No hubo ningún error en la entrada";
        }

    }

    //Validación del input
    public function validateInput()
    {
        $t = $this->input[$this->lineCounter];
        $this->lineCounter++;
        //En este if, se valida que la variable T esté dentro del rango admitido
        if (!is_numeric($t)) {
            $this->errors [] = "En la linea número " . $this->lineCounter .
                " la variable T tiene como valor " . $t . " y debe poseer un valor númerico ";
        } elseif (($t < 1) || ($t > 50)) {
            $this->errors [] = "En la linea número " . $this->lineCounter .
                " la variable T tiene como valor " . $t . " y el valor debe estar entre 1 y 50 ";
        } else {
            for ($i = 0; $i < $t; $i++) {
                $line = explode(" ", $this->input[$this->lineCounter]);
                $this->lineCounter++;
                $n = $line[0];
                $m = $line[1];
                //Se valida que N Y M estén sean números y estén dentro del rango admitido para continuar con el ciclo
                if (!is_numeric($n)) {
                    $this->errors [] = "En la linea número " . $this->lineCounter .
                        " la variable N tiene como valor " . $n . " y debe poseer un valor númerico ";
                    break;
                } elseif (!is_numeric($m)) {
                    $this->errors [] = "En la linea número " . $this->lineCounter .
                        " la variable M tiene como valor " . $m . " y debe poseer un valor númerico ";
                    break;
                } elseif (($n < 1) || ($n > 100)) {
                    $this->errors [] = "En la linea número " . $this->lineCounter .
                        " la variable N tiene como valor " . $n . " y el valor debe estar entre 1 y 100 ";
                    break;
                } elseif (($m < 1) || ($m > 1000)) {
                    $this->errors [] = "En la linea número " . $this->lineCounter .
                        " la variable M tiene como valor " . $m . " y el valor debe estar entre 1 y 1000 ";
                    break;
                } // Si N y M están dentro del rango admitido, se empieza a recorrer el número de operaciones (M) para validar que estén correctas.
                else {
                    for ($j = 0; $j < $m; $j++) {
                        $line = explode(" ", trim($this->input[$this->lineCounter]));
                        $this->lineCounter++;
                        $operation = strtoupper($line[0]);
                        //En ese If, se valida que si la operación es "UPDATE", entonces que posea el formato adecuado
                        if ($operation == $this->update) {
                            if (count($line) != 5) {
                                $this->errors [] = "En la linea número " . $this->lineCounter .
                                    " para la operacion : " . $operation . " se debe introducir con el siguiuente formato: UPDATE x y z W, y se ha introducido de la siguiente manera :" .
                                    $this->input[$this->lineCounter - 1];
                            } //una vez confirmado que la operación "UPDATE" posee el formato adecuado, se empieza a validar sus variables.
                            else {
                                $x = $line[1];
                                $y = $line[2];
                                $z = $line[3];
                                $w = $line[4];
                                //Se valida que x, y, z y w sean númericas y que estén dentro del rango admitido
                                if (!is_numeric($x)) {
                                    $this->errors [] = "En la linea número " . $this->lineCounter .
                                        " la variable x tiene como valor " . $x . " y debe poseer un valor númerico ";
                                    break 2;
                                } elseif (!is_numeric($y)) {
                                    $this->errors [] = "En la linea número " . $this->lineCounter .
                                        " la variable y tiene como valor " . $y . " y debe poseer un valor númerico ";
                                    break 2;
                                } elseif (!is_numeric($z)) {
                                    $this->errors [] = "En la linea número " . $this->lineCounter .
                                        " la variable z tiene como valor " . $z . " y debe poseer un valor númerico ";
                                    break 2;
                                } elseif (!is_numeric($w)) {
                                    $this->errors [] = "En la linea número " . $this->lineCounter .
                                        " la variable w tiene como valor " . $w . " y debe poseer un valor númerico ";
                                    break 2;
                                } elseif (($x < 1) || ($x > $n)) {
                                    $this->errors [] = "En la linea número " . $this->lineCounter .
                                        " la variable x tiene como valor " . $x . " y el valor debe estar entre 1 y el valor de la variable N (" . $n . ")";
                                } elseif (($y < 1) || ($y > $n)) {
                                    $this->errors [] = "En la linea número " . $this->lineCounter .
                                        " la variable y tiene como valor " . $y . " y el valor debe estar entre 1 y el valor de la variable N (" . $n . ")";
                                } elseif (($z < 1) || ($z > $n)) {
                                    $this->errors [] = "En la linea número " . $this->lineCounter .
                                        " la variable z tiene como valor " . $z . " y el valor debe estar entre 1 y el valor de la variable N (" . $n . ")";
                                } elseif (($w < pow(-10, 9)) || ($w > pow(10, 9))) {
                                    $this->errors [] = "En la linea número " . $this->lineCounter .
                                        " la variable w tiene como valor " . $w . " y el valor debe estar entre " .
                                        pow(-10, 9) . " y " . pow(10, 9);
                                }
                            }
                        }//Finalización de la validación del comando "UPDATE"
                        //Si la operación no es "UPDATE", entonces se valida que posea el formato adecuado para la operación "QUERY"
                        elseif ($operation == $this->query) {
                            if (count($line) != 7) {
                                $this->errors [] = "En la linea número " . $this->lineCounter .
                                    " para la operacion : " . $operation . " se debe introducir con el siguiuente formato: QUERY  x1 y1 z1 x2 y2 z2, y se ha introducido de la siguiente manera :" .
                                    $this->input[$this->lineCounter - 1];
                            } //Una vez confirmado que tenga el formato adecuado, se procede a validar las variabes de la operación
                            else {
                                $x1 = $line[1];
                                $y1 = $line[2];
                                $z1 = $line[3];
                                $x2 = $line[4];
                                $y2 = $line[5];
                                $z2 = $line[6];
                                //Se valida que x1, y1, z1, x2, y2 y z2  sean númericas y que estén dentro del rango admitido
                                if (!is_numeric($x1)) {
                                    $this->errors [] = "En la linea número " . $this->lineCounter .
                                        " la variable x1 tiene como valor " . $x1 . " y debe poseer un valor númerico ";
                                    break 2;
                                } elseif (!is_numeric($y1)) {
                                    $this->errors [] = "En la linea número " . $this->lineCounter .
                                        " la variable y1 tiene como valor " . $y1 . " y debe poseer un valor númerico ";
                                    break 2;
                                } elseif (!is_numeric($z1)) {
                                    $this->errors [] = "En la linea número " . $this->lineCounter .
                                        " la variable z1 tiene como valor " . $z1 . " y debe poseer un valor númerico ";
                                    break 2;
                                } elseif (!is_numeric($x2)) {
                                    $this->errors [] = "En la linea número " . $this->lineCounter .
                                        " la variable x2 tiene como valor " . $x2 . " y debe poseer un valor númerico ";
                                    break 2;
                                } elseif (!is_numeric($y2)) {
                                    $this->errors [] = "En la linea número " . $this->lineCounter .
                                        " la variable y2 tiene como valor " . $y2 . " y debe poseer un valor númerico ";
                                    break 2;
                                } elseif (!is_numeric($z2)) {
                                    $this->errors [] = "En la linea número " . $this->lineCounter .
                                        " la variable z2 tiene como valor " . $z2 . " y debe poseer un valor númerico ";
                                    break 2;
                                } elseif (($x2 < $x1) || ($x2 > $n)) {
                                    $this->errors [] = "En la linea número " . $this->lineCounter .
                                        " la variable x2 tiene como valor " . $x2 . " y el valor debe estar entre el valor de x1 (" .
                                        $x1 . ") y el valor de la variable N (" . $n . ")";
                                } elseif (($x1 < 1) || ($x1 > $x2)) {
                                    $this->errors [] = "En la linea número " . $this->lineCounter .
                                        " la variable x1 tiene como valor " . $x1 . " y el valor debe estar entre 1 y el valor de la variable x2 (" . $x2 . ")";
                                } elseif (($y2 < $y1) || ($y2 > $n)) {
                                    $this->errors [] = "En la linea número " . $this->lineCounter .
                                        " la variable y2 tiene como valor " . $y2 . " y el valor debe estar entre el valor de y1 (" .
                                        $y1 . ") y el valor de la variable N (" . $n . ")";
                                } elseif (($y1 < 1) || ($y1 > $y2)) {
                                    $this->errors [] = "En la linea número " . $this->lineCounter .
                                        " la variable y1 tiene como valor " . $y1 . " y el valor debe estar entre 1 y el valor de la variable y2 (" . $y2 . ")";
                                } elseif (($z2 < $z1) || ($z2 > $n)) {
                                    $this->errors [] = "En la linea número " . $this->lineCounter .
                                        " la variable z2 tiene como valor " . $z2 . " y el valor debe estar entre el valor de z1 (" .
                                        $z1 . ") y el valor de la variable N (" . $n . ")";
                                } elseif (($z1 < 1) || ($z1 > $z2)) {
                                    $this->errors [] = "En la linea número " . $this->lineCounter .
                                        " la variable z1 tiene como valor " . $z1 . " y el valor debe estar entre 1 y el valor de la variable z2 (" . $z2 . ")";
                                }
                            }
                        }//Finalización de la validación del comando "QUERY"
                    }//Finalización del ciclo for que recorre el número de operaciones (M)
                }//Finalización del cliclo if de la validación de las variables N y M
            }//Finalización del ciclo for que recorre el número de casos de prueba (T)
        }//Finalización del ciclo If de la validación de la variable T
    }


}
