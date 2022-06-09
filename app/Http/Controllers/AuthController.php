<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Users_Tb;
use App\Http\Requests\Users_TbRegisterRequest;
use Exception;
use App\Helpers\JWTHelper;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;
class AuthController extends Controller{
	

	/**
     * Get user login data
     * @return array
     */
	private function getUserLoginData($user = null){
		if(!$user){
			$user = auth()->user();
		}
		$accessToken = $user->createToken('authToken')->accessToken;
        return ['user' => $user, 'token' => $accessToken, 'nextpage' => '/home'];
	}
	

	/**
     * Authenticate and login user
     * @return \Illuminate\Http\Response
     */
	function login(Request $request){
		$username = $request->username;
		$password = $request->password;
		Auth::attempt(['email' => $username, 'password' => $password]);
        if (!Auth::check()) {
            return $this->reject("Username or password not correct", 400);
        }
		$user = auth()->user();
		//check if user has verified email
		if (!$user->hasVerifiedEmail()) {
			$token = $this->generateUserToken($user);
			return $this->respond(["nextpage" => "index/verifyemail?token={$token}"]);
		}
		$loginData = $this->getUserLoginData($user);
        return $this->respond($loginData);
	}
	

	/**
     * Save new user record
     * @return \Illuminate\Http\Response
     */
	function register(Users_TbRegisterRequest $request){
		$modeldata = $request->validated();
		
		if( array_key_exists("photo", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['photo'], "photo");
			$modeldata['photo'] = $fileInfo['filepath'];
		}
		$modeldata['password'] = bcrypt($modeldata['password']);
		
		//save Users_tb record
		$user = $record = Users_tb::create($modeldata);
		$rec_id = $record->user_id;
	$this->sendMailOnRecordUserregister($record);
		$user->sendEmailVerificationNotification();
		$token = $this->generateUserToken($user);
		return $this->respond(["nextpage" => "/index/verifyemail?token=$token"]);
	}
	

	/**
     * verify user email
     * @return \Illuminate\Http\Response
     */
	public function verifyemail(Request $request) {
		if (!$request->hasValidSignature()) {
			return $this->reject("Invalid/Expired url provided.", 400);
		}
		$token = $request->input("token");
		$userId = $this->getUserIDFromJwt($token);
		$user = Users_Tb::findOrFail($userId);
		if (!$user->hasVerifiedEmail()) {
			$user->markEmailAsVerified();
		}
		$emailVerifiedPage = config("app.frontend_url") . "/#/index/emailverified";
		return redirect()->to($emailVerifiedPage);
	}
	

	/**
     * resend email verification link to user email
     * @return \Illuminate\Http\Response
     */
	public function resendverifyemail(Request $request) {
		$token = $request->get("token");
		$userId = $this->getUserIDFromJwt($token);
		$user = Users_Tb::findOrFail($userId);
		if ($user->hasVerifiedEmail()) {
			return $this->reject("Email already verified.", 400);
		}
		$user->sendEmailVerificationNotification();
		return $this->respond("Email verification link has been resent");
	}
	

	/**
     * send password reset link to user email
     * @return \Illuminate\Http\Response
     */
	public function forgotpassword(Request $request) {
		$modeldata = $request->all();
		$validator = Validator::make($modeldata,  
		[
			'email' => "required|email",
		]);
		if ($validator->fails()) {
			return $this->reject($validator->errors(), 400);
		}
		try{
			$response = Password::sendResetLink($modeldata, function (Message $message) {
				$message->subject($this->getEmailSubject());
			});
			switch ($response) {
				case Password::RESET_LINK_SENT:
					return $this->respond(trans($response));
				case Password::INVALID_USER:
					return $this->reject(trans($response), 404);
			}
			return $this->reject($response, 500);
		} 
		catch (\Swift_TransportException $ex) {
			return $this->reject($ex->getMessage());
		} 
		catch (Exception $ex) {
			return $this->reject($ex->getMessage());
		}
	}
	

	/**
     * Reset user password
     * @return \Illuminate\Http\Response
     */
	public function resetpassword(Request $request) {
		$modeldata = $request->all();
		$validator = Validator::make($modeldata,  
		[
			'email' => 'required|email',
			'token' => 'required|string',
			"password" => "required|same:confirm_password",
		]);
		if ($validator->fails()) {
			return $this->reject($validator->errors(), 400);
		}
		$credentials = $validator->valid();
		$reset_password_status = Password::reset($credentials, function ($user, $password) {
			$user->password = bcrypt($password);
			$user->save();
		});
		if ($reset_password_status == Password::INVALID_TOKEN) {
			return $this->reject("Invalid token", 400);
		}
		return $this->respond("Password changed");
	}
	

	/**
     * Get the response for a successful password reset.
     *
     * @param  string  $response
     * @return \Illuminate\Http\Response
     */
	protected function sendResetResponse(Request $request, $response)
	{
		return $this->respond("Password reset link sent to user email");
	}
	

    /**
     * Get the response for a failed password reset.
     *
     * @param  \Illuminate\Http\Request
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendResetFailedResponse(Request $request, $response)
    {
       return $this->reject(trans($response), 500);
	}
	

	/**
     * generate token with user id
     * @return string
     */
	private function generateUserToken($user = null){
		return JWTHelper::encode($user->user_id);
	}
	

	/**
     * validate token and get user id
     * @return string
     */
	private function getUserIDFromJwt($token){
		$userId =  JWTHelper::decode($token);
 		return $userId;
	}
}
