<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


use function App\Http\Controllers\downloadImage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/san-pham', [HomeController::class, 'products'])->name('product');


// cùng /them-san-pham => hiểu đc post, get nào liên quan đến nhau
Route::get('/them-san-pham', [HomeController::class, 'getAdd']);

Route::post('/them-san-pham', [HomeController::class, 'postAdd']);

Route::put('/them-san-pham', [HomeController::class, 'putAdd']);

Route::get('lay-thong-tin', [HomeController::class, 'getArr']);

Route::get('demo-response', function () {
    // $response = response();
    // dd($response);
    // $response = new Response('Hoc tap trinh tai unicode', 404);
    // $content = '<h2>Học lâp trình tại unicode</h2> ';
    // $response = (new Response($content))->header('Content-Type', 'text/plain');

    // $content = json_encode([
    //     'Item 1',
    //     'Item 2',
    //     'Item 3'
    // ]);
    // $response = (new Response($content))->header('Content-type', 'application/json');
    // return $response;

    $response = (new Response())->cookie('unicode', 'Training PHP - laravel', 30);
    return $response;
});

Route::get('demo-response', function () {
    $response = response()
        ->view('test2', [
            'title' => 'Hoc HTTP response'
        ], 201)
        ->header('Content-Type', 'application/json');
    // ->header('API-Key', '123455');
    return $response;
});

Route::get('demo-response2', function () {
    $contentArr = ['name' => 'Unicode', 'version'
    => 'Laravel 8.x', 'lesson' => 'HTTP Response Laravel'];
    return response()->json($contentArr)->header("Api-key", "1234");
});


Route::get('download-image', [HomeController::class, 'downloadImage'])->name('download-image');

Route::get('download-doc', [HomeController::class, 'downloadDoc'])->name('download-doc');

Route::prefix('user')->name('user.')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('index');

    Route::get('/add', [UserController::class, 'add'])->name('add');

    Route::post('/add', [UserController::class, 'postAdd'])->name('post-add');

    Route::get('/edit/{id}', [UserController::class, 'getEdit'])->name('edit');

    Route::post('/edit/{id}', [UserController::class, 'postEdit'])->name('edit');
});
