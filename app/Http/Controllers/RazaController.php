<?php

namespace App\Http\Controllers;

use App\Factories\IRazaFactory;
use Illuminate\Http\Request;

class RazaController extends Controller
{
    public function __construct(private readonly IRazaFactory $razaFactory)
    {
    }

    public function store(Request $request)
    {
        $raza = $this->razaFactory->create($request->nombre_raza);

        return response()->json([
            'nombre' => $raza->nombre,
            'descripcion' => $raza->descripcion,
        ]);
    }
}
