<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Stock_Tb extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'stock_tb';
	

	/**
     * The table primary key field
     *
     * @var string
     */
	protected $primaryKey = 'stock_id';
	

	/**
     * Table fillable fields
     *
     * @var array
     */
	protected $fillable = ["date","user_id","mat_no","item_id","vendor_id","user_type","item_in","item_out","item_balance","payment_id","status"];
	

	/**
     * Set search query for the model
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @param string $text
     */
	public static function search($query, $text){
		//search table record 
		$search_condition = '(
				mat_no LIKE ? 
		)';
		$search_params = [
			"%$text%"
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
			"stock_id", 
			"date", 
			"user_id", 
			"mat_no", 
			"item_id", 
			"vendor_id", 
			"user_type", 
			"item_in", 
			"item_out", 
			"item_balance", 
			"payment_id", 
			"reg_date", 
			"status" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"stock_id", 
			"date", 
			"user_id", 
			"mat_no", 
			"item_id", 
			"vendor_id", 
			"user_type", 
			"item_in", 
			"item_out", 
			"item_balance", 
			"payment_id", 
			"reg_date", 
			"status" 
		];
	}
	

	/**
     * return view page fields of the model.
     * 
     * @return array
     */
	public static function viewFields(){
		return [ 
			"stock_id", 
			"date", 
			"user_id", 
			"mat_no", 
			"item_id", 
			"vendor_id", 
			"user_type", 
			"item_in", 
			"item_out", 
			"item_balance", 
			"payment_id", 
			"reg_date", 
			"status" 
		];
	}
	

	/**
     * return exportView page fields of the model.
     * 
     * @return array
     */
	public static function exportViewFields(){
		return [ 
			"stock_id", 
			"date", 
			"user_id", 
			"mat_no", 
			"item_id", 
			"vendor_id", 
			"user_type", 
			"item_in", 
			"item_out", 
			"item_balance", 
			"payment_id", 
			"reg_date", 
			"status" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"stock_id", 
			"date", 
			"user_id", 
			"mat_no", 
			"item_id", 
			"vendor_id", 
			"user_type", 
			"item_in", 
			"item_out", 
			"item_balance", 
			"payment_id", 
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
