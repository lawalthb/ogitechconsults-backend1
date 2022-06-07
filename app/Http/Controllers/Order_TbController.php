<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order_TbAddRequest;
use App\Http\Requests\Order_TbEditRequest;
use App\Http\Requests\Order_Tbshop_cartRequest;
use App\Models\Order_Tb;
use Illuminate\Http\Request;
use Exception;
class Order_TbController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$query = Order_Tb::query();
		if($request->search){
			$search = trim($request->search);
			Order_Tb::search($query, $search);
		}
		$orderby = $request->orderby ?? "order_tb.order_id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a single field name
		}
		$records = $this->paginate($query, Order_Tb::listFields());
		return $this->respond($records);
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Order_Tb::query();
		$record = $query->findOrFail($rec_id, Order_Tb::viewFields());
		return $this->respond($record);
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function add(Order_TbAddRequest $request){
		$modeldata = $request->validated();
		
		//save Order_Tb record
		$record = Order_Tb::create($modeldata);
		$rec_id = $record->order_id;
		return $this->respond($record);
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(Order_TbEditRequest $request, $rec_id = null){
		$query = Order_Tb::query();
		$record = $query->findOrFail($rec_id, Order_Tb::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $request->validated();
			$record->update($modeldata);
		}
		return $this->respond($record);
	}
	

	/**
     * Delete record from the database
	 * Support multi delete by separating record id by comma.
	 * @param  \Illuminate\Http\Request
	 * @param string $rec_id //can be separated by comma 
     * @return \Illuminate\Http\Response
     */
	function delete(Request $request, $rec_id = null){
		$arr_id = explode(",", $rec_id);
		$query = Order_Tb::query();
		$query->whereIn("order_id", $arr_id);
		$query->delete();
		return $this->respond($arr_id);
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function shop_cart(Order_Tbshop_cartRequest $request){
		$modeldata = $request->validated();
		
		//save Order_Tb record
		$record = Order_Tb::create($modeldata);
		$rec_id = $record->order_id;
		return $this->respond($record);
	}
}
