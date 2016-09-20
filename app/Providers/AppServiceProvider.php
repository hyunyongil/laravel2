<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\User;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      /*  \App\User::creating(function($user)
        {
           if (!empty($user->account))
           {
               $user->account = \Crypt::encrypt($user->account);
               $user->password = \Crypt::encrypt($user->password);
           }
        });*/
    }


    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
