<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //Items GetAll
        /*$this->app->when(\Core\Domain\Services\Items\GetAllService::class)
            ->needs(\Core\Domain\Contracts\BaseContract::class)
            ->give(\Core\Domain\Repositories\Eloquent\ItemRepository::class);*/


        //Items GetByCriteria
        $this->app->when(\Core\Domain\Services\Items\GetByCriteriaService::class)
            ->needs(\Core\Domain\Contracts\BaseContract::class)
            ->give(\Core\Domain\Repositories\Eloquent\ItemRepository::class);



        //Items Store
        $this->app->when(\Core\Domain\Services\Items\StoreService::class)
        ->needs(\Core\Domain\Contracts\BaseContract::class)
        ->give(\Core\Domain\Repositories\Eloquent\ItemRepository::class);



        //Items Update
        $this->app->when(\Core\Domain\Services\Items\UpdateService::class)
        ->needs(\Core\Domain\Contracts\BaseContract::class)
        ->give(\Core\Domain\Repositories\Eloquent\ItemRepository::class);



        //Items Destroy
        $this->app->when(\Core\Domain\Services\Items\DestroyService::class)
        ->needs(\Core\Domain\Contracts\BaseContract::class)
        ->give(\Core\Domain\Repositories\Eloquent\ItemRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
