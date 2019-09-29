<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\Http\Controllers\MailController;

class AuthController extends Controller
{
    public function register(Request $request, MailController $EMAIL){
        // Validate Input
        $validation = $request->validate([
                        'username' => 'required|string|unique:users',
                        'name'=>'required',
                        'email' => 'required|string|email|unique:users',
                        'password' => 'required|string|confirmed'
                    ]);
        DB::beginTransaction();
        try{
            $user = new User();
            $user->name = $request->name;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->save();

            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult;

            DB::commit();
        }catch (\Throwable $e) {
            DB::rollback();
            return $this->error($e->getMessage());
        }
        
        return $this->success('Registeration successful', $token);
        /** If isset @param [remember me], set token expiration to 1week, otherwise token should expire in 1day */
        // Send an account confirmation or creation notification
    // }
        
    }

    public function logout(){
        $accessToken = Auth::user()->token();
        DB::table('oauth_refresh_tokens')
            ->where('access_token_id', $accessToken->id)
            ->update([
                'revoked' => true
            ]);

        $accessToken->revoke();
        // Auth::logout();
        // Session::flush();
        // Session::regenerate();
        
        return $this->success('You are successfully logged out');
    }
  
    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function user(Request $request)
    {
        return $this->success('User retrieved', $request->user());
    }
}
