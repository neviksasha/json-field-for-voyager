<?php

namespace JsonVoyagerFormField;

use TCG\Voyager\Facades\Voyager;
use JsonFieldForVoyager\FormFields\JsonVoyagerFormField;
use Illuminate\Support\ServiceProvider;

class JsonVoyagerFormFieldServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/resources/views', 'json-field');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Voyager::addFormField(JsonVoyagerFormField::class);
    }
}