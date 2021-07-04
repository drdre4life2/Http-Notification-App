<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CallController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\PublisherController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return "Pangeae Take home test";
});

// Publisher route
Route::post('/publish/{topic}', [PublisherController::class, 'publishToTopic']);

// Subscriber routes
Route::post('/subscribe/{topic}', [SubscriberController::class, 'subscribeToTopic']);
Route::get('/getsubscribers/{topic}', [SubscriberController::class, 'getAllSubscribers']);

//
Route::post('/{url}', [SubscriberController::class, 'receiveData']);
