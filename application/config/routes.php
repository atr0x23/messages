<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//Routes for users
$route['users'] = 'users/show';
$route['users/show'] = 'users/show';
$route['users/my-profile-edit'] = 'users/edit'; //to update user profile
$route['users/edit-by-admin/(:any)'] = 'users/edit_specific'; //to update user's profile as admin
$route['users/password-reset'] = 'users/password_reset';
$route['users/enter_new_pass'] = 'users/password';
$route['reset/password(:any)'] = 'reset/password';

//Routes for the messages
$route['messages'] = 'messages/index'; //shows all messages
$route['messages/mymessages'] = 'messages/mymessages'; //shows only the messages of loged in user
$route['messages/mymessages/(:any)'] = 'messages/mymessages'; //shows only the messages of loged in user
$route['messages/mymessages-adminview'] = 'messages/mymessagesadmin'; //shows only the messages of selected user by the admin
$route['messages/mymessages-adminview/(:any)'] = 'messages/mymessagesadmin'; //shows only the messages of selected user by the admin
$route['messages/create'] = 'messages/create';

$route['default_controller'] = 'users/login';

$route['(:any)'] = 'pages/view/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
