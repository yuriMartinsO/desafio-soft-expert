<?php

require "bootstrap.php";

use Manager\Model\Product;
use Manager\Model\Type;
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

SimpleRouter::post('/api/product', 'Manager\Controller\ProductController@create');
SimpleRouter::get('/api/product', function() {
    http_response_code(200);
    return json_encode(Product::all());
});

SimpleRouter::post('/api/type', 'Manager\Controller\TypeController@create');
SimpleRouter::get('/api/type', function() {
    http_response_code(200);
    return json_encode(Type::all());
});

SimpleRouter::get('/not-found', function() {
    http_response_code(404);
    return 'Route not found';
});

SimpleRouter::get('/forbidden', function() {
    http_response_code(403);
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