<?php

namespace App\Http\Controllers;

use App\Models\RegistroPeso;
use App\Observers\AlertaSMS;
use App\Observers\NotificadorPropietario;
use App\Observers\RecalculadorICC;
use App\Observers\RegistroPesoSubject;
use App\Observers\WebhookSenasa;
use Illuminate\Http\Request;

class RegistroPesoController extends Controller
{
    public function store(Request $request)
    {
        $registro = new RegistroPeso([
            'animal_id' => $request->animal_id,
            'peso' => $request->peso_kg,
            'fecha_registro' => $request->fecha,
        ]);

        $subject = new RegistroPesoSubject();

        $subject->suscribir(new NotificadorPropietario());
        $subject->suscribir(new RecalculadorICC());
        $subject->suscribir(new WebhookSenasa());
        $subject->suscribir(new AlertaSMS());

        $subject->registrarPeso($registro);

        return response()->json([
            'message' => 'Peso registrado y observadores notificados correctamente.',
        ]);
    }
}
