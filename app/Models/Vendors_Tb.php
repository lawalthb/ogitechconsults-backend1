<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Vendors_Tb extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'vendors_tb';
	

	/**
     * The table primary key field
     *
     * @var string
     */
	protected $primaryKey = 'vendor_id';
	

	/**
     * Table fillable fields
     *
     * @var array
     */
	protected $fillable = ["title","name","email","department_id","status"];
	

	/**
     * Set search query for the model
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @param string $text
     */
	public static function search($query, $text){
		//search table record 
		$search_condition = '(
				title LIKE ?  OR 
				name LIKE ?  OR 
				email LIKE ? 
		)';
		$search_params = [
			"%$text%","%$text%","%$text%"
		];
		//setting search conditions
		$query->whereRaw($search_condition, $search_params);
	}
	

	/**
     * return list page fields of the model.
     * 
     * @return array
     */
	public static function listFields(){
		return [ 
			"vendor_id", 
			"title", 
			"name", 
			"email", 
			"department_id", 
			"status", 
			"reg_date" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"vendor_id", 
			"title", 
			"name", 
			"email", 
			"department_id", 
			"status", 
			"reg_date" 
		];
	}
	

	/**
     * return view page fields of the model.
     * 
     * @return array
     */
	public static function viewFields(){
		return [ 
			"vendor_id", 
			"title", 
			"name", 
			"email", 
			"department_id", 
			"status", 
			"reg_date" 
		];
	}
	

	/**
     * return exportView page fields of the model.
     * 
     * @return array
     */
	public static function exportViewFields(){
		return [ 
			"vendor_id", 
			"title", 
			"name", 
			"email", 
			"department_id", 
			"status", 
			"reg_date" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"vendor_id", 
			"title", 
			"name", 
			"email", 
			"department_id", 
			"status" 
		];
	}
	

	/**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
	public $timestamps = false;
}
