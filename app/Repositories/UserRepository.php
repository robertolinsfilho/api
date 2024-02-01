<?php

namespace App\Repositories;


use App\Models\Car;
use App\Models\User;
use Illuminate\Database\QueryException;
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
        try {
            User::create($data);
        }catch (QueryException $exception){
            return 'Erro ao criar usuario';
        }
        return 'Usuario ao criado com sucesso';
    }

    public function findUser($id)
    {
        return User::find($id);
    }

    public function updateUser($data, $id)
    {
        try{
            $user = User::query()
                ->where('id', $id)
                ->first();

            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->save();
        } catch (QueryException $e){
            return 'Usuario não atualizado';
        }


        return 'Usuario  atualizado';

    }

    public function destroyUser($id)
    {
        try {
            $user = User::query()
                ->where('id', $id)
                ->update(['deleted_at' => Carbon::now()]);
            Car::query()
                ->where('user', $id)
                ->update(['user' => null]);
        }catch(QueryException $e){
            return 'Erro ao deletar usuario';
        }
        if($user == 0){
            return 'Erro ao deletar usuario';
        }
        return 'Usuario deletado com sucesso.';
    }

    public function connectUser($data)
    {
        try {
            $car = Car::query()
                ->where('id', $data['id_car'])
                ->update(['user' => $data['id_user']]);
        }catch (QueryException $e){
            return 'Usuario não associado.';
        }
        if($car == 0){
            return 'Usuario não associado.';
        }
        return 'Usuario associado com sucesso.';
    }
    public function disconnectUser($data)
    {
        try {
       $car = Car::query()
            ->where('id', $data['id_car'])
            ->update(['user' => null]);
        }catch (QueryException $e){
            return 'Usuario não desassociado.';
        }
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
