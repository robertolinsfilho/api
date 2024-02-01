<?php

namespace App\Repositories;

use App\Models\Car;
use Illuminate\Database\QueryException;
use Illuminate\Support\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

class CarRepository implements InterfaceCarRepository
{
    protected $car = null;


    public function allCar()
    {
        return Car::paginate(10);
    }

    public function storeCar($data)
    {
        try {
             Car::create($data);
        }catch (QueryException $exception){
            return 'Erro ao criar carro';
        }
        return 'Carro ao criado com sucesso';

    }

    public function findCar($id)
    {
        return Car::find($id);
    }

    public function updateCar($data, $id)
    {
        try{
        $car = Car::query()
            ->where('id', $id)
            ->first();

        $car->name = $data['name'];
        $car->color = $data['color'];
        $car->model = $data['model'];
        $car->save();
        } catch (QueryException $e){
            return 'Carro não atualizado';
        }


        return 'Carro atualizado';
    }

    public function destroyCar($id)
    {
        try {
        $car = Car::query()
            ->where('id', $id)
            ->update(['deleted_at' => Carbon::now(),'user' => null]);
        }catch(QueryException $e){
            return 'Erro ao deletar carro';
        }
        if($car == 0){
            return 'Carro não deletado com sucesso.';
        }
        return 'Carro deletado com sucesso.';



    }
}
