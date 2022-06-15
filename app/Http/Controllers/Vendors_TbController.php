<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Vendors_TbAddRequest;
use App\Http\Requests\Vendors_TbEditRequest;
use App\Models\Vendors_Tb;
use Illuminate\Http\Request;
use Exception;
class Vendors_TbController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$query = Vendors_Tb::query();
		if($request->search){
			$search = trim($request->search);
			Vendors_Tb::search($query, $search);
		}
		$orderby = $request->orderby ?? "vendors_tb.vendor_id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a single field name
		}
		$records = $this->paginate($query, Vendors_Tb::listFields());
		return $this->respond($records);
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Vendors_Tb::query();
		$record = $query->findOrFail($rec_id, Vendors_Tb::viewFields());
		return $this->respond($record);
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function add(Vendors_TbAddRequest $request){
		$modeldata = $request->validated();
		$modeldata['password'] = bcrypt($modeldata['password']);
		
		//save Vendors_Tb record
		$record = Vendors_Tb::create($modeldata);
		$rec_id = $record->vendor_id;
		return $this->respond($record);
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(Vendors_TbEditRequest $request, $rec_id = null){
		$query = Vendors_Tb::query();
		$record = $query->findOrFail($rec_id, Vendors_Tb::editFields());
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
		$query = Vendors_Tb::query();
		$query->whereIn("vendor_id", $arr_id);
		$query->delete();
		return $this->respond($arr_id);
	}
}
