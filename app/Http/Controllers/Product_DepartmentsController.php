<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product_DepartmentsAddRequest;
use App\Http\Requests\Product_DepartmentsEditRequest;
use App\Models\Product_Departments;
use Illuminate\Http\Request;
use Exception;
class Product_DepartmentsController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$query = Product_Departments::query();
		if($request->search){
			$search = trim($request->search);
			Product_Departments::search($query, $search);
		}
		$orderby = $request->orderby ?? "product_departments.product_department_id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a single field name
		}
		$records = $this->paginate($query, Product_Departments::listFields());
		return $this->respond($records);
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Product_Departments::query();
		$record = $query->findOrFail($rec_id, Product_Departments::viewFields());
		return $this->respond($record);
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function add(Product_DepartmentsAddRequest $request){
		$modeldata = $request->validated();
		
		//save Product_Departments record
		$record = Product_Departments::create($modeldata);
		$rec_id = $record->product_department_id;
		return $this->respond($record);
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(Product_DepartmentsEditRequest $request, $rec_id = null){
		$query = Product_Departments::query();
		$record = $query->findOrFail($rec_id, Product_Departments::editFields());
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
		$query = Product_Departments::query();
		$query->whereIn("product_department_id", $arr_id);
		$query->delete();
		return $this->respond($arr_id);
	}
}
