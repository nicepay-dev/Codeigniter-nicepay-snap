<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
$routes->get('/formToken', 'Home::createToken');

$routes->get('/', 'Home::index');
$routes->get('/token', 'CreateToken::create_function');
$routes->get('/tokenEwallet', 'CreateTokenEwallet::create_function');

//Virtual Account
$routes->get('/inquiry', 'inquiryVA::status_va');
$routes->get('/createva', 'CreateVA::generate_va');

//Ewallet
$routes->get('/createewallet', 'CreateEwallet::generate_ewallet');
$routes->get('/inquiryewallet', 'InquiryEwallet::status_ewallet');
$routes->get('/refundewallet', 'RefundEwallet::refund_ewallet');

$routes->get('/apaja', 'Home::index');