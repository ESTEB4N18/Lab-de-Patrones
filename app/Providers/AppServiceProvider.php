<?php

namespace App\Providers;

use App\Factories\IRazaFactory;
use App\Factories\RazaFactory;
use App\Repositories\EloquentAnimalRepository;
use App\Repositories\IAnimalRepository;
use App\Services\EstimadorPesoService;
use App\Strategies\AlgoritmoTablaReferencia;
use App\Strategies\AlgoritmoYolov8;
use App\Strategies\IAlgoritmoEstimacion;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(IRazaFactory::class, RazaFactory::class);

        $this->app->bind(IAnimalRepository::class, EloquentAnimalRepository::class);

        $this->app->bind(IAlgoritmoEstimacion::class, AlgoritmoYolov8::class);

        $this->app->bind(EstimadorPesoService::class, function ($app) {
            return new EstimadorPesoService(
                $app->make(IAlgoritmoEstimacion::class),
                new AlgoritmoTablaReferencia()
            );
        });
    }

    public function boot(): void
    {
        //
    }
}
