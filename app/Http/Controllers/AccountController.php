<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Users_Tb;
use App\Http\Requests\Users_TbAccountEditRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Exception;
/**
 * Account Page Controller
 * @category  Controller
 */
class AccountController extends Controller{
	

	/**
     * Select user account data
     * @return \Illuminate\View\View
     */
	function index(){
		$rec_id = Auth::id();
		$query = Users_Tb::query();
		$query->join("departments_tb", "users_tb.department", "=", "departments_tb.department_id");
		$record = $query->findOrFail($rec_id,  Users_Tb::accountviewFields());
		return $this->respond($record);
	}
	

	/**
     * Update user account data
     * @return \Illuminate\View\View;
     */
	function edit(Users_TbAccountEditRequest $request){
		$rec_id = Auth::id();
		$query = Users_Tb::query();
		$record = $query->findOrFail($rec_id, Users_Tb::accounteditFields());
		if ($request->isMethod('post')) {
			$modeldata = $request->validated();
		
		if( array_key_exists("photo", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['photo'], "photo");
			$modeldata['photo'] = $fileInfo['filepath'];
		}
			$record->update($modeldata);
		}
		return $this->respond($record);
	}
	function currentuserdata(){
		$user = auth()->user();
		return $this->respond($user);
	}
	

	/**
     * Change user account password
     * @return \Illuminate\Http\Response
     */
	public function changepassword(Request $request)
	{
		$request->validate([
			'oldpassword' => ['required'],
			'newpassword' => ['required'],
			'confirmpassword' => ['same:newpassword'],
		]);
		$userid = auth()->id();
		$user = Users_Tb::find($userid);
		$oldPasswordText = $request->oldpassword;
		$oldPasswordHash = $user->password;
		if(!Hash::check($oldPasswordText, $oldPasswordHash)){
			return $this->reject("Current password is incorrect");
		}
		$modeldata = ['password' => Hash::make($request->newpassword)];
		$user->update($modeldata);
		return $this->respond("Password changed");
	}
}
