<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;        
    }


    public function getProfile(Request $request, $id)
    {
        $userDetail = $this->userRepository->getUserById($id);
        $data['data'] = $this->handleNullMultiDimensi($userDetail);
        $data['message'] = "Request sukses";
        return $this->responseSukses($data, 200);
    }

}
