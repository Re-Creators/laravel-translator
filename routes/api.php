<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Stichoza\GoogleTranslate\GoogleTranslate;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::post('/detect', function (Request $request) {
    $text = $request->input('text');
    $tr = new GoogleTranslate();

    $tr->translate($text);
    return response()->json([
        'language' => $tr->getLastDetectedSource(),
    ], 200);
});

Route::post('/translate', function (Request $request) {
    $tr = new GoogleTranslate();

    $text = $request->input('text');
    $from = $request->input('from');
    $to = $request->input('to');

    return response()->json([
        'translated' =>  $tr->setSource($from)->setTarget($to)->translate($text),
    ], 200);
});
