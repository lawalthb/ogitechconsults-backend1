<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Products_Tb extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'products_tb';
	

	/**
     * The table primary key field
     *
     * @var string
     */
	protected $primaryKey = 'product_id';
	

	/**
     * Table fillable fields
     *
     * @var array
     */
	protected $fillable = ["product_name","unit","description","image","vendor_id","department_id","level","sell_rate","purchase_rate","status","available_for","admin_id","vendor_email","qty"];
	

	/**
     * Set search query for the model
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @param string $text
     */
	public static function search($query, $text){
		//search table record 
		$search_condition = '(
				product_name LIKE ?  OR 
				unit LIKE ?  OR 
				description LIKE ?  OR 
				level LIKE ?  OR 
				available_for LIKE ?  OR 
				vendor_email LIKE ? 
		)';
		$search_params = [
			"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
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
			"product_id", 
			"product_name", 
			"unit", 
			"description", 
			"image", 
			"vendor_id", 
			"department_id", 
			"level", 
			"sell_rate", 
			"purchase_rate", 
			"status", 
			"reg_date", 
			"available_for", 
			"admin_id", 
			"vendor_email", 
			"qty" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"product_id", 
			"product_name", 
			"unit", 
			"description", 
			"image", 
			"vendor_id", 
			"department_id", 
			"level", 
			"sell_rate", 
			"purchase_rate", 
			"status", 
			"reg_date", 
			"available_for", 
			"admin_id", 
			"vendor_email", 
			"qty" 
		];
	}
	

	/**
     * return view page fields of the model.
     * 
     * @return array
     */
	public static function viewFields(){
		return [ 
			"products_tb.product_id AS product_id", 
			"products_tb.product_name AS product_name", 
			"products_tb.description AS description", 
			"products_tb.vendor_id AS vendor_id", 
			"products_tb.department_id AS department_id", 
			"products_tb.sell_rate AS sell_rate", 
			"vendors_tb.vendor_id AS vendors_tb_vendor_id", 
			"vendors_tb.department_id AS vendors_tb_department_id", 
			DB::raw("CONCAT(vendors_tb.title ,' ',vendors_tb.name) AS vendorFullname") 
		];
	}
	

	/**
     * return exportView page fields of the model.
     * 
     * @return array
     */
	public static function exportViewFields(){
		return [ 
			"products_tb.product_id AS product_id", 
			"products_tb.product_name AS product_name", 
			"products_tb.description AS description", 
			"products_tb.vendor_id AS vendor_id", 
			"products_tb.department_id AS department_id", 
			"products_tb.sell_rate AS sell_rate", 
			"vendors_tb.vendor_id AS vendors_tb_vendor_id", 
			"vendors_tb.department_id AS vendors_tb_department_id", 
			DB::raw("CONCAT(vendors_tb.title ,' ',vendors_tb.name) AS vendorFullname") 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"product_id", 
			"product_name", 
			"unit", 
			"description", 
			"image", 
			"vendor_id", 
			"department_id", 
			"level", 
			"sell_rate", 
			"purchase_rate", 
			"status", 
			"available_for", 
			"admin_id", 
			"vendor_email", 
			"qty" 
		];
	}
	

	/**
     * return shop page fields of the model.
     * 
     * @return array
     */
	public static function shopFields(){
		return [ 
			"products_tb.product_id AS product_id", 
			"products_tb.product_name AS product_name", 
			"products_tb.vendor_id AS vendor_id", 
			"products_tb.department_id AS department_id", 
			"products_tb.level AS level", 
			"products_tb.sell_rate AS sell_rate", 
			"vendors_tb.vendor_id AS vendors_tb_vendor_id", 
			"vendors_tb.title AS vendors_tb_title", 
			"vendors_tb.name AS vendors_tb_name", 
			"vendors_tb.email AS vendors_tb_email", 
			"vendors_tb.department_id AS vendors_tb_department_id", 
			"vendors_tb.status AS vendors_tb_status", 
			"vendors_tb.reg_date AS vendors_tb_reg_date" 
		];
	}
	

	/**
     * return exportShop page fields of the model.
     * 
     * @return array
     */
	public static function exportShopFields(){
		return [ 
			"products_tb.product_id AS product_id", 
			"products_tb.product_name AS product_name", 
			"products_tb.vendor_id AS vendor_id", 
			"products_tb.department_id AS department_id", 
			"products_tb.level AS level", 
			"products_tb.sell_rate AS sell_rate", 
			"vendors_tb.vendor_id AS vendors_tb_vendor_id", 
			"vendors_tb.title AS vendors_tb_title", 
			"vendors_tb.name AS vendors_tb_name", 
			"vendors_tb.email AS vendors_tb_email", 
			"vendors_tb.department_id AS vendors_tb_department_id", 
			"vendors_tb.status AS vendors_tb_status", 
			"vendors_tb.reg_date AS vendors_tb_reg_date" 
		];
	}
	

	/**
     * return nview page fields of the model.
     * 
     * @return array
     */
	public static function nviewFields(){
		return [ 
			"product_id", 
			"product_name", 
			"unit", 
			"description", 
			"image", 
			"vendor_id", 
			"department_id", 
			"level", 
			"sell_rate", 
			"purchase_rate", 
			"status", 
			"reg_date", 
			"available_for", 
			"admin_id", 
			"vendor_email", 
			"qty" 
		];
	}
	

	/**
     * return exportNview page fields of the model.
     * 
     * @return array
     */
	public static function exportNviewFields(){
		return [ 
			"product_id", 
			"product_name", 
			"unit", 
			"description", 
			"image", 
			"vendor_id", 
			"department_id", 
			"level", 
			"sell_rate", 
			"purchase_rate", 
			"status", 
			"reg_date", 
			"available_for", 
			"admin_id", 
			"vendor_email", 
			"qty" 
		];
	}
	

	/**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
	public $timestamps = false;
}
