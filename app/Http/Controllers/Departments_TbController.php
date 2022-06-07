<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Departments_TbAddRequest;
use App\Http\Requests\Departments_TbEditRequest;
use App\Models\Departments_Tb;
use Illuminate\Http\Request;
use Exception;
class Departments_TbController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$query = Departments_Tb::query();
		if($request->search){
			$search = trim($request->search);
			Departments_Tb::search($query, $search);
		}
		$orderby = $request->orderby ?? "departments_tb.department_id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a single field name
		}
		$records = $this->paginate($query, Departments_Tb::listFields());
		return $this->respond($records);
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Departments_Tb::query();
		$record = $query->findOrFail($rec_id, Departments_Tb::viewFields());
		return $this->respond($record);
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function add(Departments_TbAddRequest $request){
		$modeldata = $request->validated();
		
		//save Departments_Tb record
		$record = Departments_Tb::create($modeldata);
		$rec_id = $record->department_id;
		return $this->respond($record);
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(Departments_TbEditRequest $request, $rec_id = null){
		$query = Departments_Tb::query();
		$record = $query->findOrFail($rec_id, Departments_Tb::editFields());
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
		$query = Departments_Tb::query();
		$query->whereIn("department_id", $arr_id);
		$query->delete();
		return $this->respond($arr_id);
	}
}
