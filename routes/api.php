<?php

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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/





Route::namespace('Core\Actions\Items')->prefix('v1')->group(
    function () {
        Route::get('items', 'GetItemsAction')->name('items.all');
        Route::get('items/bycriteria', 'GetItemsByCriteriaAction')->name('items.bycriteria');
        /*Route::get('categories/{category}', 'GetCategoryAction')->name('categories.show');
        Route::post('categories', 'StoreCategoryAction')->name('categories.store');
        Route::put('categories/{category}', 'UpdateCategoryAction')->name('categories.update');
        Route::delete('categories/{category}', 'DestroyCategoryAction')->name('categories.destroy');*/
    }
);