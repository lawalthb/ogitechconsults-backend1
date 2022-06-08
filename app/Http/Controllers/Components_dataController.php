<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
/**
 * Components Data Contoller
 * Use for getting values from the database for page components
 * Support raw query builder
 * @category Controller
 */
class Components_dataController extends Controller{
	public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['users_tb_email_exist','department_id_option_list_2']]);
    }
	/**
     * vendor_id_option_list Model Action
     * @return array
     */
	function vendor_id_option_list(Request $request){
		$sqltext = "SELECT vendor_id as value, vendor_id as label FROM vendors_tb";
		$query_params = [];
		$arr = DB::select(DB::raw($sqltext), $query_params);
		return $arr;
	}
	/**
     * department_id_option_list Model Action
     * @return array
     */
	function department_id_option_list(Request $request){
		$sqltext = "SELECT department_id as value, department_id as label FROM departments_tb";
		$query_params = [];
		$arr = DB::select(DB::raw($sqltext), $query_params);
		return $arr;
	}
	/**
     * product_id_option_list Model Action
     * @return array
     */
	function product_id_option_list(Request $request){
		$sqltext = "SELECT product_id as value, product_name as label FROM products_tb";
		$query_params = [];
		$arr = DB::select(DB::raw($sqltext), $query_params);
		return $arr;
	}
	/**
     * check if order_no value already exist in Order_Tb
	 * @param string $value
     * @return bool
     */
	function order_tb_order_no_exist(Request $request, $value){
		$exist = DB::table('order_tb')->where('order_no', $value)->value('order_no');   
		if($exist){
			return "true";
		}
		return "false";
	}
	/**
     * vendor_id_option_list_2 Model Action
     * @return array
     */
	function vendor_id_option_list_2(Request $request){
		$sqltext = "SELECT vendor_id as value, title as label FROM vendors_tb";
		$query_params = [];
		$arr = DB::select(DB::raw($sqltext), $query_params);
		return $arr;
	}
	/**
     * department_id_option_list_2 Model Action
     * @return array
     */
	function department_id_option_list_2(Request $request){
		$sqltext = "SELECT department_id as value, name as label FROM departments_tb";
		$query_params = [];
		$arr = DB::select(DB::raw($sqltext), $query_params);
		return $arr;
	}
	/**
     * check if email value already exist in Users_Tb
	 * @param string $value
     * @return bool
     */
	function users_tb_email_exist(Request $request, $value){
		$exist = DB::table('users_tb')->where('email', $value)->value('email');   
		if($exist){
			return "true";
		}
		return "false";
	}
	/**
     * check if firstname value already exist in Users_Tb
	 * @param string $value
     * @return bool
     */
	function users_tb_firstname_exist(Request $request, $value){
		$exist = DB::table('users_tb')->where('firstname', $value)->value('firstname');   
		if($exist){
			return "true";
		}
		return "false";
	}
	/**
     * order_no_option_list Model Action
     * @return array
     */
	function order_no_option_list(Request $request){
		$sqltext = "SELECT order_no as value, order_no as label FROM order_tb";
		$query_params = [];
		$arr = DB::select(DB::raw($sqltext), $query_params);
		return $arr;
	}
	/**
     * user_id_option_list Model Action
     * @return array
     */
	function user_id_option_list(Request $request){
		$sqltext = "SELECT user_id as value, firstname as label FROM users_tb";
		$query_params = [];
		$arr = DB::select(DB::raw($sqltext), $query_params);
		return $arr;
	}
	/**
     * checkout_by_option_list Model Action
     * @return array
     */
	function checkout_by_option_list(Request $request){
		$sqltext = "SELECT admin_id as value, firstname as label FROM admins_tb";
		$query_params = [];
		$arr = DB::select(DB::raw($sqltext), $query_params);
		return $arr;
	}
	/**
     * user_orders_view_name_option_list Model Action
     * @return array
     */
	function user_orders_view_name_option_list(Request $request){
		$sqltext = "SELECT  DISTINCT name AS value,name AS label FROM vendors_tb ORDER BY name ASC";
		$query_params = [];
		$arr = DB::select(DB::raw($sqltext), $query_params);
		return $arr;
	}
}
