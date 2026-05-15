<?php

namespace App\Providers;

use App\Factories\IRazaFactory;
use App\Factories\RazaFactory;
use App\Repositories\EloquentAnimalRepository;
use App\Repositories\IAnimalRepository;
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

        $this->app->bind(
    \App\Strategies\IAlgoritmoEstimacion::class,
    \App\Strategies\AlgoritmoYolov8::class
);
    }

    public function boot(): void
    {
        //
    }
}
