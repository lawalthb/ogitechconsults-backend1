<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Products_TbAddRequest;
use App\Http\Requests\Products_TbEditRequest;
use App\Models\Products_Tb;
use Illuminate\Http\Request;
use Exception;
class Products_TbController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$query = Products_Tb::query();
		if($request->search){
			$search = trim($request->search);
			Products_Tb::search($query, $search);
		}
		$query->join("vendors_tb", "products_tb.vendor_id", "=", "vendors_tb.vendor_id");
		$query->join("departments_tb", "products_tb.department_id", "=", "departments_tb.department_id");
		$orderby = $request->orderby ?? "products_tb.product_id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a single field name
		}
		$records = $this->paginate($query, Products_Tb::listFields());
		return $this->respond($records);
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Products_Tb::query();
		$query->join("vendors_tb", "products_tb.vendor_id", "=", "vendors_tb.vendor_id");
		$record = $query->findOrFail($rec_id, Products_Tb::viewFields());
		return $this->respond($record);
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function add(Products_TbAddRequest $request){
		$modeldata = $request->validated();
		
		if( array_key_exists("image", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['image'], "image");
			$modeldata['image'] = $fileInfo['filepath'];
		}
		
		//save Products_Tb record
		$record = Products_Tb::create($modeldata);
		$rec_id = $record->product_id;
		return $this->respond($record);
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(Products_TbEditRequest $request, $rec_id = null){
		$query = Products_Tb::query();
		$record = $query->findOrFail($rec_id, Products_Tb::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $request->validated();
		
		if( array_key_exists("image", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['image'], "image");
			$modeldata['image'] = $fileInfo['filepath'];
		}
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
		$query = Products_Tb::query();
		$query->whereIn("product_id", $arr_id);
		$query->delete();
		return $this->respond($arr_id);
	}
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function shop(Request $request, $fieldname = null , $fieldvalue = null){
		$query = Products_Tb::query();
		if($request->search){
			$search = trim($request->search);
			Products_Tb::search($query, $search);
		}
		$query->join("vendors_tb", "products_tb.vendor_id", "=", "vendors_tb.vendor_id");
		$orderby = $request->orderby ?? "products_tb.product_id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a single field name
		}
		$records = $this->paginate($query, Products_Tb::shopFields());
		return $this->respond($records);
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function nview($rec_id = null){
		$query = Products_Tb::query();
		$record = $query->findOrFail($rec_id, Products_Tb::nviewFields());
		return $this->respond($record);
	}
}
