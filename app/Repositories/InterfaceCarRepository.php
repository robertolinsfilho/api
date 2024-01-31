<?php

namespace App\Repositories;

interface InterfaceCarRepository
{
    public function allCar();
    public function storeCar($data);
    public function findCar($id);
    public function updateCar($data, $id);
    public function destroyCar($id);
}
