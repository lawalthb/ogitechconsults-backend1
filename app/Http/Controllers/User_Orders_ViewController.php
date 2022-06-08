<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\User_Orders_View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
class User_Orders_ViewController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$query = User_Orders_View::query();
		if($request->search){
			$search = trim($request->search);
			User_Orders_View::search($query, $search);
		}
		$orderby = $request->orderby ?? "user_orders_view.order_id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		$query->where("user_orders_view.user_id", auth()->user()->user_id);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a single field name
		}
		if(!empty($request->user_orders_view_name)){
			$val = $request->user_orders_view_name;
			$query->where(DB::raw("user_orders_view.name"), "=", $val);
		}
		if(!empty($request->user_orders_view_sales_status)){
			$val = $request->user_orders_view_sales_status;
			$query->where(DB::raw("user_orders_view.sales_status"), "=", $val);
		}
		$records = $this->paginate($query, User_Orders_View::listFields());
		return $this->respond($records);
	}
}
