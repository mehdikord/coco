<?php

namespace App\Providers;

use App\Interfaces\Auth\AuthInterface;
use App\Interfaces\Brands\BrandsInterface;
use App\Interfaces\Callback\CallbackInterface;
use App\Interfaces\Categories\CategoriesInterface;
use App\Interfaces\Faqs\FaqsInterface;
use App\Interfaces\Helper\HelperInterface;
use App\Interfaces\Products\ProductsInterface;
use App\Interfaces\Profile\ProfileInterface;
use App\Interfaces\Shopping\ShoppingInterface;
use App\Interfaces\Slider\SliderInterface;
use App\Interfaces\Users\UsersInterface;
use App\Repository\Auth\AuthRepository;
use App\Repository\Brands\BrandsRepository;
use App\Repository\Callback\CallbackRepository;
use App\Repository\Categories\CategoriesRepository;
use App\Repository\Faqs\FaqsRepository;
use App\Repository\Helper\HelperRepository;
use App\Repository\Products\ProductsRepository;
use App\Repository\Profile\ProfileRepository;
use App\Repository\Shopping\ShoppingRepository;
use App\Repository\Slider\SliderRepository;
use App\Repository\Users\UsersRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryInterfaceServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AuthInterface::class,AuthRepository::class);
        $this->app->bind(ProfileInterface::class,ProfileRepository::class);
        $this->app->bind(UsersInterface::class,UsersRepository::class);
        $this->app->bind(FaqsInterface::class,FaqsRepository::class);
        $this->app->bind(BrandsInterface::class,BrandsRepository::class);
        $this->app->bind(CategoriesInterface::class,CategoriesRepository::class);
        $this->app->bind(ProductsInterface::class,ProductsRepository::class);
        $this->app->bind(SliderInterface::class,SliderRepository::class);
        $this->app->bind(HelperInterface::class,HelperRepository::class);
        $this->app->bind(ShoppingInterface::class,ShoppingRepository::class);
        $this->app->bind(CallbackInterface::class,CallbackRepository::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

    }
}
