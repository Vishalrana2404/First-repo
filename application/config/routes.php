<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "home";
$route['404_override'] = '';

$route['admin'] = "login/admin";
$route['resetPassword/(:any)'] = "login/resetPassword";

$route['faq'] = "home/faq";
$route['about'] = "home/about";
$route['contact'] = "home/contact";
$route['termsanditions'] = "home/termsandconditions";
$route['privacyPolicy'] = "home/privacyPolicy";
$route['refundPolicy'] = "home/refundPolicy";
$route['orderReturnPolicy'] = "home/orderReturnPolicy";
$route['category'] = "home/category";
$route['category/(:any)'] = "home/category";
$route['authors/(:any)'] = "home/authors";
$route['authors'] = "home/authors";
$route['publishers'] = "home/publishers";
$route['series'] = "home/series";
$route['bookList'] = "home/bookList";
$route['cartList'] = "home/cartList";
$route['wishList'] = "home/wishList";
$route['top_rated_book'] = "home/topRatedBook";
$route['book_detail/(:any)'] = "home/book_detail";
$route['category_book/(:any)'] = "home/bookListByCategory";
$route['shipping'] = "home/shipping";


$route['thanks'] = "home/thanks";
$route['login'] = "home/login";
$route['register'] = "home/register";
$route['profile'] = "home/profile";
$route['forgotPassword'] = "home/forgotPassword";
$route['resetPassword/(:any)'] = "home/resetPassword";
/* End of file routes.php */
/* Location: ./application/config/routes.php */