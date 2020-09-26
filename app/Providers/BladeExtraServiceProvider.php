<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\fACADES\Auth;
use App\User;

use Session;

class BladeExtraServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::if( 'hasrole', function($expression)
        {
            $who = Session::get('role');
            
            if ($who == $expression)
            return true;
            else 
            return false;
        });

        Blade::if( 'nowlogged', function($expression)
        {
            $who = Session::get('id');
            
            if ($who == $expression)
            return true;
            else 
            return false;
        });


    }
}
