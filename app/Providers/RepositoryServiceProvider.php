<?php

namespace App\Providers;

use App\Repositories\{
    BoxRepository,
    BaseRepository,
    RecipeRepository,
    IngredientRepository,
};

use App\Repositories\Interfaces\{
    BoxInterface,
    BaseInterface,
    RecipeInterface,
    IngredientInterface,
};

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IngredientInterface::class, IngredientRepository::class);
        $this->app->bind(RecipeInterface::class, RecipeRepository::class);
        $this->app->bind(BaseInterface::class, BaseRepository::class);
        $this->app->bind(BoxInterface::class, BoxRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
