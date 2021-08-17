<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('user');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('user', 'user::index',['filter'=>'noadmin']);
$routes->match(['get','post'], 'user/signUp', 'User::signUp', ['filter'=>'noauth']);
$routes->match(['get','post'], 'user/login', 'User::login', ['filter'=>'noauth']);
$routes->match(['get','post'], 'series', 'Series::index', ['filter'=>'grant']);
$routes->match(['get','post'], 'series/uploadByMe', 'Series::uploadByMe', ['filter'=>'grant']);
$routes->match(['get','post'], 'series/uploadTutorial', 'Series::uploadTutorial', ['filter'=>'grant']);
$routes->match(['get','post'],'series/freeSeries', 'Series::freeSeries',['filter'=>'noadmin']);
$routes->match(['get','post'],'series/paidSeries', 'Series::paidSeries',['filter'=>'noadmin']);
$routes->group('Admin', function($routes)
{
    $routes->match(['get','post'],'AdminClass', 'Admin\AdminClass::index',['filter'=>'admin']);
    $routes->match(['get','post'],'AdminClass/acceptedUser', 'Admin\AdminClass::acceptedUser',['filter'=>'admin']);
    $routes->match(['get','post'],'AdminClass/userRequest', 'Admin\AdminClass::pendingUserRequest',['filter'=>'admin']);
    $routes->match(['get','post'],'AdminClass/rejectedUserRequest', 'Admin\AdminClass::rejectedUserRequest',['filter'=>'admin']);
    $routes->match(['get','post'],'AdminClass/acceptedSeries', 'Admin\AdminClass::acceptedSeries',['filter'=>'admin']);
    $routes->match(['get','post'],'AdminClass/pendingSeriesRequest', 'Admin\AdminClass::pendingSeriesRequest',['filter'=>'admin']);
    $routes->match(['get','post'],'AdminClass/rejectedSeriesRequest', 'Admin\AdminClass::rejectedSeriesRequest',['filter'=>'admin']);
    $routes->match(['get','post'],'AdminClass/generatedVoucherRequest', 'Admin\AdminClass::generatedVoucherRequest',['filter'=>'admin']);
    $routes->match(['get','post'],'AdminClass/submitedVoucherRequest', 'Admin\AdminClass::submitedVoucherRequest',['filter'=>'admin']);
});



/*
 * -------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
