<?php

require "bootstrap.php";

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

SimpleRouter::get('/produto/{id}', function($id = 0) {
    return "id do trem: {$id}";
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