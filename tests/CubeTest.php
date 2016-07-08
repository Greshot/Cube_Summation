<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CubeTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    /*Con esta prueba se hace la comprobación de que arroje el código 200, que indica que el formato del input estaba
    correcto y que se pudo hacer el proceso para resolver el ejercicio del cubo correctamente*/
    public function testInputSucces()
    {
        $response = $this->call('POST', '/cube',
            ['input' => "2\n4 5\nUPDATE 2 2 2 4\nQUERY 1 1 1 3 3 3\nUPDATE 1 1 1 23\nQUERY 2 2 2 4 4 4\nQUERY 1 1 1 3 3 3\n2 4\nUPDATE 2 2 2 1\nQUERY 1 1 1 1 1 1\nQUERY 1 1 1 2 2 2\nQUERY 2 2 2 2 2 2"]);
        $this->assertEquals(200, $response->status());
        $this->seeJson([
            'tittle' => 'Proceso éxitoso',
            'output' => "4\n4\n27\n0\n1\n1\n"
        ]);

    }

    /*En esta prueba se hace la comprobación de que se arroje el cóodigo 500 de error, el cual se da debido a un mal
    formato en el inputo lo cual provoca el error de undefined offset al tratar de recorrer el input que ha sido
    transformado previamente en un vector */
    public function testInputWrongFormat()
    {
        $response = $this->call('POST', '/cube',
            ['input' => "3\n4 5\nUPDATE 2 2 2 4\nQUERY 1 1 1 3 3 3\nUPDATE 1 1 1 23\nQUERY 2 2 2 4 4 4\nQUERY 1 1 1 3 3 3\n2 4\nUPDATE 2 2 2 1\nQUERY 1 1 1 1 1 1\nQUERY 1 1 1 2 2 2\nQUERY 2 2 2 2 2 2"]);
        $this->assertEquals(500, $response->status());
    }

    /*En esta prueba de hace la comprobación de que se arroje el error 422, el cual se da cuando el input ingresado no
    pasa las validaciones de valores exigidas por el ejercicio del cubo*/
    public function testInputWrongValues()
    {
        $response = $this->call('POST', '/cube',
            ['input' => "2\n4 5\nUPDATE A 2 2 4\nQUERY 1 1 1 3 3 3\nUPDATE 1 1 1 23\nQUERY 2 2 2 4 4 4\nQUERY 1 1 1 3 3 3\n2 4\nUPDATE 2 2 2 1\nQUERY 1 1 1 1 1 1\nQUERY 1 1 1 2 2 2\nQUERY 2 2 2 2 2 2"]);
        $this->assertEquals(422, $response->status());
        $this->seeJson(['tittle' => 'Errores en la entrada']);
    }


}
