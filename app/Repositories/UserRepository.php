<?php

namespace App\Repositories;


use App\Models\Car;
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
        $user->save();

        return $user;

    }

    public function destroyUser($id)
    {
        $user = User::query()
            ->where('id', $id)
            ->update(['deleted_at' => Carbon::now()]);
         Car::query()
            ->where('user', $id)
            ->update(['user' => null]);

        if($user == 0){
            return 'Usuario não deletado com sucesso.';
        }
        return 'Usuario deletado com sucesso.';
    }

    public function connectUser($data)
    {

        $car = Car::query()
            ->where('id', $data['id_car'])
            ->update(['user' => $data['id_user']]);
        if($car == 0){
            return 'Usuario não associado.';
        }
        return 'Usuario associado com sucesso.';
    }
    public function disconnectUser($data)
    {
       $car = Car::query()
            ->where('id', $data['id_car'])
            ->update(['user' => null]);
        if($car == 0){
            return 'Usuario não desassociado.';
        }
        return 'Usuario desassociado com sucesso. ';

    }

    public function carShow($id)
    {

        return Car::where('user', '=', $id)->paginate(10);

    }
}
