<?php

use Illuminate\Support\Facades\Auth;

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/email/verify', ['uses' => 'Auth\VerificationController@show', 'as' => 'verification.notice']);
$router->get('/email/verify/{id}', ['uses' => 'Auth\VerificationController@verify', 'as' => 'verification.verify']);
$router->get('/email/resend', ['uses' => 'Auth\VerificationController@resend', 'as' => 'verification.resend']);

$router->post('/register','AuthController@register');
$router->post('/login','AuthController@login');

$router->get('/key', function() {
    return \Illuminate\Support\Str::random(32);
});
