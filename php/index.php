<?php

require "bootstrap.php";

use Manager\Model\Product;
use Pecee\SimpleRouter\SimpleRouter;
use Pecee\Http\Request;
use Pecee\Http\Response;

/**
 * @return \Pecee\Http\Response
 */
function response(): Response
{
    return SimpleRouter::response();
}

SimpleRouter::post('/product', '');

SimpleRouter::get('/not-found', function() {
    return 'Route not found';
});

SimpleRouter::get('/migration', function() {
    Product::all();
});

SimpleRouter::get('/forbidden', function() {
    return 'Forbidden!';
});


/* SWITCH FOR ERROR */
SimpleRouter::error(function(Request $request, \Exception $exception) {
    switch($exception->getCode()) {
        // Page not found
        case 404:
            response()->redirect('/not-found');
        // Forbidden
        case 403:
            response()->redirect('/forbidden');
    }
    
});

// Start the routing
SimpleRouter::start();