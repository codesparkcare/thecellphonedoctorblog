<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'blog';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Admin Routes
$route['admin'] = 'admin/dashboard';
$route['admin/login'] = 'admin/login';
$route['admin/logout'] = 'admin/logout';
$route['admin/dashboard'] = 'admin/dashboard';
$route['admin/posts'] = 'admin/posts';
$route['admin/create_post'] = 'admin/create_post';
$route['admin/edit_post/(:num)'] = 'admin/edit_post/$1';
$route['admin/delete_post/(:num)'] = 'admin/delete_post/$1';
$route['admin/categories'] = 'admin/categories';
$route['admin/edit_category/(:num)'] = 'admin/edit_category/$1';
$route['admin/delete_category/(:num)'] = 'admin/delete_category/$1';

// API Endpoint for Flutter Web
$route['api/blogs/latest'] = 'api/latest_blogs';
$route['api/blogs'] = 'api/latest_blogs';

// Public Blog Routes
$route['blog'] = 'blog/index';
$route['blog/page/(:num)'] = 'blog/index/$1';
$route['blog/category/(:any)/(:num)'] = 'blog/category/$1/$2';
$route['blog/category/(:any)'] = 'blog/category/$1';
$route['blog/post/(:any)'] = 'blog/post/$1';
$route['blog/(:any)'] = 'blog/post/$1';
