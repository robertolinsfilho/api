<?php

namespace App\Repositories;

use App\Models\Car;
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
        return Car::create($data);
    }

    public function findCar($id)
    {
        return Car::find($id);
    }

    public function updateCar($data, $id)
    {

        $car = Car::query()
            ->where('id', $id)
            ->first();

        $car->name = $data['name'];
        $car->color = $data['color'];
        $car->model = $data['model'];
        $car->save();
        return $car;
    }

    public function destroyCar($id)
    {
        $car = Car::query()
            ->where('id', $id)
            ->update(['deleted_at' => Carbon::now()]);


    }
}
