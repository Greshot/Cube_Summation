<?php

namespace Cube_Summation\Http\Controllers;

use Illuminate\Http\Request;
use Cube_Summation\Cube;

use Cube_Summation\Http\Requests;

class CubeController extends Controller
{
    public function solve(Request $request)
    {
        $cube = new Cube(4);
        dd($cube->cube);
    }
}
