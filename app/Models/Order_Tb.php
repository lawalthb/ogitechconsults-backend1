<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Order_Tb extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'order_tb';
	

	/**
     * The table primary key field
     *
     * @var string
     */
	protected $primaryKey = 'order_id';
	

	/**
     * Table fillable fields
     *
     * @var array
     */
	protected $fillable = ["order_no","product_id","vendor_id","user_id","mat_no","rate","qty","total_amount","payment_optn","date","order_status","sales_status","remark"];
	

	/**
     * Set search query for the model
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @param string $text
     */
	public static function search($query, $text){
		//search table record 
		$search_condition = '(
				order_no LIKE ?  OR 
				mat_no LIKE ?  OR 
				payment_optn LIKE ?  OR 
				remark LIKE ? 
		)';
		$search_params = [
			"%$text%","%$text%","%$text%","%$text%"
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
			"order_id", 
			"order_no", 
			"product_id", 
			"vendor_id", 
			"user_id", 
			"mat_no", 
			"rate", 
			"qty", 
			"total_amount", 
			"payment_optn", 
			"date", 
			"dare_reg", 
			"order_status", 
			"sales_status", 
			"remark" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"order_id", 
			"order_no", 
			"product_id", 
			"vendor_id", 
			"user_id", 
			"mat_no", 
			"rate", 
			"qty", 
			"total_amount", 
			"payment_optn", 
			"date", 
			"dare_reg", 
			"order_status", 
			"sales_status", 
			"remark" 
		];
	}
	

	/**
     * return view page fields of the model.
     * 
     * @return array
     */
	public static function viewFields(){
		return [ 
			"order_id", 
			"order_no", 
			"product_id", 
			"vendor_id", 
			"user_id", 
			"mat_no", 
			"rate", 
			"qty", 
			"total_amount", 
			"payment_optn", 
			"date", 
			"dare_reg", 
			"order_status", 
			"sales_status", 
			"remark" 
		];
	}
	

	/**
     * return exportView page fields of the model.
     * 
     * @return array
     */
	public static function exportViewFields(){
		return [ 
			"order_id", 
			"order_no", 
			"product_id", 
			"vendor_id", 
			"user_id", 
			"mat_no", 
			"rate", 
			"qty", 
			"total_amount", 
			"payment_optn", 
			"date", 
			"dare_reg", 
			"order_status", 
			"sales_status", 
			"remark" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"order_id", 
			"order_no", 
			"product_id", 
			"vendor_id", 
			"user_id", 
			"mat_no", 
			"rate", 
			"qty", 
			"total_amount", 
			"payment_optn", 
			"date", 
			"order_status", 
			"sales_status", 
			"remark" 
		];
	}
	

	/**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
	public $timestamps = false;
}
