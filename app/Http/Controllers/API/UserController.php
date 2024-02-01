<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\User as UserResource;
use App\Repositories\InterfaceUserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserController extends BaseController
{

    protected $userRepository;

    public function __construct(InterfaceUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = $this->userRepository->allUser();


        return $this->sendResponse(UserResource::collection($user), 'Usuarios listados com sucesso.');
    }
    /**
     * User api
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = $this->userRepository->storeUser($input);
        $success['name'] =  $user->name;

        return $this->sendResponse($success, 'Usuario registrado com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (is_null($id)) {
            return $this->sendError('Carro não encontrado.');
        }
        $user = $this->userRepository->findUser($id);
        return $this->sendResponse(new UserResource($user), 'Usuario cadastrado com sucesso.');
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'email' => 'required|email',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $user = $this->userRepository->updateUser($input, $input['id']);


        return $this->sendResponse(new UserResource($user), 'Usuario atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = $this->userRepository->destroyUser($id);

        return $this->sendResponse([], $user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function connect(Request $request)
    {

       $connect =  $this->userRepository->connectUser($request->all());

        return $this->sendResponse([], $connect);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function disconnect(Request $request)
    {

        $car = $this->userRepository->disconnectUser($request->all());

        return $this->sendResponse([], $car);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function car($id)
    {

        $car = $this->userRepository->carShow($id);

        return $this->sendResponse([$car], 'carros exibidos com sucesso.');
    }

}
