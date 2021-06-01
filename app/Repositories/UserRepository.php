<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository {

    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getUserByUsername($username){
        return $this->user->where('username',$username)->first();
    }

    public function getUserById($id){
        return $this->user->find($id);
    }

    public function createNewUser($data){
        return $this->user->create([
            "name" => $data['name'],
            "username" => $data['username'],
            "password" => Hash::make($data['password']),
            "email" => $data['email'],
        ]);
    }

    public function updateUser($data, $id){
        return $this->user->find($id)->update([
            "name" => $data['name'],
            "username" => $data['username'],
            "password" => $data['password'],
            "email" => $data['email'],
        ]);
    }

    public function deleteUser($id){
        return $this->user->find($id)->delete();
    }
    

}