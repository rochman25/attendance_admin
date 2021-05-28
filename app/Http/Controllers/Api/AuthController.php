<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{

    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;        
    }

    public function index(){
        $data['message'] = "Hai.";
        $data['data'] = [];
        return $this->responseSukses($data);
    }

    public function authenticate(Request $request){
        $input = [
            "username" => $request->username,
            "password" => $request->password
        ];

        $validator = Validator::make($input, [
            'username' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            $msg = $this->validationError;
            return $this->responseError($msg, $validator->errors(), 400);
        }

        $user = $this->userRepository->getUserByUsername($request->username);
        if($user){
            try {
                $credentials = $request->only('username','password');
                if (! $token = JWTAuth::attempt($credentials)) {
                    $msg = "invalid_credentials";
                    return $this->responseError($msg,$msg,401);
                }
            } catch (JWTException $e) {
                return response()->json(['error' => 'could_not_create_token'], 500);
            }
            $data['message'] = $this->loginSukses;
            $data['data'] = $user;
            $data['token'] = $token;
            $data['token_type'] = 'bearer';
            $data['expires_in'] = JWTAuth::factory()->getTTL() * 144;
        }else{
            $data['message'] = "Oops akun tidak ditemukan.";
            $data['data'] = [];
        }
        return $this->responseSukses($data);
    }

    public function refreshToken(){
        try{
            $token = JWTAuth::refresh(JWTAuth::getToken());
            $data['message'] = $this->tokenRefreshed;
            $data['data'] = [];
            $data['token'] = $token;
            $data['token_type'] = 'bearer';
            $data['expires_in'] = JWTAuth::factory()->getTTL() * 144;
            return $this->responseSukses($data);
        }catch(Exception $e){
            $data['data'] = [];
            $data['message'] = $e->getMessage();
            return $this->responseSukses($data);
        }

    }

}
