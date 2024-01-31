<?php

namespace App\Repositories;

interface InterfaceUserRepository
{
    public function allUser();
    public function storeUser($data);
    public function findUser($id);
    public function updateUser($data, $id);
    public function destroyUser($id);
}
