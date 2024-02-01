<?php

namespace App\Repositories;

interface InterfaceUserRepository
{
    public function allUser();
    public function storeUser($data);
    public function findUser($id);
    public function updateUser($data, $id);
    public function destroyUser($id);
    public function connectUser($data);
    public function disconnectUser($data);
    public function carShow($id);
}
