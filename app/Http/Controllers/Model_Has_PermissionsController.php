<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Model_Has_PermissionsAddRequest;
use App\Http\Requests\Model_Has_PermissionsEditRequest;
use App\Models\Model_Has_Permissions;
use Illuminate\Http\Request;
use Exception;
class Model_Has_PermissionsController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$query = Model_Has_Permissions::query();
		if($request->search){
			$search = trim($request->search);
			Model_Has_Permissions::search($query, $search);
		}
		$orderby = $request->orderby ?? "model_has_permissions.model_id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a single field name
		}
		$records = $this->paginate($query, Model_Has_Permissions::listFields());
		return $this->respond($records);
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Model_Has_Permissions::query();
		$record = $query->findOrFail($rec_id, Model_Has_Permissions::viewFields());
		return $this->respond($record);
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function add(Model_Has_PermissionsAddRequest $request){
		$modeldata = $request->validated();
		
		//save Model_Has_Permissions record
		$record = Model_Has_Permissions::create($modeldata);
		$rec_id = $record->model_id;
		return $this->respond($record);
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(Model_Has_PermissionsEditRequest $request, $rec_id = null){
		$query = Model_Has_Permissions::query();
		$record = $query->findOrFail($rec_id, Model_Has_Permissions::editFields());
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
		$query = Model_Has_Permissions::query();
		$query->whereIn("model_id", $arr_id);
		$query->delete();
		return $this->respond($arr_id);
	}
}
