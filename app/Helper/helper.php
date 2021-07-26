<?php

use App\Models\Social;
use App\Models\Route;

function getSocial(){
    return  $social = Social::get();
}

function getRoutCount(){

   return Route::get()->count();
}

function getRout(){
    return Route::first();
}


function getRouts(){
    return Route::get();
}
