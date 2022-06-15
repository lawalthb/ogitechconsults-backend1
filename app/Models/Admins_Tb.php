<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Admins_Tb extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'admins_tb';
	

	/**
     * The table primary key field
     *
     * @var string
     */
	protected $primaryKey = 'admin_id';
	

	/**
     * Table fillable fields
     *
     * @var array
     */
	protected $fillable = ["firstname","lastname","email","password","username","admin_type","status","deleted","photo"];
	

	/**
     * Set search query for the model
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @param string $text
     */
	public static function search($query, $text){
		//search table record 
		$search_condition = '(
				firstname LIKE ?  OR 
				lastname LIKE ?  OR 
				email LIKE ?  OR 
				password LIKE ?  OR 
				username LIKE ?  OR 
				admin_type LIKE ? 
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
			"admin_id", 
			"firstname", 
			"lastname", 
			"email", 
			"username", 
			"admin_type", 
			"status", 
			"reg_date", 
			"deleted", 
			"photo" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"admin_id", 
			"firstname", 
			"lastname", 
			"email", 
			"username", 
			"admin_type", 
			"status", 
			"reg_date", 
			"deleted", 
			"photo" 
		];
	}
	

	/**
     * return view page fields of the model.
     * 
     * @return array
     */
	public static function viewFields(){
		return [ 
			"admin_id", 
			"firstname", 
			"lastname", 
			"email", 
			"username", 
			"admin_type", 
			"status", 
			"reg_date", 
			"deleted", 
			"photo" 
		];
	}
	

	/**
     * return exportView page fields of the model.
     * 
     * @return array
     */
	public static function exportViewFields(){
		return [ 
			"admin_id", 
			"firstname", 
			"lastname", 
			"email", 
			"username", 
			"admin_type", 
			"status", 
			"reg_date", 
			"deleted", 
			"photo" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"admin_id", 
			"firstname", 
			"lastname", 
			"email", 
			"username", 
			"admin_type", 
			"status", 
			"deleted", 
			"photo" 
		];
	}
	

	/**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
	public $timestamps = false;
}
