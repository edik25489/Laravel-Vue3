<?php

use App\Http\Controllers\BasketController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::controller(UserController::class)->group(function (){
    Route::post('/login','login')->name('login');
    Route::post('/register','register')->name('register');
});
Route::post('/userInfo',[UserController::class,'userInfo'])
    ->name('user.info');

Route::controller(ManagerController::class)->group(function (){
    Route::post('/manager/login','login')->name('login');
    Route::post('/manager/register','register')->name('register');
});
Route::post('/managerInfo',[ManagerController::class,'managerInfo'])
    ->name('manager.info');


//Route::group(['prefix'=>'manager'],function (){
//    Route::group(['middleware'=>'manager.guest'],function (){
//        Route::post('/manager/register','register')->name('manager.login');
//        Route::post('/manager/login','login')->name('manager.register');
//    });
//    Route::group(['middleware'=>'manager.auth'],function (){
//        Route::get('/category', [CategoryController::class,'index'])
//            ->name('category.index'); // просмотр всех категорий
//    });
//});

Route::get('/category', [CategoryController::class,'index'])
            ->name('category.index'); // просмотр всех категорий

Route::get('/category/{category}',[CategoryController::class,'show'])
    ->name('category.show'); // просмотр одной категории

Route::get('/product',[ProductController::class,'index'])
    ->name('product.index'); // просмотр всех продуктов
Route::get('/product/{product}',[ProductController::class,'show'])
    ->name('product.show'); // просмотр одного продукта
Route::post('/category',[CategoryController::class,'store'])
        ->name('category.store'); // создание категории

Route::patch('/category/{category}',[CategoryController::class,'update'])
        ->name('category.update'); // изменение категории
Route::post('/product',[ProductController::class,'store'])
        ->name('product.store'); // создание продукта
Route::patch('/product/{product}',[ProductController::class,'update'])
        ->name('product.update'); // редактирование продукта

Route::post('/basket/{product}',[BasketController::class,'store'])
        ->name('basket.store'); // Добавление продукта в корзину
Route::post('/basket',[BasketController::class,'index'])
        ->name('basket.index'); // Посмотреть корзину
Route::post('/delBasket/{basket}',[BasketController::class,'delete'])
        ->name('basket.delete'); // удаление с корзины
Route::post('/buy/{basket}',[BasketController::class,'buy'])
        ->name('basket.buy'); // оформление покупки


Route::post('/history',[HistoryController::class,'index'])
    ->name('history.index'); // просмотр корзины

Route::post('/favorite',[FavoriteController::class,'index'])
    ->name('favorite.index'); // просмотр избранного
Route::post('/addFavorite/{product}',[FavoriteController::class,'store'])
    ->name('favorite.store'); // добавить в избранное
Route::post('/delFavorite/{favorite}',[FavoriteController::class,'delete'])
    ->name('favorite.delete'); // удалить из избранного
