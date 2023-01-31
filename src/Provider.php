<?php

namespace Scngnr\Parasut;

use Illuminate\Support\ServiceProvider;

class Provider extends ServiceProvider
{
  public function register()
  {
    //
  }

  public function boot()
  {

    $this->loadMigrationsFrom(__DIR__ . '/Database/migrations');   //Database migration
    //$this->loadRoutesFrom(__DIR__.'/Routes/web.php');              //Route
    // $this->loadViewsFrom(__DIR__.'/views', 'priceService');     //Views klasörü
  }
}
