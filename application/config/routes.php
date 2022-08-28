<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//Routes for users
$route['users'] = 'users/show';
$route['users/show'] = 'users/show';
// $route['users/my-profile'] = 'users/myprofile'; //to update user profile
$route['users/my-profile-edit'] = 'users/edit'; //to update user profile
$route['users/edit-by-admin/(:any)'] = 'users/edit_specific';


//Routes for the messages
$route['messages'] = 'messages/index'; //shows all messages
$route['messages/mymessages'] = 'messages/mymessages'; //shows only the messages of loged in user
$route['messages/mymessages/(:any)'] = 'messages/mymessages'; //shows only the messages of loged in user
$route['messages/create'] = 'messages/create';

//Routes for the posts
$route['posts/index'] = 'posts/index';
$route['posts/create'] = 'posts/create';
$route['posts/update'] = 'posts/update';
$route['posts/(:any)'] = 'posts/view/$1';
$route['posts'] = 'posts/index';

$route['default_controller'] = 'users/login';

$route['categories'] = 'categories/index';
$route['categories/create'] = 'categories/create';
$route['categories/posts/(:any)'] = 'categories/posts/$1';

$route['(:any)'] = 'pages/view/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
