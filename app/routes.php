<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('front.homepage');
});

Route::get('/contact', function()
{
    return View::make('front.contact');
});

Route::get('filename/{s?}', function($s = null)
{
    if ($s !== null)
    {
        return snake_case(camel_case(strtolower( rawurldecode($s) )));
    }
});
