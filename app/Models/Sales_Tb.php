<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Sales_Tb extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'sales_tb';
	

	/**
     * The table primary key field
     *
     * @var string
     */
	protected $primaryKey = 'sales_id';
	

	/**
     * Table fillable fields
     *
     * @var array
     */
	protected $fillable = ["order_no","product_id","vendor_id","user_id","rate","qty","total_amount","payment_optn","date","sales_status","remark","checkout_by"];
	

	/**
     * Set search query for the model
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @param string $text
     */
	public static function search($query, $text){
		//search table record 
		$search_condition = '(
				order_no LIKE ?  OR 
				payment_optn LIKE ?  OR 
				remark LIKE ? 
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
			"sales_id", 
			"order_no", 
			"product_id", 
			"vendor_id", 
			"user_id", 
			"rate", 
			"qty", 
			"total_amount", 
			"payment_optn", 
			"date", 
			"dare_reg", 
			"sales_status", 
			"remark", 
			"checkout_by" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"sales_id", 
			"order_no", 
			"product_id", 
			"vendor_id", 
			"user_id", 
			"rate", 
			"qty", 
			"total_amount", 
			"payment_optn", 
			"date", 
			"dare_reg", 
			"sales_status", 
			"remark", 
			"checkout_by" 
		];
	}
	

	/**
     * return view page fields of the model.
     * 
     * @return array
     */
	public static function viewFields(){
		return [ 
			"sales_id", 
			"order_no", 
			"product_id", 
			"vendor_id", 
			"user_id", 
			"rate", 
			"qty", 
			"total_amount", 
			"payment_optn", 
			"date", 
			"dare_reg", 
			"sales_status", 
			"remark", 
			"checkout_by" 
		];
	}
	

	/**
     * return exportView page fields of the model.
     * 
     * @return array
     */
	public static function exportViewFields(){
		return [ 
			"sales_id", 
			"order_no", 
			"product_id", 
			"vendor_id", 
			"user_id", 
			"rate", 
			"qty", 
			"total_amount", 
			"payment_optn", 
			"date", 
			"dare_reg", 
			"sales_status", 
			"remark", 
			"checkout_by" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"sales_id", 
			"order_no", 
			"product_id", 
			"vendor_id", 
			"user_id", 
			"rate", 
			"qty", 
			"total_amount", 
			"payment_optn", 
			"date", 
			"sales_status", 
			"remark", 
			"checkout_by" 
		];
	}
	

	/**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
	public $timestamps = false;
}
