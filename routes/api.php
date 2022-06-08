<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// api routes that need auth

Route::middleware(['auth:api'])->group(function () {
	

/* routes for Products_Tb Controller  */	
	Route::get('products_tb', 'Products_TbController@index');
	Route::get('products_tb/index', 'Products_TbController@index');
	Route::get('products_tb/index/{filter?}/{filtervalue?}', 'Products_TbController@index');	
	Route::get('products_tb/view/{rec_id}', 'Products_TbController@view');	
	Route::post('products_tb/add', 'Products_TbController@add');	
	Route::any('products_tb/edit/{rec_id}', 'Products_TbController@edit');	
	Route::any('products_tb/delete/{rec_id}', 'Products_TbController@delete');	
	Route::get('products_tb/nview/{rec_id}', 'Products_TbController@nview');

/* routes for Payment_Tb Controller  */	
	Route::get('payment_tb', 'Payment_TbController@index');
	Route::get('payment_tb/index', 'Payment_TbController@index');
	Route::get('payment_tb/index/{filter?}/{filtervalue?}', 'Payment_TbController@index');	
	Route::get('payment_tb/view/{rec_id}', 'Payment_TbController@view');	
	Route::post('payment_tb/add', 'Payment_TbController@add');	
	Route::any('payment_tb/edit/{rec_id}', 'Payment_TbController@edit');	
	Route::any('payment_tb/delete/{rec_id}', 'Payment_TbController@delete');

/* routes for Order_Tb Controller  */	
	Route::get('order_tb', 'Order_TbController@index');
	Route::get('order_tb/index', 'Order_TbController@index');
	Route::get('order_tb/index/{filter?}/{filtervalue?}', 'Order_TbController@index');	
	Route::get('order_tb/view/{rec_id}', 'Order_TbController@view');	
	Route::post('order_tb/add', 'Order_TbController@add');	
	Route::any('order_tb/edit/{rec_id}', 'Order_TbController@edit');	
	Route::any('order_tb/delete/{rec_id}', 'Order_TbController@delete');	
	Route::post('order_tb/shop_cart', 'Order_TbController@shop_cart');	
	Route::get('order_tb/user_orders', 'Order_TbController@user_orders');
	Route::get('order_tb/user_orders/{filter?}/{filtervalue?}', 'Order_TbController@user_orders');

/* routes for Departments_Tb Controller  */	
	Route::get('departments_tb', 'Departments_TbController@index');
	Route::get('departments_tb/index', 'Departments_TbController@index');
	Route::get('departments_tb/index/{filter?}/{filtervalue?}', 'Departments_TbController@index');	
	Route::get('departments_tb/view/{rec_id}', 'Departments_TbController@view');	
	Route::post('departments_tb/add', 'Departments_TbController@add');	
	Route::any('departments_tb/edit/{rec_id}', 'Departments_TbController@edit');	
	Route::any('departments_tb/delete/{rec_id}', 'Departments_TbController@delete');

/* routes for Admins_Tb Controller  */	
	Route::get('admins_tb', 'Admins_TbController@index');
	Route::get('admins_tb/index', 'Admins_TbController@index');
	Route::get('admins_tb/index/{filter?}/{filtervalue?}', 'Admins_TbController@index');	
	Route::get('admins_tb/view/{rec_id}', 'Admins_TbController@view');	
	Route::post('admins_tb/add', 'Admins_TbController@add');	
	Route::any('admins_tb/edit/{rec_id}', 'Admins_TbController@edit');	
	Route::any('admins_tb/delete/{rec_id}', 'Admins_TbController@delete');

/* routes for Vendors_Tb Controller  */	
	Route::get('vendors_tb', 'Vendors_TbController@index');
	Route::get('vendors_tb/index', 'Vendors_TbController@index');
	Route::get('vendors_tb/index/{filter?}/{filtervalue?}', 'Vendors_TbController@index');	
	Route::get('vendors_tb/view/{rec_id}', 'Vendors_TbController@view');	
	Route::post('vendors_tb/add', 'Vendors_TbController@add');	
	Route::any('vendors_tb/edit/{rec_id}', 'Vendors_TbController@edit');	
	Route::any('vendors_tb/delete/{rec_id}', 'Vendors_TbController@delete');

/* routes for Users_Tb Controller  */	
	Route::get('users_tb', 'Users_TbController@index');
	Route::get('users_tb/index', 'Users_TbController@index');
	Route::get('users_tb/index/{filter?}/{filtervalue?}', 'Users_TbController@index');	
	Route::get('users_tb/view/{rec_id}', 'Users_TbController@view');	
	Route::any('account/edit', 'AccountController@edit');	
	Route::get('account', 'AccountController@index');	
	Route::post('account/changepassword', 'AccountController@changepassword');	
	Route::get('account/currentuserdata', 'AccountController@currentuserdata');	
	Route::post('users_tb/add', 'Users_TbController@add');	
	Route::any('users_tb/edit/{rec_id}', 'Users_TbController@edit');	
	Route::any('users_tb/delete/{rec_id}', 'Users_TbController@delete');

/* routes for Stock_Tb Controller  */	
	Route::get('stock_tb', 'Stock_TbController@index');
	Route::get('stock_tb/index', 'Stock_TbController@index');
	Route::get('stock_tb/index/{filter?}/{filtervalue?}', 'Stock_TbController@index');	
	Route::get('stock_tb/view/{rec_id}', 'Stock_TbController@view');	
	Route::post('stock_tb/add', 'Stock_TbController@add');	
	Route::any('stock_tb/edit/{rec_id}', 'Stock_TbController@edit');	
	Route::any('stock_tb/delete/{rec_id}', 'Stock_TbController@delete');

/* routes for Sales_Tb Controller  */	
	Route::get('sales_tb', 'Sales_TbController@index');
	Route::get('sales_tb/index', 'Sales_TbController@index');
	Route::get('sales_tb/index/{filter?}/{filtervalue?}', 'Sales_TbController@index');	
	Route::get('sales_tb/view/{rec_id}', 'Sales_TbController@view');	
	Route::post('sales_tb/add', 'Sales_TbController@add');	
	Route::any('sales_tb/edit/{rec_id}', 'Sales_TbController@edit');	
	Route::any('sales_tb/delete/{rec_id}', 'Sales_TbController@delete');

/* routes for User_Orders_View Controller  */	
	Route::get('user_orders_view', 'User_Orders_ViewController@index');
	Route::get('user_orders_view/index', 'User_Orders_ViewController@index');
	Route::get('user_orders_view/index/{filter?}/{filtervalue?}', 'User_Orders_ViewController@index');

/* routes for Level Controller  */	
	Route::get('level', 'LevelController@index');
	Route::get('level/index', 'LevelController@index');
	Route::get('level/index/{filter?}/{filtervalue?}', 'LevelController@index');	
	Route::get('level/view/{rec_id}', 'LevelController@view');	
	Route::post('level/add', 'LevelController@add');	
	Route::any('level/edit/{rec_id}', 'LevelController@edit');	
	Route::any('level/delete/{rec_id}', 'LevelController@delete');
});

	
	Route::get('products_tb/shop', 'Products_TbController@shop');
	Route::get('products_tb/shop/{filter?}/{filtervalue?}', 'Products_TbController@shop');	
	Route::post('auth/register', 'AuthController@register');	
	Route::post('auth/login', 'AuthController@login');	
	Route::post('auth/forgotpassword', 'AuthController@forgotpassword')->name('password.reset');	
	Route::post('auth/resetpassword', 'AuthController@resetpassword');
	
Route::get('components_data/vendor_id_option_list/{arg1?}', 'Components_dataController@vendor_id_option_list');	
Route::get('components_data/department_id_option_list/{arg1?}', 'Components_dataController@department_id_option_list');	
Route::get('components_data/product_id_option_list/{arg1?}', 'Components_dataController@product_id_option_list');	
Route::get('components_data/order_tb_order_no_exist/{arg1?}', 'Components_dataController@order_tb_order_no_exist');	
Route::get('components_data/vendor_id_option_list_2/{arg1?}', 'Components_dataController@vendor_id_option_list_2');	
Route::get('components_data/department_id_option_list_2/{arg1?}', 'Components_dataController@department_id_option_list_2');	
Route::get('components_data/users_tb_email_exist/{arg1?}', 'Components_dataController@users_tb_email_exist');	
Route::get('components_data/users_tb_firstname_exist/{arg1?}', 'Components_dataController@users_tb_firstname_exist');	
Route::get('components_data/order_no_option_list/{arg1?}', 'Components_dataController@order_no_option_list');	
Route::get('components_data/user_id_option_list/{arg1?}', 'Components_dataController@user_id_option_list');	
Route::get('components_data/checkout_by_option_list/{arg1?}', 'Components_dataController@checkout_by_option_list');	
Route::get('components_data/user_orders_view_name_option_list/{arg1?}', 'Components_dataController@user_orders_view_name_option_list');

Route::post('fileuploader/upload/{fieldname}', 'FileUploaderController@upload');
Route::post('fileuploader/s3upload/{fieldname}', 'FileUploaderController@s3upload');
Route::post('fileuploader/remove_temp_file', 'FileUploaderController@remove_temp_file');