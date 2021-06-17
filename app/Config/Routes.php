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
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
//$routes->set404Override();
$routes->set404Override('App\Controllers\Notfound');
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index', ['filter' => 'auth']);
$routes->get('/Personal', 'Personal::index', ['filter' => 'auth']);
$routes->get('/profile', 'Personal::index', ['filter' => 'auth']);
$routes->get('/Personal/MyPosts', 'Personal::MyPosts', ['filter' => 'auth']);
$routes->get('/profile/posts', 'Personal::MyPosts', ['filter' => 'auth']);
$routes->get('/profile/posts', 'Personal::UserPosts');
$routes->get('/Personal/(:num)', 'Personal::index/$1');
$routes->get('/profile/(:any)', 'Personal::index/$1');
$routes->get('/Discussion/(:num)', 'Discussion::index/$1/$2');
$routes->get('/Discussion/NewPost', 'Discussion::NewPost', ['filter' => 'auth']);
$routes->get('/FileSharing/(:num)', 'FileSharing::index/$1/$2');
$routes->get('/FileSharing/new', 'FileSharing::new', ['filter' => 'auth']);
$routes->get('logOut', 'UserFunction::logOut');
$routes->match(['get', 'post'],'register', 'UserFunction::register');
$routes->match(['get', 'post'],'login', 'UserFunction::login');
$routes->match(['get', 'post'],'changeQuote', 'UserFunction::changeQuote');
$routes->match(['get', 'post'],'changeInfor', 'UserFunction::changeInfor');
$routes->match(['get', 'post'],'changePassword', 'UserFunction::changePassword');
$routes->match(['get', 'post'],'changeAvatar', 'UserFunction::changeAvatar');
$routes->match(['get', 'post'],'Discussion/NewPost', 'UserFunction::NewPost'); 
$routes->match(['get', 'post'],'Discussion/UpdatePost', 'Discussion::UpdatePost');
$routes->match(['get', 'post'],'Discussion/new_comment', 'Discussion::new_comment'); 
$routes->match(['get', 'post'],'(:any)/(:any)/login', 'UserFunction::login'); 
$routes->match(['get', 'post'],'(:any)/login', 'UserFunction::login'); 
$routes->match(['get', 'post'],'(:any)/(:any)/home', 'Home::index');
/*
 * --------------------------------------------------------------------
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
