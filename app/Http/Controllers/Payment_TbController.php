<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Payment_TbAddRequest;
use App\Http\Requests\Payment_TbEditRequest;
use App\Models\Payment_Tb;
use Illuminate\Http\Request;
use Exception;
class Payment_TbController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$query = Payment_Tb::query();
		if($request->search){
			$search = trim($request->search);
			Payment_Tb::search($query, $search);
		}
		$orderby = $request->orderby ?? "payment_tb.payment_id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a single field name
		}
		$records = $this->paginate($query, Payment_Tb::listFields());
		return $this->respond($records);
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Payment_Tb::query();
		$record = $query->findOrFail($rec_id, Payment_Tb::viewFields());
		return $this->respond($record);
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function add(Payment_TbAddRequest $request){
		$modeldata = $request->validated();
		
		//save Payment_Tb record
		$record = Payment_Tb::create($modeldata);
		$rec_id = $record->payment_id;
		return $this->respond($record);
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(Payment_TbEditRequest $request, $rec_id = null){
		$query = Payment_Tb::query();
		$record = $query->findOrFail($rec_id, Payment_Tb::editFields());
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
		$query = Payment_Tb::query();
		$query->whereIn("payment_id", $arr_id);
		$query->delete();
		return $this->respond($arr_id);
	}
}
