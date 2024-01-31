<?php

namespace App\Repositories;


use App\Models\User;
use Illuminate\Support\Carbon;

class UserRepository implements InterfaceUserRepository
{
    protected $user = null;
    public function allUser()
    {
        return User::paginate(10);
    }

    public function storeUser($data)
    {
        return User::create($data);
    }

    public function findUser($id)
    {
        return User::find($id);
    }

    public function updateUser($data, $id)
    {
        $user = User::query()
            ->where('id', $id)
            ->first();

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = $data['password'];
        $user->save();

        return $user;

    }

    public function destroyUser($id)
    {
        $car = User::query()
            ->where('id', $id)
            ->update(['deleted_at' => Carbon::now()]);
    }
}
