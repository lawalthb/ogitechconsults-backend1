<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
class Users_Tb extends Authenticatable 
{
	use Notifiable, HasApiTokens;
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'users_tb';
	

	/**
     * The table primary key field
     *
     * @var string
     */
	protected $primaryKey = 'user_id';
	

	/**
     * Table fillable fields
     *
     * @var array
     */
	protected $fillable = ["matric_no","firstname","lastname","email","phone","department","level","password","status","email_link","email_comfirm","email_token","gender","deleted","photo","email_verified_at"];
	/**
     * Table fields which are not included in select statement
     *
     * @var array
     */
	protected $hidden = ['password', 'token'];
	

	/**
     * return list page fields of the model.
     * 
     * @return array
     */
	public static function listFields(){
		return [ 
			"users_tb.user_id AS user_id", 
			"users_tb.matric_no AS matric_no", 
			"users_tb.firstname AS firstname", 
			"users_tb.lastname AS lastname", 
			"users_tb.email AS email", 
			"users_tb.phone AS phone", 
			"users_tb.department AS department", 
			"departments_tb.name AS departments_tb_name", 
			"users_tb.level AS level", 
			"users_tb.gender AS gender", 
			"users_tb.status AS status", 
			"users_tb.reg_date AS reg_date", 
			"users_tb.photo AS photo", 
			"users_tb.email_verified_at AS email_verified_at" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"users_tb.user_id AS user_id", 
			"users_tb.matric_no AS matric_no", 
			"users_tb.firstname AS firstname", 
			"users_tb.lastname AS lastname", 
			"users_tb.email AS email", 
			"users_tb.phone AS phone", 
			"users_tb.department AS department", 
			"departments_tb.name AS departments_tb_name", 
			"users_tb.level AS level", 
			"users_tb.gender AS gender", 
			"users_tb.status AS status", 
			"users_tb.reg_date AS reg_date", 
			"users_tb.photo AS photo", 
			"users_tb.email_verified_at AS email_verified_at" 
		];
	}
	

	/**
     * return view page fields of the model.
     * 
     * @return array
     */
	public static function viewFields(){
		return [ 
			"user_id", 
			"matric_no", 
			"firstname", 
			"lastname", 
			"email", 
			"phone", 
			"department", 
			"level", 
			"status", 
			"email_link", 
			"email_comfirm", 
			"email_token", 
			"reg_date", 
			"gender", 
			"deleted", 
			"email_verified_at" 
		];
	}
	

	/**
     * return exportView page fields of the model.
     * 
     * @return array
     */
	public static function exportViewFields(){
		return [ 
			"user_id", 
			"matric_no", 
			"firstname", 
			"lastname", 
			"email", 
			"phone", 
			"department", 
			"level", 
			"status", 
			"email_link", 
			"email_comfirm", 
			"email_token", 
			"reg_date", 
			"gender", 
			"deleted", 
			"email_verified_at" 
		];
	}
	

	/**
     * return accountedit page fields of the model.
     * 
     * @return array
     */
	public static function accounteditFields(){
		return [ 
			"user_id", 
			"matric_no", 
			"firstname", 
			"lastname", 
			"phone", 
			"department", 
			"level", 
			"status", 
			"gender", 
			"photo", 
			"email_verified_at" 
		];
	}
	

	/**
     * return accountview page fields of the model.
     * 
     * @return array
     */
	public static function accountviewFields(){
		return [ 
			"users_tb.user_id AS user_id", 
			"users_tb.matric_no AS matric_no", 
			"users_tb.firstname AS firstname", 
			"users_tb.lastname AS lastname", 
			"users_tb.email AS email", 
			"users_tb.phone AS phone", 
			"users_tb.department AS department", 
			"departments_tb.name AS departments_tb_name", 
			"users_tb.status AS status", 
			"users_tb.reg_date AS reg_date", 
			"users_tb.gender AS gender", 
			"users_tb.email_verified_at AS email_verified_at" 
		];
	}
	

	/**
     * return exportAccountview page fields of the model.
     * 
     * @return array
     */
	public static function exportAccountviewFields(){
		return [ 
			"users_tb.user_id AS user_id", 
			"users_tb.matric_no AS matric_no", 
			"users_tb.firstname AS firstname", 
			"users_tb.lastname AS lastname", 
			"users_tb.email AS email", 
			"users_tb.phone AS phone", 
			"users_tb.department AS department", 
			"departments_tb.name AS departments_tb_name", 
			"users_tb.status AS status", 
			"users_tb.reg_date AS reg_date", 
			"users_tb.gender AS gender", 
			"users_tb.email_verified_at AS email_verified_at" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"user_id", 
			"firstname", 
			"lastname", 
			"matric_no", 
			"phone", 
			"department", 
			"level", 
			"status", 
			"email_link", 
			"email_comfirm", 
			"email_token", 
			"gender", 
			"deleted", 
			"photo", 
			"email_verified_at" 
		];
	}
	

	/**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
	public $timestamps = false;
	

	/**
     * Get current user name
     * @return string
     */
	public function UserName(){
		return $this->firstname;
	}
	

	/**
     * Get current user id
     * @return string
     */
	public function UserId(){
		return $this->user_id;
	}
	public function UserEmail(){
		return $this->email;
	}
	public function UserPhoto(){
		return $this->photo;
	}
	

	/**
     * Send Password reset link to user email 
	 * @param string $token
     * @return string
     */
	public function sendPasswordResetNotification($token)
	{
		// Your your own implementation.
		$this->notify(new \App\Notifications\ResetPassword($token));
	}
}
