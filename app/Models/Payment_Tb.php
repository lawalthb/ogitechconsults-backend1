<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Payment_Tb extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'payment_tb';
	

	/**
     * The table primary key field
     *
     * @var string
     */
	protected $primaryKey = 'payment_id';
	

	/**
     * Table fillable fields
     *
     * @var array
     */
	protected $fillable = ["vendor_id","amount_in","amount_out","amount_balance","cmment","date"];
	

	/**
     * Set search query for the model
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @param string $text
     */
	public static function search($query, $text){
		//search table record 
		$search_condition = '(
				cmment LIKE ? 
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
			"payment_id", 
			"vendor_id", 
			"amount_in", 
			"amount_out", 
			"amount_balance", 
			"reg_date", 
			"cmment", 
			"date" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"payment_id", 
			"vendor_id", 
			"amount_in", 
			"amount_out", 
			"amount_balance", 
			"reg_date", 
			"cmment", 
			"date" 
		];
	}
	

	/**
     * return view page fields of the model.
     * 
     * @return array
     */
	public static function viewFields(){
		return [ 
			"payment_id", 
			"vendor_id", 
			"amount_in", 
			"amount_out", 
			"amount_balance", 
			"reg_date", 
			"cmment", 
			"date" 
		];
	}
	

	/**
     * return exportView page fields of the model.
     * 
     * @return array
     */
	public static function exportViewFields(){
		return [ 
			"payment_id", 
			"vendor_id", 
			"amount_in", 
			"amount_out", 
			"amount_balance", 
			"reg_date", 
			"cmment", 
			"date" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"payment_id", 
			"vendor_id", 
			"amount_in", 
			"amount_out", 
			"amount_balance", 
			"cmment", 
			"date" 
		];
	}
	

	/**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
	public $timestamps = false;
}
