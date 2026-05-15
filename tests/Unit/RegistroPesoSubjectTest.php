<?php

namespace Tests\Unit;

use App\Models\RegistroPeso;
use App\Observers\IRegistroPesoObserver;
use App\Observers\RegistroPesoSubject;
use PHPUnit\Framework\TestCase;
use ReflectionMethod;

class RegistroPesoSubjectTest extends TestCase
{
    public function test_notificar_avisa_a_todos_los_observadores_suscritos(): void
    {
        $subject = new RegistroPesoSubject();
        $registro = new RegistroPeso([
            'animal_id' => 1,
            'peso' => 420.5,
        ]);

        $primerObservador = $this->crearSpyObserver();
        $segundoObservador = $this->crearSpyObserver();
        $tercerObservador = $this->crearSpyObserver();

        $subject->suscribir($primerObservador);
        $subject->suscribir($segundoObservador);
        $subject->suscribir($tercerObservador);

        $notificar = new ReflectionMethod($subject, 'notificar');
        $notificar->invoke($subject, $registro);

        $this->assertSame(1, $primerObservador->llamadas);
        $this->assertSame(1, $segundoObservador->llamadas);
        $this->assertSame(1, $tercerObservador->llamadas);
    }

    private function crearSpyObserver(): IRegistroPesoObserver
    {
        return new class implements IRegistroPesoObserver {
            public int $llamadas = 0;

            public function onPesoRegistrado(RegistroPeso $registro): void
            {
                $this->llamadas++;
            }
        };
    }
}
