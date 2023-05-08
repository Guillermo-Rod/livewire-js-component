<?php

use GuillermoRod\LivewireJsComponents\Components\Flatpickr;

return [

    /*
    |--------------------------------------------------------------------------
    | Components Prefix
    |--------------------------------------------------------------------------
    |
    | This value will set a prefix for all Livewire JS Components.
    | By default it's empty. This is useful if you want to avoid
    | collision with components from other libraries.
    |
    | If set with "star", for example, you can reference components like:
    |
    | <x-star-linear-input />
    |
    | by default = "jscomp"
    */

    'prefix' => \GuillermoRod\LivewireJsComponents\ServiceProvider::NULL_PREFIX,


    /*
    |--------------------------------------------------------------------------
    | Components
    |--------------------------------------------------------------------------
    |
    | Below you reference all components that should be loaded for your app.
    | By default all components from Blade UI Kit are loaded internally
    |
    */

    'components' => [
        'flatpickr' => Flatpickr::class
    ]
]