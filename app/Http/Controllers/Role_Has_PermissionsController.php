<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Role_Has_PermissionsAddRequest;
use App\Http\Requests\Role_Has_PermissionsEditRequest;
use App\Models\Role_Has_Permissions;
use Illuminate\Http\Request;
use Exception;
class Role_Has_PermissionsController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$query = Role_Has_Permissions::query();
		if($request->search){
			$search = trim($request->search);
			Role_Has_Permissions::search($query, $search);
		}
		$orderby = $request->orderby ?? "role_has_permissions.role_id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a single field name
		}
		$records = $this->paginate($query, Role_Has_Permissions::listFields());
		return $this->respond($records);
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Role_Has_Permissions::query();
		$record = $query->findOrFail($rec_id, Role_Has_Permissions::viewFields());
		return $this->respond($record);
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function add(Role_Has_PermissionsAddRequest $request){
		$modeldata = $request->validated();
		
		//save Role_Has_Permissions record
		$record = Role_Has_Permissions::create($modeldata);
		$rec_id = $record->role_id;
		return $this->respond($record);
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(Role_Has_PermissionsEditRequest $request, $rec_id = null){
		$query = Role_Has_Permissions::query();
		$record = $query->findOrFail($rec_id, Role_Has_Permissions::editFields());
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
		$query = Role_Has_Permissions::query();
		$query->whereIn("role_id", $arr_id);
		$query->delete();
		return $this->respond($arr_id);
	}
}
