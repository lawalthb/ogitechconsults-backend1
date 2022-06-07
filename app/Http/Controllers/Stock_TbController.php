<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Stock_TbAddRequest;
use App\Http\Requests\Stock_TbEditRequest;
use App\Models\Stock_Tb;
use Illuminate\Http\Request;
use Exception;
class Stock_TbController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$query = Stock_Tb::query();
		if($request->search){
			$search = trim($request->search);
			Stock_Tb::search($query, $search);
		}
		$orderby = $request->orderby ?? "stock_tb.stock_id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a single field name
		}
		$records = $this->paginate($query, Stock_Tb::listFields());
		return $this->respond($records);
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Stock_Tb::query();
		$record = $query->findOrFail($rec_id, Stock_Tb::viewFields());
		return $this->respond($record);
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function add(Stock_TbAddRequest $request){
		$modeldata = $request->validated();
		
		//save Stock_Tb record
		$record = Stock_Tb::create($modeldata);
		$rec_id = $record->stock_id;
		return $this->respond($record);
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(Stock_TbEditRequest $request, $rec_id = null){
		$query = Stock_Tb::query();
		$record = $query->findOrFail($rec_id, Stock_Tb::editFields());
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
		$query = Stock_Tb::query();
		$query->whereIn("stock_id", $arr_id);
		$query->delete();
		return $this->respond($arr_id);
	}
}
